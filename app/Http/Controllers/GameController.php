<?php

namespace App\Http\Controllers;

use App\AskCourse;
use App\AskQuestion;
use App\AskRecord;
use App\StudMoney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('games.index');
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
        //
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

    public function getGame($game_name)
    {
        $path = storage_path('app/public/games/'.$game_name);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function html5_game($id)
    {
        $cost = "";
        $title ="";
        $page = "";
        if($id=="01"){
            $cost = 90;
            $title = "水果忍者";
            $page = "fruit-ninja/index.html";
        }

        if($id=="02") {
            $cost = 50;
            $title = "Flappy Bird";
            $page = "flappy-bird/index.html";
        }

        if($id=="03"){
            $cost = 80;
            $title = "太空戰機";
            $page = "fly/play.html";
        }

        if($id=="04"){
            $cost = 60;
            $title = "Flappy Text";
            $page = "flappy-text/index.html";
        }

        if($id=="05"){
            $cost = 40;
            $title = "五子棋";
            $page = "wuziqi/game.html";
        }

        if($id=="06"){
            $cost = 60;
            $title = "方塊消除";
            $page = "remove-game/index.html";
        }

        if($id=="07"){
            $cost = 60;
            $title = "推箱子";
            $page = "canvas-box/index.html";
        }

        if($id=="08"){
            $cost = 60;
            $title = "簡易Mario";
            $page = "simple-mario/index.html";
        }

        if($id=="09"){
            $cost = 70;
            $title = "Mario";
            $page = "mario/index.html";
        }

        if($id=="10"){
            $cost = 70;
            $title = "坦克";
            $page = "simple-tank/index2.html";
        }

        if($id=="11"){
            $cost = 50;
            $title = "俄羅期方塊";
            $page = "tetris/index.html";
        }

        if($id=="12"){
            $cost = 30;
            $title = "象棋";
            $page = "jiaoben/index.html";
        }


        $total_money = get_stud_total_money(auth()->user()->id);
        if($total_money < $cost){
            $words = "你的資訊幣不夠喔！你可以靠「作業得分」、「打字」、別人「按讚」來增加喔！";
            return redirect()->route('error',$words);
        }

        $att2['user_id'] = auth()->user()->id;
        $att2['thing'] = "gaming";
        $att2['thing_id'] = "01";
        $att2['stud_money'] = "-".$cost;
        $att2['description'] = "玩「".$title."」扣了點數！";

        StudMoney::create($att2);


        $data =[
            'page'=>$page
        ];
        return view('games.html5_game',$data);
    }

    public function do10()
    {
        session(['do10' => '']);
        return view('games.do10');
    }

    public function do10_done(Request $request)
    {
        if(empty($request->input('set_number')) and $request->input('set_number') != "0"){
            $words = "你沒有選數字啦！";
            return redirect()->route('error',$words);
        }

        $total_money = get_stud_total_money(auth()->user()->id);
        if($total_money < $request->input('set_money')){
            $words = "你的資訊幣不夠喔！";
            return redirect()->route('error',$words);
        }

        if(session('do10') != "1") {

            $number = rand(0, 9);

            $att2['user_id'] = auth()->user()->id;
            $att2['thing'] = "gaming do10";
            if ($number == $request->input('set_number')) {
                $att2['stud_money'] = $request->input('set_money') * 10;
                $att2['description'] = "玩「十賭九輸」贏了十倍點數！";
            } else {
                $att2['stud_money'] = "-" . $request->input('set_money');
                $att2['description'] = "玩「十賭九輸」扣了點數！";
            }

            StudMoney::create($att2);

            session(['do10' => '1']);
        }else{
            $words = "不要使用F5或是重新整理頁面喔！";
            return redirect()->route('error',$words);
        }

        $data = [
            'set_number'=>$request->input('set_number'),
            'set_money'=>$request->input('set_money'),
            'number'=>$number,
        ];
        return view('games.do10_done',$data);
    }

    public function quick_ask()
    {
        $ask_courses = AskCourse::orderBy('id','ASC')->pluck('name', 'id')->toArray();
        $data = [
            'ask_courses'=>$ask_courses,
        ];
        return view('games.quick_ask',$data);
    }

    public function quick_ask_admin()
    {
        $ask_courses = AskCourse::all();
        $ask_course_menu = AskCourse::orderBy('id','ASC')->pluck('name', 'id')->toArray();
        $select_ask_course = [];
        $ask_questions = [];
        $data = [
            'ask_courses'=>$ask_courses,
            'ask_course_menu'=>$ask_course_menu,
            'select_ask_course'=>$select_ask_course,
            'ask_questions'=>$ask_questions,
        ];
        return view('games.quick_ask_admin',$data);
    }

    public function quick_ask_store(Request $request)
    {
        $att['name'] = $request->input('name');
        AskCourse::create($att);
        return redirect()->route('quick_ask_admin');
    }

    public function quick_ask_select($id)
    {
        $select_ask_course = AskCourse::where('id','=',$id)->first();
        $ask_courses = AskCourse::all();
        $ask_course_menu = AskCourse::orderBy('id','ASC')->pluck('name', 'id')->toArray();
        $ask_questions = AskQuestion::where('ask_course_id','=',$id)->get();



        $data = [
            'ask_courses'=>$ask_courses,
            'ask_course_menu'=>$ask_course_menu,
            'select_ask_course'=>$select_ask_course,
            'ask_questions'=>$ask_questions,
        ];
        return view('games.quick_ask_admin',$data);
    }

    public function question_store(Request $request)
    {
        $att['ask_course_id'] = $request->input('ask_course_id');
        $att['title'] = $request->input('title');
        $att['ans_A'] = $request->input('ans_A');
        $att['ans_B'] = $request->input('ans_B');
        $att['ans_C'] = $request->input('ans_C');
        $att['ans_D'] = $request->input('ans_D');
        $ask_question = AskQuestion::create($att);

        $files = $request->file('file');
        if(!empty($files)) {
            foreach ($files as $k => $v) {
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    //'original_filename' => $file->getClientOriginalName(),
                    'extension' => $v->getClientOriginalExtension(),
                    //'size' => $file->getClientSize(),
                ];
                $path = "public/quick/" . $ask_question->id . "/";
                $filename = $k . "." . $info['extension'];

                $v->storeAs($path, $filename);

                $att2[$k] = $path . $filename;
            }
            $ask_question->update($att2);
        }
        return redirect()->route('quick_ask_select',$ask_question->ask_course_id);

    }

    public function quick_course_delete(AskCourse $ask_course)
    {
        $ask_course->delete();
        return redirect()->route('quick_ask_admin');
    }

    public function quick_question_delete(AskQuestion $ask_question)
    {
        $fileT = $ask_question->title_img;
        $fileA = $ask_question->ans_A_img;
        $fileB = $ask_question->ans_B_img;
        $fileC = $ask_question->ans_C_img;
        $fileD = $ask_question->ans_D_img;
        if(!empty($fileT)){
            $path = storage_path('app/'.$fileT);
            if(file_exists($path)) unlink($path);
        }
        if(!empty($fileA)){
            $path = storage_path('app/'.$fileA);
            if(file_exists($path)) unlink($path);
        }
        if(!empty($fileB)){
            $path = storage_path('app/'.$fileB);
            if(file_exists($path)) unlink($path);
        }
        if(!empty($fileC)){
            $path = storage_path('app/'.$fileC);
            if(file_exists($path)) unlink($path);
        }
        if(!empty($fileD)){
            $path = storage_path('app/'.$fileD);
            if(file_exists($path)) unlink($path);
        }

        $ask_question->delete();

        return redirect()->route('quick_ask_select',$ask_question->ask_course_id);
    }


    public function quick_ask_go(Request $request)
    {
        $ask_course_id = $request->input('ask_course_id');
        if(empty($ask_course_id)){
            $words = "請選擇題庫！";
            return view('layouts.error',compact('words'));
        }

        AskRecord::where('user_id','=',auth()->user()->id)
            ->where('ask_course_id','=',$request->input('ask_course_id'))
            ->where('play_date','<>',date('Ymd'))
            ->delete();
        $play_times = AskRecord::where('user_id','=',auth()->user()->id)
            ->where('ask_course_id','=',$request->input('ask_course_id'))
            ->where('play_date','=',date('Ymd'))
            ->get()
            ->count();

        if($play_times >2){
            $words =  "你今天挑戰過三次了，好好讀書再挑戰！ [<a href='".env('QUICK_ASK')."'>返回</a>]";
            return view('layouts.error',compact('words'));
        }

        $course = AskCourse::where('id','=',$ask_course_id)->first();

        session(['n' => null]);
        session(['wrong' => null]);

        $questions = AskQuestion::where('ask_course_id','=',$ask_course_id)
            ->get()->shuffle();
        $num =1 ;
        foreach($questions as $question){
            if($num == 16 ) break;
            session(['q'.$num => $question->id]);
            session(['a'.$num => null]);
            session(['begin'.$num => null]);
            $num++;
        }



        $data = [
            'course'=>$course,
        ];
        return view('games.quick_ask_go',$data);
    }

    public function quick_ask_do($id)
    {
        if(session('n') == null){
            $att['ask_course_id'] = $id;
            $att['user_id'] = auth()->user()->id;
            $att['play_date'] = date('Ymd');
            AskRecord::create($att);
        }

        if(session('wrong') > 2) {
            $words =  "挑戰失敗！ [<a href='".env('QUICK_ASK')."'>返回</a>]";
            return view('layouts.error',compact('words'));
        }

        //避免F5
        if(session('begin'.session('n')) != null and session('a' .session('n')) ==null){
            $words =  "按F5或重新整理，即結束！ [<a href='".env('QUICK_ASK')."'>返回</a>]";
            return view('layouts.error',compact('words'));
        }

        $course = AskCourse::where('id','=',$id)->first();
        $questions = AskQuestion::where('ask_course_id','=',$id)
            ->get();

        $num =1 ;
        foreach($questions as $question){
            $question_data[$question->id]['title'] = $question->title;
            $question_data[$question->id]['ans_1'] = "A"."-".$question->ans_A;
            $question_data[$question->id]['ans_2'] = "B"."-".$question->ans_B;
            $question_data[$question->id]['ans_3'] = "C"."-".$question->ans_C;
            $question_data[$question->id]['ans_4'] = "D"."-".$question->ans_D;
            $question_data[$question->id]['img_title'] = $question->title_img;
            $question_data[$question->id]['img_A'] = $question->ans_A_img;
            $question_data[$question->id]['img_B'] = $question->ans_B_img;
            $question_data[$question->id]['img_C'] = $question->ans_C_img;
            $question_data[$question->id]['img_D'] = $question->ans_D_img;

            for($i=1;$i<=4;$i++){
                $r = rand(1,4);
                $temp = $question_data[$question->id]['ans_'.$i];
                $question_data[$question->id]['ans_'.$i] = $question_data[$question->id]['ans_'.$r];;
                $question_data[$question->id]['ans_'.$r] = $temp;
            }
            $num++;
        }

        $data = [
            'course'=>$course,
            'question_data'=>$question_data,
        ];
        return view('games.quick_ask_do',$data);

    }

    public function quick_ask_answer(Request $request)
    {
        if(!empty(session('a'.$request->input('num')))){
            $words = "你想做什麼？你按了上一頁，或重新整理！計失敗一次";
            return view('layouts.error',compact('words'));
        }

        $course = AskCourse::where('id','=',$request->input('id'))->first();

        if($request->input('answer')=="A"){
            session(['a'.$request->input('num') => 'right']);
        }else{
            session(['a'.$request->input('num') => 'wrong']);


            if(empty(session('wrong'))){
                session(['wrong'=>1]);
            }else{
                session(['wrong'=> session('wrong')+1]);
            }
        }
        $data = [
            'course'=>$course,
        ];
        return view('games.quick_ask_answer',$data);
    }

    public function quick_ask_money(Request $request)
    {
        $play_time = StudMoney::where('user_id','=',auth()->user()->id)
            ->where('thing_id','=',$request->input('id'))
            ->where('thing','=','quick_ask')
            ->get()
            ->count();
        if($play_time > 2){
            $words = "你已過關三次，不計入成績！ [<a href='".env('QUICK_ASK')."'>返回</a>]";
            return view('layouts.error',compact('words'));
        }

        if(session('n')==15) {
            $att['user_id'] = auth()->user()->id;
            $att['thing'] = "quick_ask";
            $att['thing_id'] = $request->input('id');
            $att['stud_money'] = "500";
            $att['description'] = "玩「" . $request->input('name') . "」過關500元！";

            StudMoney::create($att);
        }else{
            $words = "你想做什麼？你按了上一頁，或重新整理！計失敗一次";
            return view('layouts.error',compact('words'));
        }

        session(['n' => null]);


        return redirect()->route('quick_ask');
    }


    public function question_view_img($img,$id)
    {
        $ask_question = AskQuestion::where('id','=',$id)->first();
        echo "<img src=".url('quick_question/show_img/'.$ask_question->id.'/'.$img).">";

    }

    public function getImg($id,$img)
    {
        $ask_question = AskQuestion::where('id','=',$id)->first();
        if($img == "title_img") $file = $ask_question->title_img;
        if($img == "ans_A_img") $file = $ask_question->ans_A_img;
        if($img == "ans_B_img") $file = $ask_question->ans_B_img;
        if($img == "ans_C_img") $file = $ask_question->ans_C_img;
        if($img == "ans_D_img") $file = $ask_question->ans_D_img;

        $path = storage_path('app/'.$file);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
