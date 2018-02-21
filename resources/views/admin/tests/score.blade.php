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
              <a class="nav-link" href="{{ route('admin.test_index') }}">試卷管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.score_index') }}">分數管理</a>
          </li>
      </ul>
    </div>
  </div>
    <br>
  <div class="row">
      <div class="col-12">
          <div class="card mb-3">
              <div class="card-header">
                  <h3><i class="fa fa-sellsy"></i> 選擇測驗</h3>
              </div>
              <div class="card-body">
                  {{ Form::open(['route' => 'admin.score_index', 'method' => 'GET']) }}
                  {{ Form::select('test_id', $test_menu, $test_id, ['id' => 'test_id','placeholder'=>'請先選擇測驗','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
                  {{ Form::close() }}
              </div>
          </div>
          @if(!empty($test_id))
          <div class="card mb-3">
              <div class="card-header">
                選擇班級
              </div>
              <div class="card-body">
                  <ul class="nav nav-pills">
                      @foreach($class_array as $k=>$v)
                          <?php
                          $group = \App\Group::where('id','=',$v)->first();
                          if($group->id == $group_id){
                              $active= "class='active'";
                          }else{
                              $active = "";
                          }
                          ?>
                      <li>
                          <a href="{{ route('admin.score_index',['test_id'=>$test_id,'group_id'=>$group->id]) }}" {{ $active }} data-toggle="tab">{{ $group->name }}</a>
                      </li>
                      @endforeach
                  </ul>
              </div>
          </div>
          @endif
      </div>
  </div>
</div>
@endsection