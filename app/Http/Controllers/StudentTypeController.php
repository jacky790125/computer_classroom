<?php

namespace App\Http\Controllers;

use App\StudMoney;
use App\StudType;
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
        $articles = StudTypeArticle::orderBy('words')->get();
        $data =[
            'articles' => $articles,
        ];
        return view('student_types.index',$data);
    }

    public function typing(StudTypeArticle $article)
    {
        $words = mb_str_split($article->content);
        $i = 0;
        $j = 0;
        foreach($words as $k=>$v){
            if(!isset($str[$i])) $str[$i] = null;
            $str[$i] = $str[$i].$v;
            $id[$k] = "sc".$i."-".$j;
            $j++;
            if($k%24 == 23){
                $i++;
                $j = 0;
            }
        }
        $data = [
            //'words'=>$words,
            'str'=>$str,
            'article'=>$article,
            'id'=>$id,
        ];
        return view('student_types.typing',$data);
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


        StudType::create($att);

        $att2['user_id'] = auth()->user()->id;
        $att2['thing'] = "student_type";
        $att2['thing_id'] = $request->input('article_id');
        $att2['stud_money'] = $request->input('score');
        $att2['description'] = "打字得分";

        StudMoney::create($att2);

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
        $att['language'] = $request->input('language');
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $ary_phase = array("\r\n","\r","\n");
        $att['content'] = str_replace($ary_phase,'',$att['content']);
        if($att['language'] == "1"){
            $att['content'] = str_replace(' ','',$att['content']);
            $att['content'] = str_replace('　','',$att['content']);
            $words_array = mb_str_split($att['content']);
            $att['words'] = count($words_array);
        }elseif($att['language'] == "2"){
            $words_array = str_split($att['content']);
            $att['words'] = count($words_array);
        }
        StudTypeArticle::create($att);
        return redirect()->route('student_type.admin_index');
    }

    public function admin_delete(StudTypeArticle $stud_type_article)
    {
        $stud_type_article->delete();
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
