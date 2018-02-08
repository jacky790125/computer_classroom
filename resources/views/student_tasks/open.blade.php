@extends('layouts.master')

@section('page-title', '作品欣賞|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
      <li class="breadcrumb-item">
          <a href="{{ route('student_task.select') }}">作品欣賞</a>
      </li>
    <li class="breadcrumb-item active">{{ $task->title }}</li>
  </ol>
  <div class="row">
    <div class="col-12">
    <h1><img src="{{ asset('img/title/one.png') }}" alt="觀看作業logo" width="60">觀看作品</h1>
        <table class="table" id="dataTable12">
            <thead>
            <tr>
                <th>作品</th>
            </tr>
            </thead>
          @foreach($student_tasks as $student_task)
              <tr onmouseover="add_view{{ $student_task->id }}()">
                  <td>
                    <div class="card mb-3">
                      <div class="card-header">
                          <?php $name = (empty($student_task->user->nickname))?$student_task->user->username:$student_task->user->nickname;  ?>
                          <img src="{{ url('avatars/'.$student_task->user_id) }}" width="30" height="30" class="rounded-circle">{{ $name }}　<a href="#" id="submit{{ $student_task->id }}" class="btn btn-primary" onclick="return false"><i class="fa fa-thumbs-o-up"></i> 讚</a>　　　　<i class="fa fa-heart"></i> <i id="likes{{ $student_task->id }}">{{ $student_task->likes }}</i>　　<i class="fa fa-eye"></i> <i id="views{{ $student_task->id }}">{{ $student_task->views }}</i>
                      </div>
                      <div class="card-body">
                        @if($student_task->task->type == "text")
                            {!! nl2br($student_task->report) !!}
                        @elseif($student_task->task->type == "img")
                            <img src="{{ url('file/'.$student_task->id) }}" width="600">
                        @elseif($student_task->task->type == "aud")
                            <audio src="{{ url('file/'.$student_task->id) }}" controls>
                              沒有支援這個聲音播放，請更換瀏覽器
                            </audio>
                        @elseif($student_task->task->type == "mov")
                            <video src="{{ url('file/'.$student_task->id) }}" controls>
                              沒有支援這個影片播放，請更換瀏覽器
                            </video>
                        @elseif($student_task->task->type == "scratch2")
                            <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="{{ asset('Scratch.swf') }}" height="600" width="747">
                            <param name="allowScriptAccess" value="sameDomain">
                            <param name="allowFullScreen" value="true">
                            <param name="flashvars" value="project={{ url('file/'.$student_task->id) }}&autostart=false">
                            </object>
                        @elseif($student_task->task->type == "file")
                            <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                        @endif
                      </div>
                        {{ Form::open(['route' => 'student_task.likes', 'method' => 'POST','id'=>'form'.$student_task->id,'onsubmit'=>'return false']) }}
                        <input type="hidden" name="id" value="{{ $student_task->id }}">
                        {{ Form::close() }}
                        {{ Form::open(['route' => 'student_task.views', 'method' => 'POST','id'=>'form'.$student_task->id,'onsubmit'=>'return false']) }}
                        <input type="hidden" name="id" value="{{ $student_task->id }}">
                        {{ Form::close() }}
                        <script>
                            $(document).ready(function(){

                                $("#submit{{ $student_task->id }}").on('click', function(){
                                    $.ajax({
                                        url: '{{ route('student_task.likes') }}',
                                        type : "POST",
                                        dataType : 'json',
                                        data : $("#form{{ $student_task->id }}").serialize(),
                                        success : function(result) {
                                            if(result != 'failed') {
                                                document.getElementById('likes{{ $student_task->id }}').innerText = result;
                                                document.getElementById('submit{{ $student_task->id }}').className = "btn btn-default";
                                            }else{
                                                bbalert('你按過讚了！');
                                                document.getElementById('submit{{ $student_task->id }}').className = "btn btn-default";
                                            }
                                        },
                                        error: function(result) {
                                            bbalert('失敗！');
                                        }
                                    })
                                });


                            });

                            function add_view{{ $student_task->id }}() {
                                $.ajax({
                                    url: '{{ route('student_task.views') }}',
                                    type : "POST",
                                    dataType : 'json',
                                    data : $("#form{{ $student_task->id }}").serialize(),
                                    success : function(result) {
                                        if(result != 'failed') {
                                            document.getElementById('views{{ $student_task->id }}').innerText = result;
                                        }
                                    },
                                    error: function(result) {
                                        console.log(result);
                                    }
                                })
                            }
                        </script>
                    </div>
                  </td>
              </tr>
          @endforeach
        </table>
    </div>
  </div>
</div>
@endsection