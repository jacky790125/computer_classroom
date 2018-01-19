@extends('layouts.master')

@section('page-title', '作業欣賞|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">作業欣賞</li>
  </ol>
  <div class="row">
    <div class="col-12">
    <h1><img src="{{ asset('img/title/open.png') }}" alt="學生作業logo" width="60">作業欣賞</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-reorder"></i> 選擇學生作業
        </div>
        <div class="card-body">
          {{ Form::open(['route' => 'student_task.open', 'method' => 'POST']) }}
          {{ Form::select('task_id', $tasks, null,['id' => 'task_id', 'class' => 'form-control', 'placeholder' => '請選擇作業','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection