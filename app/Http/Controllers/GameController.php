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

    public function game01()
    {
        $total_money = get_stud_total_money();
        if($total_money < 50){
            $words = "剩下來的資訊幣不夠喔！你可以靠「作業得分」、「打字」、「按讚」來增加喔！";
            return view('layouts.error',compact('words'));
        }

        $att2['user_id'] = auth()->user()->id;
        $att2['thing'] = "gaming";
        $att2['thing_id'] = "01";
        $att2['stud_money'] = "-50";
        $att2['description'] = "玩「水果忍者」扣了點數！";

        StudMoney::create($att2);

        return view('games.game01');
    }
}
