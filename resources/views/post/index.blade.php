@extends('layouts.master')

@section('page-title', '公告系統|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">公告系統</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>公告系統</h1>
      @if(auth()->user()->group_id == "1")
        <div class="text-right">
          <a class="btn btn-success btn-xs" href="{{ route('post.create') }}" role="button"><span class="glyphicon glyphicon-plus"></span>新增公告</a>
        </div>
      @endif

      <table class="table table-hover">
        <thead>
        <tr>
          <th>日期</th>
          <th>公告標題</th>
          <th>發佈者</th>
          <th>點閱數</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
          <tr>
            <th>{{ substr($post->updated_at,0,10) }}</th>
            <td><a href="#" id="a{{ $post->id }}" class="nav-link">{{ $post->title }}</a></td>
            <td>{{ $post->user->name }}</td>
            <td>{{ $post->view }}</td>
          </tr>
          <tr class="bg-light" id="content{{ $post->id }}" style="display: none">
            <td colspan="4">{!! $post->content !!}</td>
          </tr>
          <script>
              $(document).ready(function(){
                  $("#a{{ $post->id }}").click(function(){
                      $("#content{{ $post->id }}").toggle();
                  });
              });
          </script>
        @endforeach
        </tbody>
      </table>

  </div>
</div>
@endsection