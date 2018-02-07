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
  @if(auth()->check())
  <div class="row">
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 水果忍者(<i class="fa fa-dollar"></i> 90)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/01') }}" target="_blank"><img src="{{ asset('games/fruit-ninja/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> Flappy Bird(<i class="fa fa-dollar"></i> 50)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/02') }}" target="_blank"><img src="{{ asset('games/flappy-bird/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 太空戰機(<i class="fa fa-dollar"></i> 80)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/03') }}" target="_blank"><img src="{{ asset('games/fly/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> Flappy Text(<i class="fa fa-dollar"></i> 60)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/04') }}" target="_blank"><img src="{{ asset('games/flappy-text/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 五子棋(<i class="fa fa-dollar"></i> 40)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/05') }}" target="_blank"><img src="{{ asset('games/wuziqi/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 方塊消除(<i class="fa fa-dollar"></i> 60)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/06') }}" target="_blank"><img src="{{ asset('games/remove-game/pic.png') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 推箱子(<i class="fa fa-dollar"></i> 60)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/07') }}" target="_blank"><img src="{{ asset('games/canvas-box/pic.png') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 簡易Mario(<i class="fa fa-dollar"></i> 60)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/08') }}" target="_blank"><img src="{{ asset('games/simple-mario/pic.png') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> Mario(<i class="fa fa-dollar"></i> 70)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/09') }}" target="_blank"><img src="{{ asset('games/mario/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 坦克(<i class="fa fa-dollar"></i> 70)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/10') }}" target="_blank"><img src="{{ asset('games/simple-tank/pic.png') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 俄羅期方塊(<i class="fa fa-dollar"></i> 50)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/11') }}" target="_blank"><img src="{{ asset('games/tetris/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 象棋(<i class="fa fa-dollar"></i> 30)
        </div>
        <div class="card-body text-center">
          <a href="{{ url('game/12') }}" target="_blank"><img src="{{ asset('games/jiaoben/pic.jpg') }}" width="240" height="180"></a>
        </div>
      </div>
    </div>
  </div>
  @else
    <div class="alert alert-danger" role="alert">
      <strong>學生兌換遊戲請先由上方登入！</strong>
    </div>
  @endif
</div>
@endsection