@extends('layouts.master')

@section('page-title', '修改公告|和東資訊教學網')

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
    <li class="breadcrumb-item active">修改公告</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>修改公告</h1>
      {{ Form::model($post,['route' => ['post.update',$post->id], 'method' => 'PATCH','id'=>'post'.$post->id,'onsubmit'=>'return false', 'files' => true]) }}

      @include('posts.partials.form')
      <div class="form-group">
        <label for="upload">附件：</label>
        <input name="upload[]" type="file" multiple>
      </div>
      <div class="text-right">
        <a href="#" class="btn btn-warning" onclick="history.go(-1)"><i class="fa fa-reply"></i> 返回</a>
        <a href="#" class="btn btn-success" onclick="bbconfirm('post{{ $post->id }}','你確定要儲存修改？')"><i class="fa fa-floppy-o"></i> 修改</a>
      </div>

      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection