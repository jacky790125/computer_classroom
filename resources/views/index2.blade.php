@extends('layouts.master')

@section('page-title', '首頁|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">儀表統計</li>
    <li class="breadcrumb-item active">最新作品</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/dashboard.png') }}" alt="儀表統計logo" width="60">儀表統計</h1>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">最新公告</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('index2') }}">最新隨機作品</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index3') }}">最新校排名</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index4') }}">最新班排名</a>
        </li>
      </ul>
    </div>
  </div>
  <br>
  <div class="row">


      <table class="table">
        <tr>
          <?php $i=1; ?>
      @foreach($student_tasks as $student_task)
      <td width="50%">

        <div class="card sm-6">
          <div class="card-header">
            <h4>{{ $student_task->task->title }}</h4>
              <?php $name = (empty($student_task->user->nickname))?$student_task->user->username:$student_task->user->nickname;  ?>
            <p class="text-primary"><img src="{{ url('avatars/'.$student_task->user->id) }}" width="30" height="30" class="rounded-circle">{{ $name }}</p>
          </div>
          <div class="card-body">
            @if($student_task->task->type == "text")
              {!! nl2br($student_task->report) !!}
            @elseif($student_task->task->type == "img")
              <img src="{{ url('file/'.$student_task->id) }}" width="100%">

            @elseif($student_task->task->type == "aud")
              <audio src="{{ url('file/'.$student_task->id) }}" controls>
                沒有支援這個聲音播放，請更換瀏覽器
              </audio>
            @elseif($student_task->task->type == "mov")
              <video src="{{ url('file/'.$student_task->id) }}" controls>
                沒有支援這個影片播放，請更換瀏覽器
              </video>
            @elseif($student_task->task->type == "scratch2")
              <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="{{ asset('Scratch.swf') }}" height="160" width="200">
                <param name="allowScriptAccess" value="sameDomain">
                <param name="allowFullScreen" value="true">
                <param name="flashvars" value="project={{ url('file/'.$student_task->id) }}&autostart=false">
              </object>
            @elseif($student_task->task->type == "file")
              檔案無法預覽
              <br>
              <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
            @endif
          </div>
        </div>
      </td>
          @if($i%2 ==0)
            </tr><tr>
          @endif
          @if($i == "10") @break @endif
          <?php $i++; ?>
      @endforeach
        </tr>
      </table>

      <a href="{{ route('student_task.select') }}">更多作品...</a>


  </div>

</div>
<script>
    function openwindow(url_str){
        window.open (url_str,"新視窗","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=990,Height=800");
    }

</script>
@endsection