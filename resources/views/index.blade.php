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
                <th>{{ $post->user->name }}</th>
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
          @foreach($student_tasks as $student_task)
          <div class="col-lg-4">
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
                  <br>
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @elseif($student_task->task->type == "aud")
                  <audio src="{{ url('file/'.$student_task->id) }}" controls>
                    沒有支援這個聲音播放，請更換瀏覽器
                  </audio>
                  <br>
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @elseif($student_task->task->type == "mov")
                  <video src="{{ url('file/'.$student_task->id) }}" controls>
                    沒有支援這個影片播放，請更換瀏覽器
                  </video>
                  <br>
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @elseif($student_task->task->type == "scratch2")
                  <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="{{ asset('Scratch.swf') }}" height="160" width="200">
                    <param name="allowScriptAccess" value="sameDomain">
                    <param name="allowFullScreen" value="true">
                    <param name="flashvars" value="project={{ url('file/'.$student_task->id) }}&autostart=false">
                  </object>
                  <br>
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @elseif($student_task->task->type == "file")
                  <a href="{{ route('download_student_task',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-download"></i> 按我下載</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
          <a href="{{ route('student_task.select') }}">更多作品...</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-address-card-o"></i> 全部排名</h3>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
            <tr>
              <th>存款最多</th>
              <th>打字最快</th>
              <th>文章最多</th>
              <th>最愛遊戲</th>
              <th>作品最讚</th>
              <th>最多人看</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                <img src="{{ url('avatars/'.$top_money['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_money['name'] }} <a href="#" class="btn btn-info">{{ $top_money['money'] }} 元</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_type['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_type['name'] }} <a href="#" class="btn btn-info">{{ $top_type['type'] }} 字/分</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_discuss['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_discuss['name'] }} <a href="#" class="btn btn-info">{{ $top_discuss['num'] }} 篇</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_game['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_game['name'] }} <a href="#" class="btn btn-info">{{ $top_game['num'] }} 次</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_like['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_like['name'] }} <a href="#" class="btn btn-info">{{ $top_like['like'] }} 次</a>
              </td>
              <td>
                <img src="{{ url('avatars/'.$top_view['id']) }}" width="30" height="30" class="rounded-circle">{{ $top_view['name'] }} <a href="#" class="btn btn-info">{{ $top_view['view'] }} 次</a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          <h3><i class="fa fa-users"></i> 群組各項排名</h3>
        </div>
        <div class="card-body">
          {{ Form::open(['route' => 'index', 'method' => 'POST']) }}
          {{ Form::select('group_id', $groups, $group, ['id' => 'group_id','placeholder'=>'-->請先選擇群組','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 存款 Top 3
        </div>
        <div class="card-body">
        @if($group)
          <table class="table table-hover">
            <thead>
            <tr>
              <th>名次</th>
              <th>學生名稱</th>
              <th>存款</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($top_money3 as $k => $v)
            <tr>
              <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
              <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
              <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
              <td>{{ $v }} 元</td>
            </tr>
              <?php $i++; ?>
            @endforeach
            </tbody>
          </table>
        @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- Example Pie Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pie-chart"></i> 打字 Top 3
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>打字速度</th>
                <th>文章</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_type3 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td>{{ $v }} 字/分</td>
                  <td>{{ $user_data[$k]['article'] }}</td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-files-o"></i> 發表文章 Top 3
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>發表篇數</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_discuss3 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td>{{ $v }} 篇</td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-gamepad"></i> 遊戲次數 Top 3
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>兌換次數</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_game3 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td>{{ $v }} 次</td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-thumbs-up"></i> 作品按讚 Top 10
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>按讚次數</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_like10 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td><a href="#" class="btn btn-info" onclick="openwindow('{{ url('student_task/view_one/'.$user_data[$k]['like']) }}')">{{ $v }} 次</a></td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-eye"></i> 作品觀看 Top 10
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>觀看次數</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_view10 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td><a href="#" class="btn btn-info" onclick="openwindow('{{ url('student_task/view_one/'.$user_data[$k]['view']) }}')">{{ $v }} 次</a></td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
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