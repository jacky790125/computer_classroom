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

                      @foreach($class_array as $k=>$v)
                          <?php
                          $group = \App\Group::where('id','=',$v)->first();
                          if($group->id == $group_id){
                              $btn= "btn-info";
                          }else{
                              $btn = "btn-default";
                          }
                          ?>
                          <a href="{{ route('admin.score_index',['test_id'=>$test_id,'group_id'=>$group->id]) }}" class="btn {{ $btn }}">{{ $group->name }}</a>
                      @endforeach
              </div>
          </div>
          <div class="card mb-3">
              <div class="card-header">
                  學生列表
              </div>
              <div class="card-body">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th>
                              座號
                          </th>
                          <th>
                              姓名
                          </th>
                          <th>
                              成績
                          </th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($students as $k=>$v)
                      <tr>
                          <td>
                            {{ $v['num'] }}
                          </td>
                          <td>
                              @if($v['sex'] == "1")
                                  <img src="{{ asset('img/boy.gif') }}">
                                  <span class="text-primary">{{ $v['name'] }}</span>
                              @elseif($v['sex'] == "2")
                                  <img src="{{ asset('img/girl.gif') }}">
                                  <span class="text-danger">{{ $v['name'] }}</span>
                              @else
                                  {{ $v['name'] }}
                              @endif
                          </td>
                          <td>
                            @if(!empty($score[$k]))
                                @if($score[$k] < 60)
                                      <p class="btn btn-danger">{{ $score[$k] }}</p>
                                @else
                                      {{ $score[$k] }}
                                @endif
                            @endif
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