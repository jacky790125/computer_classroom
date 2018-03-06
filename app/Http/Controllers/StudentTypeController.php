<?php

namespace App\Http\Controllers;

use App\Group;
use App\StudMoney;
use App\StudType;
use App\StudTypeArticle;
use App\User;
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
        if(auth()->check()) {
            $types = StudType::where('user_id', '=', auth()->user()->id)
                ->orderBy('score', 'DESC')->first();
            if (empty($types)) {
                $stud_type = 0;
            } else {
                $stud_type = $types->score;
            }
        }else{
            $stud_type=null;
        }

        $data =[
            'articles' => $articles,
            'stud_type' => $stud_type,
        ];
        return view('student_types.index',$data);
    }

    public function typing(StudTypeArticle $article)
    {
        $iphone        = strstr($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $ipad          = strstr($_SERVER['HTTP_USER_AGENT'], "iPad");
        $android       = strstr($_SERVER['HTTP_USER_AGENT'], "Android");
        $windows_phone = strstr($_SERVER['HTTP_USER_AGENT'], "Windows Phone");
        $black_berry   = strstr($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
        if ($iphone) {
            $words = "用 iphone 哀鳳 不好，請使用桌機練習打字！";
        } elseif ($ipad) {
            $words = "用 ipad 哀配 不好，請使用桌機練習打字！";
        } elseif ($android) {
            $words = "用 android 安卓 不好，請使用桌機練習打字！";
        } elseif ($windows_phone) {
            $words = "用 windows phone 微軟手機 不好，請使用桌機練習打字！";
        } elseif ($black_berry) {
            $words = "用 black berry 黑莓機 不好，請使用桌機練習打字！";
        } else {
            $words = "";
        }
        if(!empty($words)){
            return redirect()->route('error',$words);
        }

        $type_key = "type".auth()->user()->id;
        session([$type_key => null]);
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
        $types = StudType::where('user_id','=',auth()->user()->id)
            ->orderBy('score','DESC')->first();
        if(empty($types)){
            $stud_type = 0;
        }else{
            $stud_type = $types->score;
        }
        if($stud_type != "0"){
            if($request->input('timer') < 180){
                $words = "你打不到三分鐘！不列入成績！";
                return redirect()->route('error',$words);
            }
        }else{
            if($request->input('timer') < 60){
                $words = "首次打字你打不到一分鐘！不列入成績！";
                return redirect()->route('error',$words);
            }
        }

        $att['user_id'] = $request->input('user_id');
        $att['rightcount'] = $request->input('rightcount');
        $att['wrongcount'] = $request->input('wrongcount');
        $att['score'] = $request->input('score');
        $att['notype'] = $request->input('notype');
        $att['timer'] = $request->input('timer');
        $att['stud_type_article_id'] = $request->input('stud_type_article_id');

        $type_key = "type".auth()->user()->id;
        if(!session($type_key)) {
            session([$type_key => '1']);
            $type_stu = StudType::create($att);
            $article = StudTypeArticle::where('id', '=', $att['stud_type_article_id'])->first();
            $att2['user_id'] = auth()->user()->id;
            $att2['thing'] = "student_type";
            $att2['thing_id'] = $type_stu->id;
            $att2['stud_money'] = $request->input('score');
            $att2['description'] = "打字「" . $article->title . "」得分";

            StudMoney::create($att2);

            echo "<html><body>
			<script LANGUAGE=\"JavaScript\">
			opener.location.reload();
       			window.close();
			</script>
			</body>
			</html>";
            exit;
        }else{
            $words = "你想做什麼？";
            return redirect()->route('error',$words);
        }
    }

    public function admin_index()
    {
        $articles = StudTypeArticle::orderBy('words')->get();
        $data = [
            'articles'=> $articles,
        ];
        return view('admin.student_types.index',$data);
    }

    public function admin_show(Request $request)
    {
        $groups_o = Group::all()->pluck('name', 'id')->toArray();
        foreach($groups_o as $k=>$v){
            if($k != 1 and $k != 2) {
                $groups[$k] = $v;
            }else{
                $groups = [];
            }
        }
        $group = $request->input('group_id');

        if(!empty($group)){
            $users = User::where('group_id','=',$group)->orderBy('year_class_num')->get();
        }else{
            $users =[];
        }

        $data = [
            'groups'=>$groups,
            'group'=>$group,
            'users'=>$users,
        ];
        return view('admin.student_types.show',$data);
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


    public function types()
    {
        $moneys = StudMoney::where('thing','=','student_type')
            ->orderBy('created_at','DESC')
            ->orderBy('user_id')
            ->orderBy('id','DESC')
            ->paginate(50);
        $data = [
            'moneys'=>$moneys,
        ];
        return view('admin.student_types.types',$data);
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
