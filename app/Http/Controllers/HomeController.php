<?php

namespace App\Http\Controllers;

use App\Book;
use App\Link;
use App\StudMoney;
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
    public function index()
    {
        return view('index');
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
