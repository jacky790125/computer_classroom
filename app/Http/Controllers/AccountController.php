<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        $users = User::all();
        $data = [
            'groups'=>$groups,
            'users'=>$users,
        ];
        return view('admin.account.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //群組選單
        $groups_array = Group::all()->pluck('name', 'id')->toArray();

        $data = [
            'groups_array'=>$groups_array,
        ];
        return view('admin.account.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att['username'] = $request->input('username');
        $att['password'] = bcrypt($request->input('password1'));
        $att['name'] = $request->input('name');
        $att['sex'] = $request->input('sex');
        $att['year_class_num'] = $request->input('year_class_num');
        $att['email'] = $request->input('email');
        $att['website'] = $request->input('website');
        $att['group_id'] = $request->input('group_id');
        $att['un_active'] = $request->input('un_active');
        User::create($att);
        return redirect()->route('admin.account.index');
    }

    public function storeMore(Request $request)
    {

        $filePath = $request->file('csv')->getRealPath();
        $data = Excel::load($filePath, function ($reader) {
        })->get();

        foreach ($data as $key => $value) {
            $att['username'] = $value['學號'];
            $att['password'] = bcrypt($value['生日月日']);
            $att['name'] = $value['姓名'];
            $att['sex'] = $value['性別'];
            $att['year_class_num'] = $value['年級'].$value['班級'].$value['座號'];
            $att['student_sn'] = $value['學號'];
            $att['group_id'] = $value['群組id'];
            $att['active'] = "1";
            User::create($att);
        }
        return redirect()->route('admin.account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //群組選單
        $groups_array = Group::all()->pluck('name', 'id')->toArray();

        $data = [
            'groups_array'=>$groups_array,
            'user'=>$user,
        ];
        return view('admin.account.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user->update($request->all());
        return redirect()->route('admin.account.edit',$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.account.index');
    }

    public function download_csv()
    {
        $realFile = asset('demo.csv');
        header("Content-type:application");
        header("Content-Disposition: attachment; filename=demo.csv");
        readfile($realFile);
    }

    public function reset(User $user)
    {
        $att['password'] = bcrypt(env('DEFAULT_USER_PWD'));
        $user->update($att);
        return redirect()->route('admin.account.edit',$user->id);
    }
}
