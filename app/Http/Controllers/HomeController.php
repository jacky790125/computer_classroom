<?php

namespace App\Http\Controllers;

use App\Book;
use App\Discuss;
use App\Group;
use App\Link;
use App\Post;
use App\StudentTask;
use App\StudMoney;
use App\StudType;
use App\StudTypeArticle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //最新公告3則
        $posts = Post::orderBy('id','DESC')
            ->paginate(3);

        //最新作品3則
        $student_tasks = StudentTask::where('report','<>',null)
            ->where('public','=','1')
            ->orderBy('updated_at','DESC')
            ->paginate(3);

        $groups_o = Group::all()->pluck('name', 'id')->toArray();
        foreach($groups_o as $k=>$v){
            if($k != 1 and $k != 2) {
                $groups[$k] = $v;
            }else{
                $groups = [];
            }
        }
        $group = $request->input('group_id');

        if(!empty($group)) {
            $users = User::where('group_id','=',$group)
                ->get();
            foreach($users as $user){
                $stud_money[$user->id] = get_stud_total_money($user->id);

                $stud_type_coll = StudType::where('user_id','=',$user->id)
                    ->orderBy('score','DESC')
                    ->first();
                if(empty($stud_type_coll)){
                    $stud_type[$user->id] = 0;
                    $user_data[$user->id]['article'] = null;
                }else{
                    $stud_type[$user->id] = $stud_type_coll->score;
                    $user_data[$user->id]['article'] = $stud_type_coll->stud_type_article->title;
                }


                $stud_discuss[$user->id] = Discuss::where('user_id','=',$user->id)->count();

                $stud_game[$user->id] = StudMoney::where('user_id','=',$user->id)
                    ->where('thing','=','gaming')->count();

                $stud_like_coll = StudentTask::where('user_id','=',$user->id)
                    ->orderBy('likes','DESC')->first();


                if(empty($stud_like_coll)){
                    $stud_like[$user->id] = 0;
                    $user_data[$user->id]['like'] = null;
                }else{
                    $stud_like[$user->id] = $stud_like_coll->likes;
                    $user_data[$user->id]['like'] = $stud_like_coll->id;
                }

                $stud_view_coll = StudentTask::where('user_id','=',$user->id)
                    ->orderBy('views','DESC')->first();

                if(empty($stud_view_coll)){
                    $stud_view[$user->id] = 0;
                    $user_data[$user->id]['view'] = null;
                }else{
                    $stud_view[$user->id] = $stud_view_coll->views;
                    $user_data[$user->id]['view'] = $stud_like_coll->id;
                }



                $user_data[$user->id]['username'] = $user->username;
                $user_data[$user->id]['nickname'] = $user->nickname;
            }
            arsort($stud_money);
            arsort($stud_type);
            arsort($stud_discuss);
            arsort($stud_game);
            arsort($stud_like);
            arsort($stud_view);

            $i = 0;
            foreach($stud_money as $k=>$v){
                $top_money3[$k] = $v;
                $i++;
                if($i == 3) break;
            }
            $i = 0;
            foreach($stud_type as $k=>$v){
                $top_type3[$k] = $v;
                $i++;
                if($i == 3) break;
            }
            $i = 0;
            foreach($stud_discuss as $k=>$v){
                $top_discuss3[$k] = $v;
                $i++;
                if($i == 3) break;
            }
            $i = 0;
            foreach($stud_game as $k=>$v){
                $top_game3[$k] = $v;
                $i++;
                if($i == 3) break;
            }
            $i = 0;
            foreach($stud_like as $k=>$v){
                $top_like10[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_view as $k=>$v){
                $top_view10[$k] = $v;
                $i++;
                if($i == 10) break;
            }
        }else{
            $top_money3=[];
            $top_type3=[];
            $top_discuss3=[];
            $top_game3=[];
            $top_like10=[];
            $top_view10=[];
            $user_data=[];
        }


        $data = [
            'posts'=>$posts,
            'student_tasks'=>$student_tasks,
            'groups'=>$groups,
            'group'=>$group,
            'top_money3'=>$top_money3,
            'top_type3'=>$top_type3,
            'top_discuss3'=>$top_discuss3,
            'top_game3'=>$top_game3,
            'top_like10'=>$top_like10,
            'top_view10'=>$top_view10,
            'user_data'=>$user_data,
        ];
        return view('index',$data);
    }

    public function admin()
    {
        return view('admin');
    }

    public function view_stud_money()
    {
        $stud_moneys = StudMoney::where('user_id','=',auth()->user()->id)->orderBy('id','DESC')->get();

        return view('view_stud_money',compact('stud_moneys'));
    }

    public function link_index()
    {
        $links = Link::orderBy('id')->get();
        $data = [
            'links'=>$links,
        ];
        return view('links.index',$data);
    }

    public function book_index()
    {
        $books = Book::orderBy('id')->get();
        $data = [
            'books'=>$books,
        ];
        return view('books.index',$data);
    }

    public function personal_info_update(Request $request,User $user)
    {
        //處理檔案上傳
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $folder = 'avatars';

            $info = [
                'mime-type' => $file->getMimeType(),
                'original_filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getClientSize(),
            ];
            if ($info['size'] > 1100000) {
                $words = "頭像檔案太大，不得大於1MB！";
                return view('layouts.error',compact('words'));
            } else {
                $filename = auth()->user()->username.".".$info['extension'];
                $file->storeAs('public/' . $folder, $filename);
            }
            $att['avatar'] = $filename;
        }
        //處理密碼是否更新
        if (password_verify($request->input('old_password'), $user->password) and !empty($request->input('password1'))){
            $att['password'] = bcrypt($request->input('password1'));
        }
        $att['nickname'] = $request->input('nickname');
        $att['email'] = $request->input('email');
        $att['website'] = $request->input('website');
        $user->update($att);


        return redirect()->route('index');
    }

    public function getAvatar(User $user)
    {
        if(!empty($user->avatar)) {
            $path = storage_path('app/public/avatars/') . $user->avatar;
        }else{
            $path = public_path('img/avatar.jpg');
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

}
