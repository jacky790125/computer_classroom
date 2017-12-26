<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;

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
        $data = [
            'groups'=>$groups,
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
