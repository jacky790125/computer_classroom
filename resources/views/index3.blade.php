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
          <a class="nav-link" href="{{ route('index2') }}">最新作品</a>
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
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-address-card-o"></i> 全部排名</h3>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
            <tr>
              <th>存款最多</th>
              <th>打字最快</th>
              <th>文章最多</th>
              <th>最愛遊戲</th>
              <th>作品最讚</th>
              <th>最多人看</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                <img src="{{ url('avatars/'.$top_money['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_money['name'] }} <a href="#" class="btn btn-info">{{ $top_money['money'] }} 元</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_type['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_type['name'] }} <a href="#" class="btn btn-info">{{ $top_type['type'] }} 字/分</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_discuss['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_discuss['name'] }} <a href="#" class="btn btn-info">{{ $top_discuss['num'] }} 篇</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_game['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_game['name'] }} <a href="#" class="btn btn-info">{{ $top_game['num'] }} 次</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_like['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_like['name'] }} <a href="#" class="btn btn-info">{{ $top_like['like'] }} 次</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_view['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_view['name'] }} <a href="#" class="btn btn-info">{{ $top_view['view'] }} 次</a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection