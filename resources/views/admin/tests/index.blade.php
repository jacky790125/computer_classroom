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
              <a class="nav-link active" href="{{ route('admin.test.course_index') }}">課程管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.test.question') }}">題庫管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">試卷管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">分數管理</a>
          </li>
      </ul>
    </div>
  </div>
    <br>
  <div class="row">
      <div class="col-4">
          <div class="card mb-3">
              <div class="card-header">
                  課程分類
              </div>
              <div class="card-body">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th>
                              id
                          </th>
                          <th>
                              名稱
                          </th>
                          <th>
                              動作
                          </th>
                      </tr>
                      </thead>
                      <tbody>
                      {{ Form::open(['route'=>'admin.test.course_store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
                      <tr class="bg-info">
                          <td>

                          </td>
                          <td>
                              {{ Form::text('name',null,['id'=>'name','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
                          </td>
                          <td>
                                <a href="#" class="btn btn-success" onclick="bbconfirm('store','確定新增？')">新增課程分類</a>
                          </td>
                      </tr>
                      {{ Form::close() }}
                      <?php $i =1; ?>
                      @foreach($courses as $course)
                          {{ Form::open(['route'=>['admin.test.course_update',$course->id],'method'=>'patch','id'=>'update'.$course->id,'onsubmit'=>'return false;']) }}
                          <tr>
                              <td>
                                  {{ $i }}
                              </td>
                              <td>
                                  {{ Form::text('name',$course->name ,['id'=>'name','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
                              </td>
                              <td>
                                  <a href="#" class="btn btn-primary" onclick="bbconfirm('update{{ $course->id }}','確定儲存？')">儲存</a>
                                  <a href="{{ route('admin.test.course_delete',$course->id) }}" class="btn btn-danger" id="del{{ $course->id }}" onclick="bbconfirm2('del{{ $course->id }}','確定刪除？')">刪除</a>
                              </td>
                          </tr>
                          {{ Form::close() }}
                          <?php $i++; ?>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="col-8">
          <div class="card mb-3">
              <div class="card-header">
                  題庫
              </div>
              <div class="card-body">
                  {{ Form::open(['route' => 'admin.test.course_index', 'method' => 'GET']) }}
                  {{ Form::select('course_id', $course_menu, $course_id, ['id' => 'course_id','placeholder'=>'請選擇','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
                  {{ Form::close() }}
                  @if(!empty($course_id))
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th colspan="2"><h4>新增題目({{$num}})</h4></th>
                      </tr>
                      </thead>
                      <tbody>
                      {{ Form::open(['route'=>'admin.test.question_store','method'=>'post','id'=>'store_question','files' => true,'onsubmit'=>'return false;']) }}
                      <tr>
                          <th>
                              題目：
                          </th>
                          <td>
                              {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入題目','required'=>'required']) }}
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              題目參考圖片：<input type="file" name="file[title_img]">
                          </td>
                      </tr>
                      <tr>
                          <th class="text-danger" nowrap width="120">
                              正確答案A：
                          </th>
                          <td>
                              {{ Form::text('ans_A',null,['id'=>'ans_A','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required']) }}
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              答案A參考圖片：<input type="file" name="file[ans_A_img]">
                          </td>
                      </tr>
                      <tr>
                          <th nowrap width="120">
                              答案B：
                          </th>
                          <td>
                              {{ Form::text('ans_B',null,['id'=>'ans_B','class' => 'form-control', 'placeholder' => '請輸入答案B','required'=>'required']) }}
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              答案B參考圖片：<input type="file" name="file[ans_B_img]">
                          </td>
                      </tr>
                      <tr>
                          <th nowrap width="120">
                              答案C：
                          </th>
                          <td>
                              {{ Form::text('ans_C',null,['id'=>'ans_C','class' => 'form-control', 'placeholder' => '請輸入答案C','required'=>'required']) }}
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              答案C參考圖片：<input type="file" name="file[ans_C_img]">
                          </td>
                      </tr>
                      <tr>
                          <th nowrap width="120">
                              答案D：
                          </th>
                          <td>
                              {{ Form::text('ans_D',null,['id'=>'ans_D','class' => 'form-control', 'placeholder' => '請輸入答案D','required'=>'required']) }}
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2">
                              答案D參考圖片：<input type="file" name="file[ans_D_img]">
                          </td>
                      </tr>
                      <input type="hidden" name="course_id" value="{{ $course_id }}">
                  {{ Form::close() }}
                      </tbody>
                  </table>
                      <a href="#" class="btn btn-success" onclick="bbconfirm('store_question','確定新增？')"><i class="fa fa-plus"></i> 新增題目</a>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
@endsection