@extends('layouts.master')

@section('page-title', '帳號管理|和東資訊教學網')

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
    <li class="breadcrumb-item active">測驗管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/test.png') }}" alt="測驗管理logo" width="60">測驗管理</h1>
    </div>
    </div>

  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.test.course_index') }}">新增題目</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.test.question') }}">題庫編修</a>
          </li>
          <li class="nav-item">
              <a class="nav-link active" href="{{ route('admin.test_index') }}">試卷管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">分數管理</a>
          </li>
      </ul>
    </div>
  </div>
    <br>
  <div class="row">
      <div class="col-12">
          <div class="card mb-3">
              <div class="card-header">
                  <h3><i class="fa fa-plus"></i> 新增試卷</h3>
              </div>
              <div class="card-body">
                  {{ Form::open(['route' => 'admin.test_index', 'method' => 'GET']) }}
                  {{ Form::select('course_id', $course_menu, $course_id, ['id' => 'course_id','placeholder'=>'請先選擇課程','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
                  {{ Form::close() }}
                  @if(!empty($course_id))
                  {{ Form::open(['route' => 'admin.test_store', 'method' => 'POST','id'=>'store','onsubmit'=>'return false;']) }}
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th>
                              測驗標題
                          </th>
                          <th>
                              對象
                          </th>
                          <th>
                              每題幾分？
                          </th>
                          <th>
                              啟用？
                          </th>
                          <th>
                              動作
                          </th>
                      </tr>
                      </thead>
                      <tbody>

                      <tr>
                          <td>
                              {{ Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => '測驗標題','required'=>'required']) }}
                          </td>
                          <td>
                              {{ Form::select('for[]', $groups, null, ['id' => 'for', 'class' => 'form-control','multiple'=>'multiple','placeholder'=>'請多選群組']) }}
                          </td>
                          <td>
                              {{ Form::text('score', null, ['id' => 'score', 'class' => 'form-control', 'placeholder' => '分數','required'=>'required']) }}
                          </td>
                          <td>
                              <input type="radio" name="enable" checked value="1">啟用 <input type="radio" name="enable" value="0">停用
                          </td>
                          <td>
                              <a href="#" class="btn btn-success" onclick="bbconfirm('store','確定新增？')"><i class="fa fa-plus"></i> 新增測驗</a>
                          </td>
                      </tr>
                      </tbody>
                  </table>
                  <h4>請選測驗題目：</h4>
                  <table class="table table-hover">
                      <?php $i=1; ?>
                      @foreach($course_questions as $course_question)
                          <tr>
                              <td width="20">
                                  <input type="checkbox" name="question[]" value="{{ $course_question->id }}" checked>
                              </td>
                              <td width="20">
                                  {{ $i }}
                              </td>
                              <td>
                                  {{ $course_question->title }}
                              </td>
                          </tr>
                      <?php $i++; ?>
                      @endforeach
                  </table>
                  <input type="hidden" name="course_id" value="{{ $course_id }}">
                  {{ Form::close() }}
                  @endif
              </div>
          </div>
          @if(empty($course_id))
          <div class="card mb-3">
              <div class="card-header">
                  <h3><i class="fa fa-list"></i> 試卷列表</h3>
              </div>
              <div class="card-body">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <td>
                              序號
                          </td>
                          <td>
                              名稱
                          </td>
                          <td>
                              對象
                          </td>
                          <td>
                              題目
                          </td>
                          <td>
                              每題幾分？
                          </td>
                          <td>
                              啟用？
                          </td>
                          <td>
                              動作
                          </td>
                      </tr>
                      </thead>
                      <?php $i=1; ?>
                      <tbody>
                      @foreach($tests as $test)
                      <tr>
                          <td>
                              {{ $i }}
                          </td>
                          <td>
                              {{ $test->title }}
                          </td>
                          <td>
                              {{ $test->for }}
                          </td>
                          <td>
                              {{ $test->questions }}
                          </td>
                          <td>
                              {{ $test->score }}
                          </td>
                          <td>
                              @if($test->enable == "1")
                                  啟用
                              @else
                                  停用
                              @endif
                          </td>
                          <td>
                              <a href="{{ route('admin.test_delete',$test->id) }}" class="btn btn-danger" id="del{{ $test->id }}" onclick="bbconfirm2('del{{ $test->id }}','確定刪除？')">刪除</a>
                          </td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
          @endif
      </div>
  </div>
</div>
@endsection