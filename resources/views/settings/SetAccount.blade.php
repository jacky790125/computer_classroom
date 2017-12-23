@extends('layouts.master')

@section('page-title', '帳號管理|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('setting.index') }}">系統管理</a>
    </li>
    <li class="breadcrumb-item active">帳號管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>帳號管理</h1>
      <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>
    </div>
  </div>
</div>
@endsection