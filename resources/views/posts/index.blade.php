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
      <h1><img src="{{ asset('img/title/post.png') }}" alt="公告系統logo" width="60">公告系統</h1>
    @if(auth()->check())
        @if(auth()->user()->group_id == "1")
        <div class="text-right">
          <a class="btn btn-success btn-xs" href="{{ route('post.create') }}" role="button"><i class="fa fa-plus"></i> 新增公告</a>
        </div>
        @endif
    @endif
      <table class="table table-hover">
        <thead>
        <tr>
          <th width="200">日期</th>
          <th>公告標題</th>
          <th width="150">發佈者</th>
          <th width="100">點閱數</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
          <tr>
            <th>{{ $post->updated_at }}</th>
              <td>
                  <a href="#" id="a{{ $post->id }}" class="btn btn-primary btn-xs"><i class="fa fa-share"></i> {{ $post->title }}</a>
              </td>
            <td>{{ $post->user->nickname }}</td>
            <td><p id="view{{ $post->id }}">{{ $post->view }}</p></td>
          </tr>
          <tr class="bg-light" id="content{{ $post->id }}" style="display: none">
            <td colspan="4">
                {!! $post->content !!}
              <div class="text-right">
                @include('posts.partials.modify_button')
              </div>
            </td>
          </tr>
          {{ Form::open(['route' => 'post.view', 'method' => 'POST','id'=>'form'.$post->id,'onsubmit'=>'return false']) }}
          <input type="hidden" name="id" value="{{ $post->id }}">
          {{ Form::close() }}
          <script>
              $(document).ready(function(){
                  $("#a{{ $post->id }}").click(function(){
                      $("#content{{ $post->id }}").toggle(500);

                      $.ajax({
                          url: '{{ route('post.view') }}',
                          type : "POST",
                          dataType : 'json',
                          data : $("#form{{ $post->id }}").serialize(),
                          success : function(result) {
                              if(result != 'failed') {
                                  document.getElementById('view{{ $post->id }}').innerText = result;
                              }
                          },
                          error: function(result) {
                              bbalert('失敗！');
                          }
                      })
                  });

              });
          </script>
        @endforeach
        </tbody>
      </table>
      <nav class="nav-item" aria-label="Page navigation">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
      </nav>

  </div>
</div>
@endsection