<?php

namespace App\Http\Controllers;

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
        return view('games.do10');
    }
}
