@extends('layouts.master')

@section('page-title', '學生打字|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">學生打字</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/type.png') }}" alt="公告系統logo" width="60">學生打字</h1>
      <h2><i class="fa fa-list-ul"></i> 文章列表</h2>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>注意！</strong><br>1.本程式的用意是練習使用桌機鍵盤打字，請不要使用平台電腦或是手機。<br>
        2.你打字的能力，如果可以在四分鐘內打完的文章，將不能練習該文章！<br>
        3.打字時間末滿五分鐘，將不以登記成績。(首次打字為一分鐘)
      </div>
      <h4>你目前的最快打字速度為：{{ $stud_type }}，你可以打的文章字數為：{{ $stud_type*4 }} 字以上</h4>
        <?php $i=1; ?>
      <table>
        <tr>
          @foreach($articles as $article)
            <?php $disable = ($article->words < $stud_type*4)?"disabled":""; ?>
            <td width="300"><a href="#" class="btn btn-info {{ $disable }}" onclick="openwindow('{{ route('student_type.typing',$article->id) }}')">({{ $i }}) {{ $article->title }}</a><font color=red>({{ $article->words }}字)</font></td>
            @if($i%4 == 0)
        </tr>
        <tr>
          <td>　</td>
        </tr><tr>
          @endif
              <?php $i++;?>
          @endforeach
        </tr>
      </table>
    </div>
  </div>
</div>
<script>
    function openwindow(url_str){
        window.open (url_str,"學生打字","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=990,Height=800");
    }

</script>
@endsection