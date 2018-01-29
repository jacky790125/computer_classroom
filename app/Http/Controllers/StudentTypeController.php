<?php

namespace App\Http\Controllers;

use App\StudTypeArticle;
use Illuminate\Http\Request;

class StudentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student_types.index');
    }

    public function typing()
    {
        return view('student_types.typing');
    }

    public function store_typing(Request $request)
    {
        $att['user_id'] = $request->input('user_id');
        $att['rightcount'] = $request->input('rightcount');
        $att['wrongcount'] = $request->input('wrongcount');
        $att['score'] = $request->input('score');
        $att['notype'] = $request->input('notype');
        $att['timer'] = $request->input('timer');
        $att['article_id'] = $request->input('article_id');
        dd($att);
        StudentTypeController::create($request->all());
        echo "<html><body>
			<script LANGUAGE=\"JavaScript\">\n
			window.opener.history.go(0);\n
       			window.close();
			</script>
			</body>
			</html>";
        exit;
    }

    public function admin_index()
    {
        $articles = StudTypeArticle::orderBy('id')->get();
        $data = [
            'articles'=> $articles,
        ];
        return view('admin.student_types.index',$data);
    }

    public function admin_store(Request $request)
    {
        $att = $request->all();
        StudTypeArticle::create($att);
        return redirect()->route('student_type.admin_index');
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
