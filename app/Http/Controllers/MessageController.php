<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudMessage;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gs = Group::where('active','=','1')
            ->where('name','like','1%')
            ->get();

        if(!empty($gs)) {
            foreach ($gs as $g) {
                if (!isset($groups[$g->id])) $groups[$g->id] = null;
                $groups[$g->id] = $g->name . "(id:" . $g->id . ")";
            }
        }
        return view('admin.messages.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $i =0;
        $for = $request->input('for');
        foreach($for as $v){
            $users = User::where('group_id','=',$v)->get();
            foreach($users as $user) {
                $students[$i]['username'] = $user->username;
                $i++;
            }
        }

        foreach($students as $k=>$v) {
            $att2['title'] = $request->input('title');
            $att2['content'] = $request->input('content');
            $att2['from'] = auth()->user()->username;
            $att2['to'] = $v['username'];
            $att2['read'] = "0";
            $att2['ip'] = request()->ip();
            StudMessage::create($att2);
        }

        return redirect()->route('admin.message.index');
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
