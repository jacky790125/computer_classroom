@extends('layouts.master')

@section('page-title', '快問快答|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">快問快答</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">快問快答</h1>
    </div>
  </div>
  @if(auth()->check())
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">挑戰題庫</a>
      </li>
      @if(auth()->user()->group_id == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{ route('quick_ask_admin') }}">題庫管理</a>
        </li>
      @endif
    </ul>
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-reorder"></i> 選擇要挑戰的題庫
      </div>
      <div class="card-body">
        {{ Form::open(['route' => 'student_task.open', 'method' => 'POST']) }}
        {{ Form::select('ask_course_id', $ask_courses, null,['id' => 'ask_course_id', 'class' => 'form-control', 'placeholder' => '請選擇題庫','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
        {{ Form::close() }}
      </div>
    </div>
  @else
    <div class="alert alert-danger" role="alert">
      <strong>學生作答前請先由上方登入！</strong>
    </div>
  @endif
</div>
@endsection