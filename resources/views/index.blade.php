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
          <i class="fa fa-users"></i> 最新公告
        </div>
        <div class="card-body">
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
          <i class="fa fa-users"></i> 群組各項排名
        </div>
        <div class="card-body">
          {{ Form::open(['route' => 'index', 'method' => 'POST']) }}
          {{ Form::select('group_id', $groups, $group, ['id' => 'group_id','placeholder'=>'請先選擇群組','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 存款排行
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
    <div class="col-lg-4">
      <!-- Example Pie Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pie-chart"></i> 打字排行
        </div>
        <div class="card-body">
          @if($group)
            <table class="table table-hover">
              <thead>
              <tr>
                <th>名次</th>
                <th>學生名稱</th>
                <th>文章</th>
                <th>打字速度</th>
              </tr>
              </thead>
              <tbody>
              <?php $i = 1; ?>
              @foreach($top_type3 as $k => $v)
                <tr>
                  <td>{{ $i }} @if($i == 1)<img src="{{ asset('img/crown.png') }}">@endif</td>
                    <?php $name = (empty($user_data[$k]['nickname']))?$user_data[$k]['username']:$user_data[$k]['nickname'];  ?>
                  <td class="text-primary"><img src="{{ url('avatars/'.$k) }}" width="30" height="30" class="rounded-circle">{{ $name }}</td>
                  <td>{{ $user_data[$k]['article'] }}</td>
                  <td>{{ $v }} 字/分</td>
                </tr>
                <?php $i++; ?>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-files-o"></i> 發表文章排行
        </div>
        <div class="card-body">

        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-area-chart"></i> 作業按讚排行
    </div>
    <div class="card-body">
    </div>
  </div>
  <div class="row">

  </div>
</div>
@endsection