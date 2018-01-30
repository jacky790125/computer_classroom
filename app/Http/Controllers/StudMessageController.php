<?php

namespace App\Http\Controllers;

use App\StudMessage;
use Illuminate\Http\Request;

class StudMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = StudMessage::where('to','=',auth()->user()->username)->get();
        $data = [
            'messages'=>$messages,
        ];
        return view('stud_messages.index',$data);
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
        StudMessage::create($request->all());
        return redirect()->route('stud_message.index');
    }

    public function read(StudMessage $stud_message)
    {
        $owner = $stud_message->to;
        if($owner != auth()->user()->username){
            $words = "你想做什麼！偷看別人信件是違法的行為！！";
            return view('layouts.error',compact('words'));
        }

        $att['read'] = "1";
        $stud_message->update($att);

        $message['date'] = $stud_message->created_at;
        $user = \App\User::where('username','=',$stud_message->from)->first();
        $message['from'] = $user->name;
        $message['title'] = $stud_message->title;
        $message['content'] = $stud_message->content;
        $message['username'] = $stud_message->from;

        return view('stud_messages.read',compact('message'));
    }

    public function close()
    {
        echo "<html><body>
			<script LANGUAGE=\"JavaScript\">\n
			window.opener.history.go(0);\n
       			window.close();
			</script>
			</body>
			</html>";
        exit;
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
