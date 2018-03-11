@extends('layouts.master')

@section('page-title', '十賭九輸|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">十賭九輸</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">十賭九輸</h1>
    </div>
  </div>
  @if(auth()->check())
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-reorder"></i> 猜一猜，0~9，下注後，猜中得十倍獎金！
        </div>
        <div class="card-body">
          <img src="{{ asset('img/dice.png') }}">
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