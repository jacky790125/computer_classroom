<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="{{ asset('type/style_lite.css') }}" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="{{ asset('type/button.css') }}">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('type/bootstrap.min.css') }}">
<!-- Optional theme -->
<link rel="stylesheet" href="{{ asset('type/bootstrap-theme.min.css') }}">
<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('type/bootstrap.min.js') }}"></script>

	<style type="text/css">
body {-moz-user-select: none;}
/******************
disable select touch and hold and highlight colors
******************/
html {
    -webkit-user-select: none;
    -webkit-touch-callout: none;
    -webkit-tap-highlight-color:rgba(0,0,0,0);
    -webkit-user-drag: none;
    -khtml-user-select: none;
    -moz-user-select: -moz-none;
    -o-user-select: none;
    user-select: none;
}
</style>
</head>


<script type="text/javascript" src="{{ asset('type/jquery.js') }}"></script>
<style type="text/css">
	#abgne_float_ad {
		display: none;
		position: absolute;
		border:1px;
	}
</style>
<script type="text/javascript">
	// 當網頁載入完
	$(window).load(function(){
		var $win = $(window),
			$ad = $('#abgne_float_ad').css('opacity', 0).show(),	// 讓廣告區塊變透明且顯示出來
			_width = $ad.width(),
			_height = $ad.height(),
			_diffY = 30, _diffX = 150,	// 距離右及下方邊距
			_moveSpeed = 800;	// 移動的速度
		
		// 先把 #abgne_float_ad 移動到定點
		$ad.css({
			top: $(document).height(),
			opacity: 1
		});

		// 幫網頁加上 scroll 及 resize 事件
		$win.bind('scroll resize', function(){
			var $this = $(this);
			
			// 控制 #abgne_float_ad 的移動
			$ad.stop().animate({
				top: $this.scrollTop() + $this.height() - _height - _diffY
			}, _moveSpeed);
		}).scroll();	// 觸發一次 scroll()
	});
</script>
<script type="text/javascript">
$(document).ready(function () {
//用enter取代tab
 $(':input:enabled').addClass('enterIndex');
 // get only input tags with class data-entry
 textboxes = $('.enterIndex');
 // now we check to see which browser is being used
 if ($.browser.mozilla) {
 $(textboxes).bind('keypress', CheckForEnter); 
 } else {
 $(textboxes).bind('keydown', CheckForEnter); 
 }
});

function CheckForEnter(event) {
 if (event.keyCode == 13 && $(this).attr('type') != 'button' && $(this).attr('type') != 'submit' && $(this).prop('type') != 'textarea' && $(this).attr('type') != 'reset') {
 var i = $('.enterIndex').index($(this)); //現在是在第幾個 
 var n = $('.enterIndex').length; //總共有幾個 
 if (i < n - 1) {
 if ($(this).attr('type') != 'radio') //如果不是radio 
 { 
 NextDOM($('.enterIndex'),i); 
 }
 else { //如果是radio，不能focus到下一個，因為下一個可能是同樣name的radio 
 var last_radio = $('.enterIndex').index($('.enterIndex[type=radio][name=' + $(this).attr('name') + ']:last'));
 NextDOM($('.enterIndex'),last_radio); 
 } 
 }
 return false;
 }
}
function NextDOM(myjQueryObjects,counter) {
 if (myjQueryObjects.eq(counter+1)[0].disabled) {
 NextDOM(myjQueryObjects, counter + 1);
 }
 else {
 myjQueryObjects.eq(counter + 1).trigger('focus');
 }
}

var mystart=0;
function Gostart()
{
	if (mystart==0) {
	time_start = new Date();
	clock_start = time_start.getTime();
	timerid=setInterval("show_secs()",1000);
	document.getElementById('input0').readOnly=false;
document.getElementById('input1').readOnly=false;
document.getElementById('input2').readOnly=false;

	}
	mystart=1;
}
 </script>
<style type="text/css">
	span {display:inline-block;}
</style>
</head>
<body oncontextmenu="return false;" onkeydown="if(((event.shiftKey)&&(event.keyCode==121)) || event.altKey || event.keyCode==116 || (event.altKey && event.keyCode==115) || (event.keyCode==78 && event.ctrlKey) || ((event.ctrlKey)&&(event.keyCode==86))) return false;"  ondrag="return false;" onpaste="return false;" onselectstart ="return false;" onselect="document.selection.empty();" oncopy="document.selection.empty();" onbeforecopy="return false;">
<script language=javascript>
	@foreach($str as $k=>$v)
		typecontent{{ $k }}=new String ('{{ $v }}');
	@endforeach


function Justcheck() {
var alltime=600-i_total_secs;
if (i_total_secs==0) {alltime=600;}
rightcount=0;
wrongcount=0;
notype=0;
for (i=0;i<=2;i++){
	//newtype=document.getElementById('input'+i).value;
	newtype=$('#input'+i).val();
	thiscontent=eval('typecontent'+i);
	for (j=0;j<thiscontent.length;j++)
	{
			if (newtype.charAt(j)===thiscontent.charAt(j))
			{
				rightcount+=1;
				document.getElementById('rightexam').innerHTML="<font class=rightscore>"+rightcount+"</font>";
				document.getElementById('sc'+i+'-'+j).innerHTML="<font color=green>"+thiscontent.charAt(j)+"</font>";
				document.getElementById('examscore').innerHTML="<font class=totalscore>"+parseInt((rightcount/alltime)*60)+"</font>";
			} else {
				if (newtype.charAt(j)=='') {
				notype+=1;
				document.getElementById('notype').innerHTML="<font class=notype>"+notype+"</font>";
				 } else {
				wrongcount+=1;
				document.getElementById('errorexam').innerHTML="<font class=wrongscore>"+wrongcount+"</font>";
				document.getElementById('sc'+i+'-'+j).innerHTML="<font color=red>"+thiscontent.charAt(j)+"</font>";
				}
			}
	}
}
}

function Chcekall()
{
clearInterval(timerid);
rightcount=0;
wrongcount=0;
notype=0;
for (i=0;i<=2;i++){
	//newtype=document.getElementById('input'+i).value;
	newtype=$('#input'+i).val();
	thiscontent=eval('typecontent'+i);
	for (j=0;j<thiscontent.length;j++)
	{
			if (newtype.charAt(j)===thiscontent.charAt(j))
			{
				rightcount+=1;
				document.getElementById('rightexam').innerHTML="<font class=rightscore>"+rightcount+"</font>";
				document.getElementById('sc'+i+'-'+j).innerHTML="<font color=green>"+thiscontent.charAt(j)+"</font>";
			} else {
				if (newtype.charAt(j)=='') {
				notype+=1;
				document.getElementById('notype').innerHTML="<font class=notype>"+notype+"</font>";
				document.getElementById('sc'+i+'-'+j).innerHTML="<font color=gray>"+thiscontent.charAt(j)+"</font>";
				 } else {
				wrongcount+=1;
				document.getElementById('errorexam').innerHTML="<font class=wrongscore>"+wrongcount+"</font>";
				document.getElementById('sc'+i+'-'+j).innerHTML="<font color=red>"+thiscontent.charAt(j)+"</font>";
				}
			}
	}
}
var alltime=600-i_total_secs;
if (i_total_secs==0) {alltime=600;}
	document.getElementById('submit1').style.display="none";
	document.forms['inputgotest'].elements['rightcount'].value=rightcount;
	document.forms['inputgotest'].elements['wrongcount'].value=wrongcount;
	document.forms['inputgotest'].elements['notype'].value=notype;
	document.forms['inputgotest'].elements['score'].value=parseInt((rightcount/alltime)*60);
	document.getElementById('examscore').innerHTML="<font class=totalscore>"+parseInt((rightcount/alltime)*60)+"</font>";
	document.forms['inputgotest'].elements['timer'].value=alltime;
	document.getElementById('mysubmit').style.display="inline";
	document.getElementById('input0').readOnly=true;
document.getElementById('input1').readOnly=true;
document.getElementById('input2').readOnly=true;

}
</script>

<script>
			jQuery(document).ready(function()
			  {
				jQuery(document).bind("contextmenu",function(event){
				  return false;
				});
				jQuery(document).bind("selectstart",function(event){
				  return false;
				});
			});
</script>



<table width=960 align=center border=0 cellspacing=0 cellpadding=0><tr><td>
<h1>中文打字測驗　{{ $article->title }}</h1><p style="font-size:16px;">本篇文章共 <font color=red>{{ $article->words }} </font>字元，含標點符號，不含空白及換行字元。　　<font color=red>小叮嚀：按 <img src="{{ asset('type/images/KeyEnter.gif') }}" align=absmiddle> 就可以切換至下一個輸入區喔！</font></p>

<table width=950 align=center border=0 style="table-layout:fixed;" cellspacing=0 cellpadding=0>
<tr>
<td width=190 valign=top rowspan=2 align=center>
	<div id="abgne_float_ad" style="width:100px;text-align:center;margin:0px">
	<table width=190 cellpadding=0 cellspacing=0>
		<tr style="vertical-align:middle;" align=center><td colspan=2 class="typecontent1" style="padding:10px;"><font color=red>{{ auth()->user()->name }}<br>已登入！</font></td></tr>
		<tr style="background-color:#FFCC99;vertical-align:middle;" align=center height=80><td><img src="{{ asset('type/images/clock.png') }}" align=absmiddle></td><td><span id="clock1"><font class=clock>10:00</font></span></td></tr>
    		<tr style="background-color:#aaeba6;vertical-align:middle;" align=center height=80><td><img src="{{ asset('type/images/right.png') }}" align=absmiddle></td><td><span id=rightexam><font class=rightscore>0</font></span></td>
    		<tr style="background-color:#FFCCBD;vertical-align:middle;" align=center height=80><td><img src="{{ asset('type/images/wrong.png') }}" align=absmiddle></td><td><span id=errorexam><font class=wrongscore>0</font></span></td>
    		<tr style="background-color:#f8e690;vertical-align:middle;" align=center height=80><td><img src="{{ asset('type/images/dialog_question.png') }}" align=absmiddle></td><td><span id=notype><font class=notype>0</font></span></td>
    		<tr style="background-color:#cceeee;vertical-align:middle;" align=center height=80><td><img src="{{ asset('type/images/keyspeed.png') }}" align=absmiddle></td><td><span id=examscore><font class=totalscore align=absmiddle>0</font></span></td></tr>
    		<tr style="background-color:#f4cef1;vertical-align:middle;" height=120><td colspan=2><input id=submit1 type="button" value="打完了，查看成績" name=submit1 onclick="Chcekall();" class="buttonG red">
    		<div style="display:none; font-size:10pt;" id="mysubmit">

<!--學校：<br>
班級：<br>
姓名：<br>
指導老師姓名：<br><input type=text name=teachername value="" style="text-align:center;" maxlength=10 size=12>-->
<form name=inputgotest method=post action="{{ route('student_type.store.typing') }}" id="inputgotest">
	{{ csrf_field() }}
<input type=hidden name=article_id value="">
<input type=hidden name=rightcount value="0">
<input type=hidden name=wrongcount value="0">
<input type=hidden name=notype value="0">
<input type=hidden name=score value="0">
<input type=hidden name=timer value="0">
<input type=hidden name=article_id value="{{ $article->id }}">
<input type=hidden name=user_id value="{{ auth()->user()->id }}">
<br><br>
<input type=submit value="登錄成績" class='btn btn-success'>
</form>
</div>
</td></tr>
    	</table>
    </div>
</td>
<td width=10 rowspan=2>&nbsp;</td>
<td style="background-color:#ddc5ec;padding:10px;" width=730 class=typecontent1>準備區：<br><input id=inputtext type=text class=typeanswer1 style='width:715px;padding-left:7px;color:#51236d;background-color:#ffffff;'  value="按一下這裡調整輸入法，再按 enter 就開始計時" onFocus="if (this.value=='按一下這裡調整輸入法，再按 enter 就開始計時') {this.value=''}" onBlur="if(this.value=='')this.value='按一下這裡調整輸入法，再按 enter 就開始計時';"></td>

</tr>

<tr><td style="background-color:#ffff99;padding:10px;" width=730 valign=top><p class=typecontent1><img src="{{ asset('type/images/blank.gif') }}" width=10>@foreach($str as $k1=>$v1)<?php $words = mb_str_split($v1); ?>@foreach($words as $k2=>$v2)<span id=sc{{ $k1 }}-{{ $k2 }}>{{ $v2 }}</span>@endforeach<img src="{{ asset('type/images/enter.svg') }}" width="32"><span id=sc{{ $k1 }}-{{ $k2+1 }}></span><br><input id='input{{ $k1 }}' onblur='Justcheck();' onfocus='Gostart();' type=text style='width:715px;padding-left:7px;' class=typeanswer1 maxlength=24><br><img src="{{ asset('type/images/blank.gif') }}" width=10 height=40>@endforeach
	</td>
</tr>
</table>
<p></p>
</td></tr>
	<tr>
		<td class="text-center">
			打完記得快按<font color="red">左下角「打完了，查看成積」</font>
		</td>
	</tr>
</table>
</div>

<script language=javascript>
var tags_before_clock = "<font class=clock> "
var tags_after_clock  = "</font>"

function get_time_spent ()
{
  var time_now = new Date();
  return Math.abs((clock_start+600000-time_now.getTime())/1000);
}

function show_secs()  // show the time user spent on the side
{
  i_total_secs = Math.round(get_time_spent());
  var i_secs_spent = i_total_secs % 60;
  var i_mins_spent = Math.round((i_total_secs-30)/60);
  var s_secs_spent = "" + ((i_secs_spent>9) ? i_secs_spent : "0" + i_secs_spent);
  document.getElementById('clock1').innerHTML = tags_before_clock+" "+i_mins_spent + ":" + s_secs_spent+tags_after_clock;
  if (i_total_secs==0){
  	Chcekall();
  }
}
 </script>



</body></html>
