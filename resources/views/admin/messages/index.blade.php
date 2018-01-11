@extends('layouts.master')

@section('page-title', '空白|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">空白頁面</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/message.png') }}" alt="訊息管理logo" width="60">訊息管理</h1>
      <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>
    </div>
  </div>
</div>
@endsection