<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Course::all();
        $course_menu = Course::all()->pluck('name', 'id')->toArray();
        $course_id = ($request->input('course_id'))?$request->input('course_id'):"";
        if(empty($course_id)){
            $num = "";
        }else{
            $num = CourseQuestion::where('course_id','=',$course_id)->count();
        }

        $data = [
            'courses'=>$courses,
            'course_menu'=>$course_menu,
            'course_id'=>$course_id,
            'num'=>$num,
        ];
        return view('admin.tests.index',$data);
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
    public function course_store(Request $request)
    {
        Course::create($request->all());
        return redirect()->route('admin.test.course_index');
    }

    public function course_update(Request $request,Course $course)
    {
        $course->update($request->all());
        return redirect()->route('admin.test.course_index');
    }

    public function course_delete(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.test.course_index');
    }

    public function question_index(Request $request)
    {
        $course_menu = Course::all()->pluck('name', 'id')->toArray();
        $course_id = ($request->input('course_id'))?$request->input('course_id'):"";

        $questions = CourseQuestion::where('course_id','=',$request->input('course_id'))->get();

        $data = [
            'questions'=>$questions,
            'course_menu'=>$course_menu,
            'course_id'=>$course_id,
        ];
        return view('admin.tests.question',$data);
    }


    public function question_store(Request $request)
    {
        $att['course_id'] = $request->input('course_id');
        $att['title'] = $request->input('title');
        $att['ans_A'] = $request->input('ans_A');
        $att['ans_B'] = $request->input('ans_B');
        $att['ans_C'] = $request->input('ans_C');
        $att['ans_D'] = $request->input('ans_D');
        $course_question = CourseQuestion::create($att);

        $files = $request->file('file');
        if(!empty($files)) {
            foreach ($files as $k => $v) {
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    //'original_filename' => $file->getClientOriginalName(),
                    'extension' => $v->getClientOriginalExtension(),
                    //'size' => $file->getClientSize(),
                ];
                $path = "public/questions/" . $course_question->id . "/";
                $filename = $k . "." . $info['extension'];

                $v->storeAs($path, $filename);

                $att2[$k] = $path . $filename;
            }
            $course_question->update($att2);
        }

        return redirect()->route('admin.test.course_index',['course_id'=>$att['course_id']]);

    }

    public function question_update(Request $request,CourseQuestion $course_question)
    {
        $att['title'] = $request->input('title');
        $att['ans_A'] = $request->input('ans_A');
        $att['ans_B'] = $request->input('ans_B');
        $att['ans_C'] = $request->input('ans_C');
        $att['ans_D'] = $request->input('ans_D');
        $course_question ->update($att);

        $files = $request->file('file');
        if(!empty($files)) {
            foreach ($files as $k => $v) {
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    //'original_filename' => $file->getClientOriginalName(),
                    'extension' => $v->getClientOriginalExtension(),
                    //'size' => $file->getClientSize(),
                ];
                $path = "public/questions/" . $course_question->id . "/";
                $filename = $k . "." . $info['extension'];

                $v->storeAs($path, $filename);

                $att2[$k] = $path . $filename;
            }
            $course_question->update($att2);
        }

        return redirect()->route('admin.test.question',['course_id'=>$course_question->course_id]);

    }

    public function question_delete_img($img,$id)
    {
        $att[$img] = null;
        $course_question = CourseQuestion::where('id','=',$id)->first();

        if($img == "title_img") $file = '../storage/app/'.$course_question->title_img;
        if($img == "ans_A_img") $file = '../storage/app/'.$course_question->ans_A_img;
        if($img == "ans_B_img") $file = '../storage/app/'.$course_question->ans_B_img;
        if($img == "ans_C_img") $file = '../storage/app/'.$course_question->ans_C_img;
        if($img == "ans_D_img") $file = '../storage/app/'.$course_question->ans_D_img;

        if(file_exists($file)) unlink($file);

        $course_question->update($att);

        return redirect()->route('admin.test.question',['course_id'=>$course_question->course_id]);
    }

    public function question_view_img($img,$id)
    {
        $course_question = CourseQuestion::where('id','=',$id)->first();
        echo "<img src=".url('question/show_img/'.$course_question->id.'/'.$img)." width=100%>";

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

    public function getImg($id,$img)
    {
        $course_question = CourseQuestion::where('id','=',$id)->first();
        if($img == "title_img") $file = $course_question->title_img;
        if($img == "ans_A_img") $file = $course_question->ans_A_img;
        if($img == "ans_B_img") $file = $course_question->ans_B_img;
        if($img == "ans_C_img") $file = $course_question->ans_C_img;
        if($img == "ans_D_img") $file = $course_question->ans_D_img;

        $path = storage_path('app/'.$file);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
