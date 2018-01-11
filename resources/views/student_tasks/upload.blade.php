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
        <textarea class="form-control" name="report"></textarea>

        <br>
          <a href="#" class="btn btn-success" onclick="bbconfirm('student_task','確定要送出作業')"><i class="fa fa-plus"></i> 送出</a>
        {{ Form::close() }}
      @elseif($student_task->task->type == "img")
      @endif
    </div>
  </div>
</div>
@endsection