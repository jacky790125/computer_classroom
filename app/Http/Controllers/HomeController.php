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
use Illuminate\Support\Facades\DB;
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
    public function index2(Request $request)
    {
        //最新作品3則
        $student_tasks = StudentTask::where('report','<>',null)
            ->where('public','=','1')
            ->orderBy('updated_at','DESC')
            ->paginate(400)
            ->shuffle();

        $data = [
            'student_tasks'=>$student_tasks,
        ];
        return view('index2',$data);
    }

    public function index3(Request $request)
    {

        //存款最多
        $users = User::where('group_id','<>','1')->orderBy('money','DESC')->paginate(10);
        if(empty($users)){
            $top_money10 = [];
        }else{
            $i=1;
            foreach($users as $user){
                if(empty($user->nickname)){
                    $name = $user->username;
                }else{
                    $name = $user->nickname;
                }
                $top_money10[$i]['id'] = $user->id;
                $top_money10[$i]['name'] = $name;
                $top_money10[$i]['money'] = $user->money;
                $i++;
            }

        }


        //打字最快
        //$types = StudType::orderBy('score','DESC')->paginate(10);
        $types = DB::table('stud_types')->select(DB::raw('user_id,max(score) as score'))
            ->groupBy('user_id')
            ->orderBy('score','DESC')
            ->paginate(10);

        if(empty($types)) {
            $top_type10 = [];
        }else{
            $i=1;
            foreach($types as $type){
                $type1 = StudType::where('user_id','=',$type->user_id)
                    ->where('score','=',$type->score)->first();

                if (empty($type1->user->nickname)) {
                    $name = $type1->user->username;
                } else {
                    $name = $type1->user->nickname;
                }
                $top_type10[$i]['id'] = $type1->user_id;
                $top_type10[$i]['name'] = $name;
                $top_type10[$i]['type'] = $type1->score;
                $top_type10[$i]['article'] = $type1->stud_type_article->title;
                $i++;
            }
        }


        //文章最多
        $discusses = Discuss::all();
        if(!empty($discusses)) {
            foreach ($discusses as $discuss) {
                if($discuss->user->group_id <>1){
                    if (empty($discuss->user->nickname)) {
                        $name = $discuss->user->username;
                    } else {
                        $name = $discuss->user->nickname;
                    }
                    if (empty($user_discuss[$discuss->user_id . "-" . $name])) $user_discuss[$discuss->user_id . "-" . $name] = 0;
                    $user_discuss[$discuss->user_id . "-" . $name]++;
                }
            }
            if(!empty($user_discuss)) {
                arsort($user_discuss);
                $i = 1;


                foreach($user_discuss as $k=>$v){
                    $a = explode('-', $k);
                    $top_discuss10[$i]['id'] = $a[0];
                    $top_discuss10[$i]['name'] = $a[1];
                    $top_discuss10[$i]['num'] = $v;
                    $i++;
                    if($i==11) break;
                }


            }else{
                $top_discuss10 = [];

            }
        }else{
            $top_discuss10 = [];
        }

        //最愛遊戲
        $games = StudMoney::where('thing','=','gaming')->get();
        if(!empty($games)) {
            foreach ($games as $game) {
                if (empty($game->user->nickname)) {
                    $name = $game->user->username;
                } else {
                    $name = $game->user->nickname;
                }
                if (empty($user_game[$game->user_id . "-" . $name])) $user_game[$game->user_id . "-" . $name] = 0;
                $user_game[$game->user_id . "-" . $name]++;
            }
            if(!empty($user_game)){
                arsort($user_game);
                $i = 1;
                foreach($user_game as $k=>$v){
                    $a = explode('-', $k);
                    $top_game10[$i]['id'] = $a[0];
                    $top_game10[$i]['name'] = $a[1];
                    $top_game10[$i]['num'] = $v;
                    $i++;
                    if($i==11) break;
                }
            }else{
                $top_game10 = [];
            }
        }else{
            $top_game10 = [];
        }

        //作品最讚
        $likes = StudentTask::orderBy('likes','DESC')->paginate(10);
        if(empty($likes)){
            $top_like10 = [];
        }else{
            $i=1;
            foreach($likes as $like){
                if(empty($like->user->nickname)){
                    $name = $like->user->username;
                }else{
                    $name = $like->user->nickname;
                }
                $top_like10[$i]['id'] = $like->user->id;
                $top_like10[$i]['name'] = $name;
                $top_like10[$i]['like'] = $like->likes;
                $top_like10[$i]['task_id'] = $like->id;
                $i++;
            }
        }


        //作品最多人看
        $views = StudentTask::orderBy('views','DESC')->paginate(10);
        if(empty($views)){
            $top_view10 = [];
        }else{
            $i=1;
            foreach($views as $view){
                if(empty($view->user->nickname)){
                    $name = $view->user->username;
                }else{
                    $name = $view->user->nickname;
                }
                $top_view10[$i]['id'] = $view->user->id;
                $top_view10[$i]['name'] = $name;
                $top_view10[$i]['view'] = $view->views;
                $top_view10[$i]['task_id'] = $view->id;
                $i++;
            }
        }


        $data = [
            'top_money10'=>$top_money10,
            'top_type10'=>$top_type10,
            'top_discuss10'=>$top_discuss10,
            'top_game10'=>$top_game10,
            'top_like10'=>$top_like10,
            'top_view10'=>$top_view10,
        ];
        return view('index3',$data);
    }

    public function index4(Request $request)
    {



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
                $top_money5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_type as $k=>$v){
                $top_type5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_discuss as $k=>$v){
                $top_discuss5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_game as $k=>$v){
                $top_game5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_like as $k=>$v){
                $top_like5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
            $i = 0;
            foreach($stud_view as $k=>$v){
                $top_view5[$k] = $v;
                $i++;
                if($i == 10) break;
            }
        }else{
            $top_money5=[];
            $top_type5=[];
            $top_discuss5=[];
            $top_game5=[];
            $top_like5=[];
            $top_view5=[];
            $user_data=[];
        }


        $data = [
            'groups'=>$groups,
            'group'=>$group,
            'top_money5'=>$top_money5,
            'top_type5'=>$top_type5,
            'top_discuss5'=>$top_discuss5,
            'top_game5'=>$top_game5,
            'top_like5'=>$top_like5,
            'top_view5'=>$top_view5,
            'user_data'=>$user_data,
        ];
        return view('index4',$data);
    }

    public function view_student_task(StudentTask $student_task)
    {
        $data = [
            'student_task'=>$student_task,
        ];
        return view('view_student_task',$data);
    }

    public function admin()
    {
        return view('admin');
    }

    public function view_stud_money()
    {
        $stud_moneys = StudMoney::where('user_id','=',auth()->user()->id)
            ->orderBy('id','DESC')
            ->paginate(30);

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
            $total_money = get_stud_total_money(auth()->user()->id);
            if($total_money < 100){
                $words = "你改頭像要100元，但資訊幣不夠喔！你可以靠「作業得分」、「打字」、別人「按讚」來增加喔！";
                return redirect()->route('error',$words);
            }

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
                return redirect()->route('error',$words);
            } else {
                $filename = auth()->user()->username.".".$info['extension'];
                $file->storeAs('public/' . $folder, $filename);
            }
            $att['avatar'] = $filename;

            $att2['user_id'] = auth()->user()->id;
            $att2['thing'] = "change_avatar";
            $att2['stud_money'] = "-100";
            $att2['description'] = "更換「頭像」扣分";
            StudMoney::create($att2);

            $user->update($att);
        }

        $total_money = get_stud_total_money(auth()->user()->id);
        if(auth()->user()->nickname != $request->input('nickname') and  $total_money < 200){
            $words = "你改暱稱要200元，但資訊幣不夠喔！你可以靠「作業得分」、「打字」、別人「按讚」來增加喔！";
            return redirect()->route('error',$words);
        }elseif(auth()->user()->nickname != $request->input('nickname')){
            $att['nickname'] = $request->input('nickname');

            $att2['user_id'] = auth()->user()->id;
            $att2['thing'] = "change_nickname";
            $att2['stud_money'] = "-200";
            $att2['description'] = "更換「暱稱」扣分";
            StudMoney::create($att2);

            $user->update($att);

        }

        //處理密碼是否更新
        if (password_verify($request->input('old_password'), $user->password) and !empty($request->input('password1'))){
            $att['password'] = bcrypt($request->input('password1'));
        }
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
