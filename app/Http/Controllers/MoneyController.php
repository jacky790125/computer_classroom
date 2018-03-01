<?php

namespace App\Http\Controllers;

use App\StudMoney;
use App\StudType;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moneys = StudMoney::where('stud_money','>','0')
            ->orderBy('created_at','DESC')
            ->orderBy('user_id')
            ->orderBy('id','DESC')
            ->paginate(50);
        $data = [
            'moneys'=>$moneys,
        ];
        return view('admin.money.index',$data);
    }

    public function destroy_check(Request $request)
    {
        $stud_money = $request->input('stud_money');
        foreach($stud_money as $k => $v){
            $stud_money = StudMoney::where('id','=',$v)->first();
            $stud_money->delete();
            StudType::where('id','=',$stud_money->thing_id)->delete();
        }
        return redirect()->route('money.admin_index');
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
}
