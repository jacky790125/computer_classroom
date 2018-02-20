@extends('layouts.master')

@section('page-title', '學生測驗|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">學生測驗</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/type.png') }}" alt="學生測驗logo" width="60">學生測驗</h1>
      @if(auth()->check())
      <h2><i class="fa fa-list-ul"></i> 測驗列表</h2>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>
            序號
          </th>
          <th>
            建立日期
          </th>
          <th>
            測驗名稱
          </th>
          <th>
            動作
          </th>
        </tr>
        <tbody>
        @foreach($get_test as $k=>$test)
        <tr>
          <td>
            {{ $k }}
          </td>
          <td>
            {{ $test->created_at }}
          </td>
          <td>
            {{ $test->title }}
          </td>
          <td>
            <?php
              $has_done = \App\TestScore::where('user_id','=',auth()->user()->id)
                  ->where('test_id','=',$test->id)
                  ->first();
            ?>
            @if(empty($has_done))
            {{ Form::open(['route'=>'student_test.test','method'=>'post','id'=>'test'.$test->id,'onsubmit'=>'return false;']) }}
            <input type="hidden" name="test_id" value="{{ $test->id }}">
            <a href="#" class="btn btn-info" onclick="bbconfirm('test{{ $test->id }}','確定要測驗？')">測驗去</a>
            {{ Form::close() }}
            @else
                <a href="{{ route('student_test.view',$has_done->id) }}" class="btn btn-primary">看成績</a>
            @endif
          </td>
        </tr>
        @endforeach
        </tbody>
        </thead>
      </table>
      @else
        <div class="alert alert-danger" role="alert">
          <strong>學生上傳作業請先由上方登入！</strong>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection