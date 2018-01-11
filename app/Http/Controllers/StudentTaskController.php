<?php

namespace App\Http\Controllers;

use App\StudentTask;
use Illuminate\Http\Request;

class StudentTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //變數
        $user_id = (auth()->check())?auth()->user()->id:"";
        $student_tasks = StudentTask::where('user_id','=',$user_id)
            ->orderBy('id','DESC')
            ->paginate(5);
        $data = [
            'student_tasks'=>$student_tasks,
        ];
        return view('student_tasks.index',$data);
    }

    public function upload(StudentTask $student_task)
    {
        if(!empty($student_task->report)){
            $words = " 這項作業你已經交了！";
            return view('layouts.error',compact('words'));
        }
        $data = [
            'student_task'=>$student_task,
        ];
        return view('student_tasks.upload',$data);
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
    public function store(Request $request,StudentTask $student_task)
    {
        if(empty($request->input('report'))){
            $words = " 沒有輸入東西！";
            return view('layouts.error',compact('words'));
        }
        $student_task->update($request->all());
        return redirect()->route('student_task.index');
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
