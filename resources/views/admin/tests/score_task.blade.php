@extends('layouts.master')

@section('page-title', '學期分數|和東資訊教學網')

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
    <li class="breadcrumb-item active">學期分數</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/test.png') }}" alt="測驗管理logo" width="60">學期分數</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-3">
    <?php
      $y = date('Y');
      $m = date('m');
      if($m > 7 or $m < 2){
          $semester = $y-1911 . "1";
      }

      if($m > 1 and $m < 8){
          $semester = $y-1912 . "2";
      }

    ?>
      <table class="table">
        <thead>
        <tr>
          <th width="150">
            學期
          </th>
          <th>
            班級
          </th>
        </tr>
        </thead>
        <tbody>
        {{ Form::open(['route'=>'score_task_show','method'=>'post']) }}
        <tr>
          <td>
            {{ Form::text('semester',$semester,['id'=>'semester','class' => 'form-control', 'placeholder' => '請輸入學期','required'=>'required','maxlength'=>'4']) }}
          </td>
          <td>
            {{ Form::select('group_id', $groups,null, ['id' => 'group_id','placeholder'=>'請選擇班級','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          </td>
        </tr>
        {{ Form::close() }}
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection