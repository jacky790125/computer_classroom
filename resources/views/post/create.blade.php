@extends('layouts.master')

@section('page-title', '新增公告|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('post.index') }}">公告系統</a>
    </li>
    <li class="breadcrumb-item active">新增系統</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>新增公告</h1>
      {{ Form::open(['route' => 'post.store', 'method' => 'POST', 'files' => true]) }}

      <input type="hidden" name="page_view" value="0">

      @include('post.form')
      <div class="form-group">
        <label for="upload">附件：</label>
        <input name="upload[]" type="file" multiple>
      </div>
      <div class="text-right">
        <a href="{{ route('post.index') }}" class="btn btn-warning">返回</a>
        <button type="submit" class="btn btn-success">新增</button>
      </div>

      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection