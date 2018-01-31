@extends('layouts.master')

@section('page-title', '空白|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">遊戲兌換</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/post.png') }}" alt="公告系統logo" width="60">Blank</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-area-chart"></i> 遊戲列表
        </div>
        <div class="card-body text-center">
          <object type="application/x-shockwave-flash" width="800" height="600">
            <param name="movie" value="{{ url('game/001.swf') }}"></param>
            <param name="wmode" value="opaque"></param>
          </object>
            <?php require_once('../public/games/fruit-ninja/index.html');?>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection