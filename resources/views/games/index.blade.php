@extends('layouts.master')

@section('page-title', '遊戲兌換|和東資訊教學網')

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
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">遊戲列表</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 水果忍者(<i class="fa fa-dollar"></i> 90)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/01') }}"><img src="{{ asset('games/fruit-ninja/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> Flappy Bird(<i class="fa fa-dollar"></i> 50)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/02') }}"><img src="{{ asset('games/flappy-bird/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 太空戰機(<i class="fa fa-dollar"></i> 80)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/03') }}"><img src="{{ asset('games/fly/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> Flappy Text(<i class="fa fa-dollar"></i> 60)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/04') }}"><img src="{{ asset('games/flappy-text/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection