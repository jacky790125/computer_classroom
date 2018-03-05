@extends('layouts.master')

@section('page-title', '首頁|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">儀表統計</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/dashboard.png') }}" alt="儀表統計logo" width="60">儀表統計</h1>
    </div>
  </div>
  <p>
  <a href="#" class="btn btn-primary disabled">最新</a>
  <a href="{{ route('index2') }}" class="btn btn-primary">排名</a>
  </p>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-list"></i> 最新公告 Top 3</h3>
        </div>
        <div class="card-body">
          <table class="table table-hover table-bordered">
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
                <th>
                  <a href="#" id="a{{ $post->id }}" class="btn btn-primary btn-xs"><i class="fa fa-share"></i> {{ $post->title }}</a>
                </th>
                <th>{{ $post->user->nickname }}</th>
                <th><p id="view{{ $post->id }}">{{ $post->view }}</p></th>
              </tr>
              <tr class="bg-light" id="content{{ $post->id }}" style="display: none">
                <td colspan="4">
                {!! $post->content !!}
                </td>
              </tr>
              {{ Form::open(['route' => 'post.view', 'method' => 'POST','id'=>'form'.$post->id,'onsubmit'=>'return false']) }}
              <input type="hidden" name="id" value="{{ $post->id }}">
              {{ Form::close() }}
              <script>
                  $(document).ready(function(){
                      $("#a{{ $post->id }}").click(function(){
                          $("#content{{ $post->id }}").toggle(5);

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
          <a href="{{ route('post.index') }}">更多公告...</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-bank"></i> 最新作品 Top 3</h3>
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
          @foreach($student_tasks as $student_task)
          <td>
            <div class="card mb-3">
              <div class="card-header">
                <h4>{{ $student_task->task->title }}</h4>
                  <?php $name = (empty($student_task->user->nickname))?$student_task->user->username:$student_task->user->nickname;  ?>
                <p class="text-primary"><img src="{{ url('avatars/'.$student_task->user->id) }}" width="30" height="30" class="rounded-circle">{{ $name }}</p>
              </div>
              <div class="card-body">
                @if($student_task->task->type == "text")
                  {!! nl2br($student_task->report) !!}
                @elseif($student_task->task->type == "img")
                  <img src="{{ url('file/'.$student_task->id) }}" width="200">

                @elseif($student_task->task->type == "aud")
                  <audio src="{{ url('file/'.$student_task->id) }}" controls>
                    沒有支援這個聲音播放，請更換瀏覽器
                  </audio>
                @elseif($student_task->task->type == "mov")
                  <video src="{{ url('file/'.$student_task->id) }}" controls>
                    沒有支援這個影片播放，請更換瀏覽器
                  </video>
                @elseif($student_task->task->type == "scratch2")
                  <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="{{ asset('Scratch.swf') }}" height="160" width="200">
                    <param name="allowScriptAccess" value="sameDomain">
                    <param name="allowFullScreen" value="true">
                    <param name="flashvars" value="project={{ url('file/'.$student_task->id) }}&autostart=false">
                  </object>
                @elseif($student_task->task->type == "file")
                  檔案無法預覽
                  <br>
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @endif
              </div>
            </div>

          </td>
          @endforeach
            </tr>
          </table>

          <a href="{{ route('student_task.select') }}">更多作品...</a>
        </div>
      </div>
    </div>
  </div>

</div>
<script>
    function openwindow(url_str){
        window.open (url_str,"新視窗","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=990,Height=800");
    }

</script>
@endsection