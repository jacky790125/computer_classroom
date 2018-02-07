<?php

namespace App\Http\Controllers;

use App\Discuss;
use Illuminate\Http\Request;

class DiscussController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discusses = Discuss::where('depend_on','=','0')
            ->where('bad','=',null)
            ->orderBy('id','DESC')
            ->paginate(10);

        $bad_discusses = Discuss::where('bad','=','1')
            ->get();

        $data = [
            'discusses'=>$discusses,
            'bad_discusses'=>$bad_discusses,
        ];
        return view('discusses.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discusses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Discuss::create($request->all());
        return redirect()->route('discuss.index');
    }

    public function reply_store(Request $request)
    {
        Discuss::create($request->all());
        $discuss = Discuss::where('id','=',$request->input('depend_on'))->first();
        $att['reply'] = $discuss->reply+1;
        $discuss->update($att);
        return redirect()->route('discuss.show',$request->input('depend_on'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discuss $discuss)
    {
        if(session('view'.$discuss->id) != "1") {
            $att['views'] = $discuss->views+1;
            $discuss->update($att);
            session(['view'.$discuss->id => '1']);
        }

        $replys = Discuss::where('depend_on','=',$discuss->id)
            ->where('bad','=',null)
            ->get();

        $data=[
            'discuss'=>$discuss,
            'replys'=>$replys,
        ];
        return view('discusses.show',$data);
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
    public function destroy(Discuss $discuss)
    {
        if(!empty($discuss->user_id != auth()->user()->id)){
            $words = " 這不是你的文章，你想做什麼？！";
            return view('layouts.error',compact('words'));
        }else{
            $discuss->delete();
            Discuss::where('depend_on','=',$discuss->id)->delete();
        }
        return redirect()->route('discuss.index');
    }

    public function admin_destroy(Discuss $discuss)
    {
        $discuss->delete();
        Discuss::where('depend_on','=',$discuss->id)->delete();
        return redirect()->route('discuss.index');

    }

    public function reply_destroy(Discuss $discuss)
    {
        if(!empty($discuss->user_id != auth()->user()->id)){
            $words = " 這不是你的回文，你想做什麼？！";
            return view('layouts.error',compact('words'));
        }else{
            $discuss->delete();
        }
        return redirect()->route('discuss.show',$discuss->depend_on);
    }

    public function say_bad(Discuss $discuss)
    {
        $att['bad'] = 1;
        $att['say_bad'] = auth()->user()->id;
        $discuss->update($att);
        return redirect()->route('discuss.index');
    }

    public function reply_say_bad(Discuss $discuss)
    {
        $att['bad'] = 1;
        $att['say_bad'] = auth()->user()->id;
        $discuss->update($att);
        return redirect()->route('discuss.show',$discuss->depend_on);
    }
}
