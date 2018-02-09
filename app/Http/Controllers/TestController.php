<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

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
        $course = ($request->input('course_id'))?$request->input('course_id'):"";

        $data = [
            'courses'=>$courses,
            'course_menu'=>$course_menu,
            'course'=>$course,
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
