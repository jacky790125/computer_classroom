@extends('layouts.master')

@section('page-title', '空白|和東資訊教學網')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">儀表統計</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('game.index') }}">遊戲兌換</a>
      </li>
      <li class="breadcrumb-item active">水果忍者</li>
    </ol>
    <link rel="stylesheet" href="{{ asset('games/fruit-ninja/images/index.css') }}">
    <div id="extra"></div>
    <canvas id="view" width="640" height="480"></canvas>
    <div id="desc">
      <div style="text-align:center;clear:both;">
      </div>
      <div id="browser"></div>
    </div>
    <script src="{{ asset('games/fruit-ninja/scripts/all.js') }}"></script>
  </div>
@endsection
