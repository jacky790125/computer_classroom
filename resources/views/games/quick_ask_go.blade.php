@extends('layouts.master')

@section('page-title', '快問快答|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">快問快答</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">快問快答</h1>
    </div>
  </div>
  <h2>題庫：{{ $course->name }}</h2>
  <h2>題目：共 {{ $course->ask_questions->count() }} 題</h2>
  <h2>說明：</h2>
  <li>隨機作答 15 題，錯 3 題即失敗。</li>
  <li>每題必須在 5 秒內完成，過關可得 500 資訊幣。</li>
  <li>每個題庫每天可挑戰 3 次。</li>
  <li>領過該題庫獎金 3 次者，不得再挑戰同題庫。</li>
  <li>作答過程中，禁止按 F5 或是 重新整理 或是 上一頁 或是 中間離開，否則即計失敗一次。</li>
</div>
<br>
　<a href="#" class="btn btn-dark" onclick="history.back();">返回</a>
  @if($course->ask_questions->count() != 0)
　<a href="{{ url('quick_ask_do/'.$course->id) }}" class="btn btn-success">了解，出發挑戰！</a>
  @endif
@endsection