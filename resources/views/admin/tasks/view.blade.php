@extends('layouts.master')

@section('page-title', '作業批改|和東資訊教學網')

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
    <li class="breadcrumb-item">
      <a href="{{ route('admin.task.index') }}">作業管理</a>
    </li>
    <li class="breadcrumb-item active">作業批改</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/score.png') }}" alt="作業批改logo" width="60">作業批改</h1>
    </div>
    </div>
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs">
        @foreach($group_tab as $k=>$v)
          <?php
              $active = ($k == $select)?"active":"";

              $data=[
                  'select'=>$k,
                  'for'=>$for,
                  'task_id'=>$task_id,
              ];
          ?>
          <li class="nav-item">
            <a class="nav-link {{ $active }}" href="{{ route('admin.task.view',$data) }}">{{ $v['name'] }}</a>
          </li>
          <input type="hidden" name="select_group" value="{{ $k }}">
        @endforeach
      </ul>
      <div class="card-header">
        <span class="fa fa-list"></span> 作品列表</div>
      <div class="card-body">
        <table class="table table-light table-hover">
          <tr>
            <th>
              班級
            </th>
            <th>
              座號
            </th>
            <th>
              姓名
            </th>
            <th>
              作品
            </th>
            <th width="100">
              評分
            </th>
            <th>
              評語
            </th>
          </tr>
          {{ Form::open(['route' => 'admin.task.stud_store', 'method' => 'POST','id'=>'stud_store','onsubmit'=>'return false;']) }}
      @foreach($students as $student)
        <?php
          $text_color = ($student->sex == 1)?"text-primary":"text-danger";
        ?>
        <tr>
          <td>
            {{ substr($student->year_class_num,0,3) }}
          </td>
          <td>
            {{ substr($student->year_class_num,3,2) }}
          </td>
          <td class="{{ $text_color }}">
            {{ $student->name }}
          </td>
          <td>
            @if(!empty($has_done[$student->id]['作業']) and $has_done[$student->id]['作業'] != "未指派！")
              <button class="btn btn-primary" onclick="window.open('{{ url('admin/task/view_one/'.$has_done[$student->id]['序號']) }}', '作品', config='height=600,width=800');"><i class="fa fa-check-square"></i> 觀看作品</button>
              <a href="{{ route('admin.task.stud_remove',$has_done[$student->id]['id']) }}" class="btn btn-danger" id="del{{ $student->id }}" onclick="bbconfirm2('del{{ $student->id }}','確定移除上傳')"?>刪除上傳</a>
            @endif
            @if($has_done[$student->id]['作業']=="未指派！")
                未指派！
            @endif
          </td>
          <td>
            @if($has_done[$student->id]['作業'] != "未指派！")
            {{ Form::text('score['.$has_done[$student->id]['序號'].']', $has_done[$student->id]['分數'], ['id' => 'score', 'class' => 'form-control','maxlength'=>'3']) }}
            @endif
          </td>
          <td>
            @if($has_done[$student->id]['作業'] != "未指派！")
            {{ Form::text('saying['.$has_done[$student->id]['序號'].']', $has_done[$student->id]['評語'], ['id' => 'saying', 'class' => 'form-control']) }}
            @else
              <?php
                $data2 = [
                    'task_id'=>$task_id,
                    'student_id'=>$student->id,
                ];
              ?>
              <a href="{{ route('add_student_task',$data2) }}" class="btn btn-warning" id="add_stud_task" onclick="bbconfirm2('add_stud_task','你確定？')"><i class="fa fa-hand-pointer-o"></i> 現在指派！</a>
            @endif
          </td>
        </tr>
      @endforeach
          {{ Form::close() }}
        </table>
        <a href="#" class="btn btn-success" onclick="bbconfirm('stud_store','是否確定？')"><i class="fa fa-send"></i> 送出</a>
      </div>
    </div>

    </div>
  </div>

</div>
@endsection