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
            <a class="nav-link active" href="{{ route('admin.test.index') }}">題庫管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">題目管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">分數管理</a>
          </li>
      </ul>
    </div>
  </div>
    <br>
  <div class="row">
      <div class="col-6">
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
                      {{ Form::open(['route'=>'admin.test.store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
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
                          <tr>
                              <td>
                                  {{ $i }}
                              </td>
                              <td>
                                  {{ $course->name }}
                              </td>
                              <td>

                              </td>
                          </tr>
                          <?php $i++; ?>
                      @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
      <div class="col-6">
          <div class="card mb-3">
              <div class="card-header">
                  題庫
              </div>
              <div class="card-body">

              </div>
          </div>
      </div>
  </div>
</div>
@endsection