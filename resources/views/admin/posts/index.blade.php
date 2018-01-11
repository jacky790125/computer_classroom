@extends('layouts.master')

@section('page-title', '公告系統|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.index') }}">系統管理</a>
    </li>
    <li class="breadcrumb-item active">公告管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/admin_post.png') }}" alt="公告系統logo" width="60">公告管理</h1>
      <table class="table table-hover" id="dataTable"">
        <thead>
        <tr>
          <th width="200">日期</th>
          <th>公告標題</th>
          <th>內容</th>
          <th width="150">發佈者</th>
          <th width="100">點閱數</th>
          <th>動作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
          <tr>
            <th>{{ $post->updated_at }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->view }}</td>
            <td>
              <a href="{{ route('admin.post.destroy',$post->id) }}" class="btn btn-danger btn-xs text-right" id="post{{ $post->id }}" onclick="bbconfirm2('post{{ $post->id }}','你確定要刪除這則公告？')"><i class="fa fa-trash"></i> 刪除</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
  </div>
</div>
@endsection