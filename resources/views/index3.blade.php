@extends('layouts.master')

@section('page-title', '首頁|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">儀表統計</li>
    <li class="breadcrumb-item active">最新校排名</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/dashboard.png') }}" alt="儀表統計logo" width="60">儀表統計</h1>
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">最新公告</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index2') }}">最新隨機作品</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('index3') }}">最新校排名</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index4') }}">最新班排名</a>
        </li>
      </ul>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校存款 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>存款</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_money10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  {{ $v['money'] }} 元
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校打字 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>打字速度</th>
              <th>文章</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_type10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  {{ $v['type'] }} 字/分
                </td>
                <td>
                  {{ $v['article'] }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校發表文章 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>發表篇數</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_discuss10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  {{ $v['num'] }} 篇
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校遊戲次數 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>次數</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_game10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  {{ $v['num'] }} 次
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校作品按讚 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>次數</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_like10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  <a href="{{ route('view_student_task',$v['task_id']) }}" class="btn btn-info">{{ $v['like'] }} 次</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>


    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 全校作品觀看 Top 10
        </div>
        <div class="card-body">
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>次數</th>
            </tr>
            </thead>
            <tbody>
            @foreach($top_view10 as $k => $v)
              <tr>
                <td>
                  {{ $k }}
                  @if($k == 1)<img src="{{ asset('img/crown.png') }}">@endif
                  @if($k == 2)<img src="{{ asset('img/silver.png') }}">@endif
                  @if($k == 3)<img src="{{ asset('img/bronze.png') }}">@endif
                </td>
                <td>
                  <img src="{{ url('avatars/'.$v['id']) }}" width="30" height="30" class="rounded-circle">{{ $v['name'] }}
                </td>
                <td>
                  <a href="{{ route('view_student_task',$v['task_id']) }}" class="btn btn-info">{{ $v['view'] }} 次</a>
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