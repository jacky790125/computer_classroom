@extends('layouts.master')

@section('page-title', '繳交作業|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('student_task.index') }}">學生作業</a>
    </li>
    <li class="breadcrumb-item active">繳交作業</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/upload.png') }}" alt="繳交作業logo" width="60">繳交作業</h1>
      @if($student_task->task->type == "text")
        <h2><i class="fa fa-dot-circle-o"></i> {{ $student_task->task->title }}</h2>
        <p>{{ $student_task->task->description }}</p>
        {{ Form::open(['route' => ['student_task.store',$student_task->id], 'method' => 'POST','id'=>'student_task','onsubmit'=>'return false']) }}
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-print"></i> 答(請在下面方框中「打字」作答)
          </div>
          <div class="card-body">
            <textarea class="form-control" name="report"></textarea>
          </div>
        </div>

        <br>
        <input type="radio" name="public" value="1" checked>公開 <input type="radio" name="public" value="0">不公開
        <input type="hidden" name="type" value="{{ $student_task->task->type }}">
        <br>
        <br>
        <a href="#" class="btn btn-success" onclick="bbconfirm('student_task','確定要送出作業')"><i class="fa fa-plus"></i> 送出</a>
        {{ Form::close() }}
      @else
        <?php
            if($student_task->task->type=="img") $words = ".png .jpg .jpeg .gif .bmp .svg";
            if($student_task->task->type=="aud") $words = ".wav .mp3 .ogg";
            if($student_task->task->type=="mov") $words = ".mp4 .ogg .ogv .mpg .avi";
            if($student_task->task->type=="scratch2") $words = ".sb2";
            if($student_task->task->type=="file") $words = "均可";
        ?>
        <h2><i class="fa fa-dot-circle-o"></i> {{ $student_task->task->title }}</h2>
        <p>{{ $student_task->task->description }}</p>
        {{ Form::open(['route' => ['student_task.store',$student_task->id], 'method' => 'POST','id'=>'student_task','files'=>true,'onsubmit'=>'return false']) }}
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-print"></i> 請點選檔案，附檔名為：{{ $words }}
          </div>
          <div class="card-body">
            <input type="file" name="file" class="form-control">
          </div>
        </div>
        <br>
        <input type="radio" name="public" value="1" checked>公開 <input type="radio" name="public" value="0">不公開
        <input type="hidden" name="type" value="{{ $student_task->task->type }}">
        <input type="hidden" name="task_id" value="{{ $student_task->task_id }}">
        <br>
        <br>
        <a href="#" class="btn btn-success" onclick="bbconfirm('student_task','確定要送出作業')"><i class="fa fa-plus"></i> 送出</a>
        {{ Form::close() }}
      @endif
    </div>
  </div>
</div>
@endsection