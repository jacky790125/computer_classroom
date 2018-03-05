<?php

namespace App\Http\Controllers;

use App\StudMessage;
use App\StudMoney;
use App\User;
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
        $to = $request->input('to');
        $user = User::where('username','=',$to)->first();
        if(empty($user)){
            $words = "無此帳號：".$to;
            return redirect()->route('error',$words);
        }

        $total_money = get_stud_total_money(auth()->user()->id);
        if($total_money < 10){
            $words = "你寄件要10元，但資訊幣不夠喔！你可以靠「作業得分」、「打字」、別人「按讚」來增加喔！";
            return redirect()->route('error',$words);
        }

        StudMessage::create($request->all());

        $att2['user_id'] = auth()->user()->id;
        $att2['thing'] = "send_message";
        $att2['stud_money'] = "-10";
        $att2['description'] = "「寄信」要扣分";
        StudMoney::create($att2);

        return redirect()->route('stud_message.index');
    }

    public function read(StudMessage $stud_message)
    {
        $owner = $stud_message->to;
        if($owner != auth()->user()->username){
            $words = "你想做什麼！偷看別人信件是違法的行為！！";
            return redirect()->route('error',$words);
        }

        $att['read'] = "1";
        $stud_message->update($att);

        $message['date'] = $stud_message->created_at;
        $user = \App\User::where('username','=',$stud_message->from)->first();
        $message['from'] = $user->name;
        $message['title'] = $stud_message->title;
        $message['content'] = $stud_message->content;
        $message['username'] = $stud_message->from;
        $message['user_id'] = $user->id;

        return view('stud_messages.read',compact('message'));
    }

    public function close()
    {
        echo "<html><body>
			<script LANGUAGE=\"JavaScript\">
			opener.location.reload();
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudMessage $stud_message)
    {
        $stud_message->delete();
        return redirect()->route('stud_message.index');
    }

    public function give(Request $request)
    {
        $user = User::where('username','=',$request->input('username'))->first();
        if(empty($user)){
            $words = "無此帳號：".$request->input('username');
            return redirect()->route('error',$words);
        }

        $att2['user_id'] = $user->id;
        $att2['thing'] = "admin_give";
        $att2['stud_money'] = $request->input('stud_money');
        $att2['description'] = $request->input('description');

        StudMoney::create($att2);

        return redirect()->route('admin.message.index');
    }
}
