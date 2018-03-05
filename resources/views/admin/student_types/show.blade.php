@extends('layouts.master')

@section('page-title', '學生打字|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.index') }}">系統管理</a>
    </li>
    <li class="breadcrumb-item active">學生成績</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/article.png') }}" alt="打字管理logo" width="60">打字管理</h1>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student_type.admin_index') }}">新增文章</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('student_type.admin_show') }}">各班打字</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('student_type.admin_types') }}">歷次打字</a>
        </li>
      </ul>
      <h2><i class="fa fa-plus-circle"></i> 學生成績</h2>
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-users"></i> 班級</h3>
        </div>
        <div class="card-body">
          {{ Form::open(['route' => 'student_type.admin_show', 'method' => 'POST']) }}
          {{ Form::select('group_id', $groups, $group, ['id' => 'group_id','placeholder'=>'請先選擇班級','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          {{ Form::close() }}
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-users"></i> 成績</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <th>
              座號
            </th>
            <th>
              姓名
            </th>
            <th>
              成績
            </th>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
              <td>
                {{ $user->year_class_num }}
              </td>
              <td>
                {{ $user->name }}
              </td>
              <?php
                $type = \App\StudType::where('user_id','=',$user->id)->orderBy('score','DESC')->first();
                ?>
              <td>
                @if(!empty($type))
                {{ $type->score }}
                @endif
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection