<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudentTask;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //變數
        $groups = [];

        $types = [
            'text'=>'1_填文字',
            'img'=>'2_傳圖片',
            'aud'=>'3_傳聲音',
            'mov'=>'4_傳影片',
            'scratch2'=>'5_傳小貓咪2',
            'file'=>'6_傳檔案',

        ];

        $gs = Group::where('active','=','1')
            ->where('name','like','1%')
            ->get();

        if(!empty($gs)) {
            foreach ($gs as $g) {
                if (!isset($groups[$g->id])) $groups[$g->id] = null;
                $groups[$g->id] = $g->name . "(id:" . $g->id . ")";
            }
        }


        $tasks = Task::orderBy('id','DESC')->get();

        $data = [
            'types'=>$types,
            'groups'=>$groups,
            'tasks' =>$tasks,
        ];
        return view('admin.tasks.index',$data);
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
        //變數
        $att['for'] = "";
        $students =[];
        $i = 0;

        $for = $request->input('for');
        foreach( $for as $k =>$v){
            $att['for'] .= $v.',';
        }
        $att['for'] = substr($att['for'],0,-1);
        $att['type'] = $request->input('type');
        $att['title'] = $request->input('title');
        $att['description'] = $request->input('description');
        $task = Task::create($att);

        foreach($for as $v){
            $users = User::where('group_id','=',$v)->get();
            foreach($users as $user) {
                $students[$i]['id'] = $user->id;
                $students[$i]['year_class_num'] = $user->year_class_num;
                $i++;
            }
        }

        foreach($students as $v){
            $att1['task_id'] = $task->id;
            $att1['user_id'] = $v['id'];
            $att1['year_class_num'] = $v['year_class_num'];
            StudentTask::create($att1);
        }

        return redirect()->route('admin.task.index');
    }

    public function view($select,$for,$task_id)
    {
        $get_groups = explode(',',$for);
        $groups_collection = DB::table('groups')
            ->whereIn('id', $get_groups)
            ->get();
        $i=0;
        foreach($groups_collection as $group){
            $group_tab[$i]['name'] = $group->name;
            $group_tab[$i]['id'] = $group->id;
            $i++;
        }


        $student_tasks = StudentTask::where('task_id','=',$task_id)
            ->orderBy('year_class_num')
            ->get();
        foreach($student_tasks as $student_task){
            $has_done[$student_task->user_id]['年班'] = $student_task->year_class_num;
            $has_done[$student_task->user_id]['作業'] = $student_task->report;
            $has_done[$student_task->user_id]['分數'] = $student_task->score;
            $has_done[$student_task->user_id]['評語'] = $student_task->saying;
            $has_done[$student_task->user_id]['序號'] = $student_task->id;
        }
        //班級學生
        $students = User::where('group_id','=',$group_tab[$select]['id'])
            ->orderBy('year_class_num')
            ->get();
        foreach($students as $student){
            if(empty($has_done[$student->id]['作業'])) $has_done[$student->id]['作業']="";
            if(empty($has_done[$student->id]['分數'])) $has_done[$student->id]['分數']="";
            if(empty($has_done[$student->id]['評語'])) $has_done[$student->id]['評語']="";
            if(empty($has_done[$student->id]['年班'])) $has_done[$student->id]['作業']="未指派！";
        }

        $data=[
            'group_tab'=>$group_tab,
            'select'=>$select,
            'for'=>$for,
            'task_id'=>$task_id,
            'students'=>$students,
            'has_done'=>$has_done,
        ];

        return view('admin.tasks.view',$data);
    }

    public function view_one(StudentTask $student_task)
    {
        $data = [
            'student_task'=>$student_task,
        ];
        return view('admin.tasks.view_one',$data);
    }

    public function add_student_task($task_id,$user_id)
    {
        $att['task_id'] = $task_id;
        $att['user_id'] = $user_id;
        $student = User::where('id','=',$user_id)->first();
        $att['year_class_num'] = $student->year_class_num;
        StudentTask::create($att);
        return redirect()->route('admin.task.index');

    }

    public function stud_store(Request $request)
    {
        $score = $request->input('score');
        $saying = $request->input('saying');
        foreach($score as $k => $v){
            $att['score'] = $v;
            $att['saying'] = $saying[$k];
            StudentTask::where('id','=',$k)->update($att);
        }

        return redirect()->route('admin.task.index');

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
    public function destroy(Task $task)
    {
        $task->delete();
        StudentTask::where('task_id','=',$task->id)->delete();
        return redirect()->route('admin.task.index');
    }
}
