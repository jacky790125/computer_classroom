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
    <div class="col-6">
      <h2>{{ $semester }} {{ $class_name }} <a href="#" class="btn btn-dark" onclick="history.back()">返回</a></h2>
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
              @if($v['score'] < 60)
                <p class="btn btn-danger">{{ $v['score'] }}</p>
              @else
                {{ $v['score'] }}
              @endif
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection