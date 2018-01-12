<?php

namespace App\Http\Controllers;

use App\StudentTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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
            ->paginate(10);
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

    public function view(StudentTask $student_task)
    {

        if($student_task->user_id != auth()->user()->id){
            $words = " 這項作業不是你的！";
            return view('layouts.error',compact('words'));
        }

        $data = [
            'student_task'=>$student_task,
        ];
        return view('student_tasks.view',$data);
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
        if($request->input('type')=='text') {
            if(empty($request->input('report'))){
                $words = " 沒有輸入東西！";
                return view('layouts.error',compact('words'));
            }
            $att['report'] = $request->input('report');
            $att['public'] = $request->input('public');
            $student_task->update($att);
        }else{
            if($request->hasFile('file')){
                $file = $request->file('file');

                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $type = explode('/',$info['mime-type']);
                $original_name = explode('.',$info['original_filename']);
                foreach($original_name as $v){
                    $last_name = $v;
                }

                if($request->input('type')=='img' and $type[0] != 'image'){
                    $words = " 你傳的不是圖片檔！";
                    return view('layouts.error',compact('words'));
                }

                if($request->input('type')=='aud' and $type[0] != 'audio'){
                    $words = " 你傳的不是聲音檔！";
                    return view('layouts.error',compact('words'));
                }

                if($request->input('type')=='mov' and $type[0] != 'video'){
                    $words = " 你傳的不是影片檔！";
                    return view('layouts.error',compact('words'));
                }

                if($request->input('type')=='scratch2' and $last_name != 'sb2'){
                    $words = " 你傳的不是小貓咪2！";
                    return view('layouts.error',compact('words'));
                }

                if($last_name == ''){
                    $words = " 你傳的檔案附檔名不見了？";
                    return view('layouts.error',compact('words'));
                }

                $path = "public/tasks/" . $request->input('task_id') . "/";
                $filename = auth()->user()->year_class_num . "." . $last_name;

                $file->storeAs($path,$filename);

                $att['report'] = "app/".$path.$filename;
                $att['public'] = $request->input('public');
                $student_task->update($att);

            }else{
                $words = " 沒有上傳任何東西！";
                return view('layouts.error',compact('words'));
            }
        }


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

    public function getFile(StudentTask $student_task)
    {
        $path = storage_path($student_task->report);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function downloadFile(StudentTask $student_task)
    {
        if($student_task->user_id != auth()->user()->id){
            $words = " 這項作業不是你的！";
            return view('layouts.error',compact('words'));
        }

        $filename = explode('/',$student_task->report);
        $realFile = "../storage/".$student_task->report;
        header("Content-type:application");
        header("Content-Length: " .(string)(filesize($realFile)));
        header("Content-Disposition: attachment; filename=".$filename[4]);
        readfile($realFile);
    }
}
