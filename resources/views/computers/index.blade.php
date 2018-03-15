@extends('layouts.master')

@section('page-title', '我的小資資|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">我的小資資</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">小資資</h1>
    </div>
  </div>
  <table>
    <tr>
      <td rowspan="2">
        <img src="{{ asset('img/computer/show/case-g.png') }}" width="128">
      </td>
      <td>
        <img src="{{ asset('img/computer/show/monitor-g.png') }}" width="128">
      </td>
      <td colspan="2">
        <img src="{{ asset('img/computer/show/speaker-g.png') }}" width="80">
      </td>
    </tr>
    <tr>
      <td>
        <img src="{{ asset('img/computer/show/keyboard-g.png') }}" width="128">
      </td>
      <td>
        <img src="{{ asset('img/computer/show/mouse-g.png') }}" width="60">
      </td>
      <td>
      </td>
    </tr>
  </table>
</div>
@endsection