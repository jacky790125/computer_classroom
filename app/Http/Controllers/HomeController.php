<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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

    public function personal_info_update(Request $request,User $user)
    {
        $att['password'] = bcrypt($request->input('password1'));
        $att['nickname'] = $request->input('nickname');
        $att['email'] = $request->input('email');
        $att['website'] = $request->input('website');
        $user->update($att);
        return redirect()->route('index');
    }
}
