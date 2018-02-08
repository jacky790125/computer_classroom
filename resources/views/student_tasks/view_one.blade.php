@extends('layouts.master2')

@section('page-title', '觀看單一作業|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/view.png') }}" alt="觀看作業logo" width="60">觀看作業</h1>
      <h2><i class="fa fa-dot-circle-o"></i> 題目：{{ $student_task->task->title }}</h2>
      <p>說明：{{ $student_task->task->description }}</p>
        <?php $name = (empty($student_task->user->nickname))?$student_task->user->username:$student_task->user->nickname;  ?>
      <h2><img src="{{ url('avatars/'.$student_task->user->id) }}" width="40" height="40" class="rounded-circle"> {{ $name }}</h2>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-print"></i> 答
        </div>
        <div class="card-body">
      @if($student_task->task->type == "text")
            {!! nl2br($student_task->report) !!}
      @elseif($student_task->task->type == "img")
        <img src="{{ url('file/'.$student_task->id) }}" width="600">
        <br>
        <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
      @elseif($student_task->task->type == "aud")
        <audio src="{{ url('file/'.$student_task->id) }}" controls>
          沒有支援這個聲音播放，請更換瀏覽器
        </audio>
        <br>
        <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
      @elseif($student_task->task->type == "mov")
        <video src="{{ url('file/'.$student_task->id) }}" controls>
          沒有支援這個影片播放，請更換瀏覽器
        </video>
        <br>
        <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
      @elseif($student_task->task->type == "scratch2")
        <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="{{ asset('Scratch.swf') }}" height="600" width="747">
          <param name="allowScriptAccess" value="sameDomain">
          <param name="allowFullScreen" value="true">
          <param name="flashvars" value="project={{ url('file/'.$student_task->id) }}&autostart=false">
        </object>
        <br>
        <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
      @elseif($student_task->task->type == "file")
        <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
      @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection