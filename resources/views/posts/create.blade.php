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
    <li class="breadcrumb-item active">新增公告</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>新增公告</h1>
      {{ Form::open(['route' => 'post.store', 'method' => 'POST','id'=>'post','onsubmit'=>'return false', 'files' => true]) }}

      <input type="hidden" name="page_view" value="0">

      @include('posts.partials.form')
      <div class="form-group">
        <label for="upload">附件：</label>
        <input name="upload[]" type="file" multiple>
      </div>
      <div class="text-right">
        <a href="#" class="btn btn-warning" onclick="history.go(-1)"><i class="fa fa-reply"></i> 返回</a>
        <a href="#" class="btn btn-success" onclick="bbconfirm('post','你確定要新增公告？')"><i class="fa fa-plus"></i> 新增</a>
      </div>

      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection