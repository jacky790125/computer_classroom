@extends('layouts.master')

@section('page-title', '大家討論|和東資訊教學網')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">儀表統計</a>
      </li>
      <li class="breadcrumb-item active">大家討論</li>
    </ol>
    <div class="row">
      <div class="col-12">
        <h1><img src="{{ asset('img/title/discuss.png') }}" alt="大家討論logo" width="60">大家討論</h1>
        @if(auth()->check())
          <p class="text-right"><a href="{{ route('discuss.create') }}" class="btn btn-success"><i class="fa fa-plus"> 新增討論主題</i></a></p>
          <table class="table table-hover">
            <thead>
            <tr>
              <th width="160">
                日期
              </th>
              <th>
                標題
              </th>
              <th width="300">
                發表者
              </th>
              <th width="80">
                回復數
              </th>
              <th width="80">
                點閱數
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach($discusses as $discuss)
              <tr>
                <td>
                  {{ substr($discuss->created_at,0,10) }}
                </td>
                <td>
                  <a href="{{ route('discuss.show',$discuss->id) }}">{{ $discuss->title }}</a>
                </td>
                <td>
                    <?php
                    if(empty($discuss->user->nickname)){
                        $showname = $discuss->user->username;
                    }else{
                        $showname = $discuss->user->nickname;
                    }
                    ?>
                  <img src="{{ url('avatars/'.$discuss->user_id) }}" width="30" height="30" class="rounded-circle"> {{  $showname }}
                </td>
                <td>
                  {{ $discuss->reply }}
                </td>
                <td>
                  {{ $discuss->views }}
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $discusses->links('vendor.pagination.bootstrap-4') }}

          @if(auth()->user()->group_id == 1)
          <h2 class="text-danger">被檢舉區</h2>
          <table class="table table-hover">
            <thead>
            <tr>
              <th width="160">
                日期
              </th>
              <th>
                標題
              </th>
              <th>
                內容
              </th>
              <th>
                檢舉者
              </th>
              <th>
                發表者
              </th>
              <th>
                動作
              </th>
            </tr>
            </thead>
            <tbody>
            @foreach($bad_discusses as $discuss)
              <tr>
                <td>
                  {{ substr($discuss->created_at,0,10) }}
                </td>
                <td>
                  {{ $discuss->title }}
                </td>
                <td>
                  {{ $discuss->content }}
                </td>
                <td nowrap>
                  <?php
                    $good_user = \App\User::where('id','=',$discuss->say_bad)->first();
                  ?>
                  {{ $good_user->year_class_num }} - {{ $good_user->name }}
                </td>
                <td nowrap="">
                  {{ $discuss->user->year_class_num }} - {{ $discuss->user->name }}
                </td>
                <td>
                  <a href="{{ route('discuss.admin_destroy',$discuss->id) }}" id="admin_del{{ $discuss->id }}" class="btn btn-danger" onclick="bbconfirm2('admin_del{{ $discuss->id }}','刪除？')">刪除</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @endif
        @else
          <div class="alert alert-danger" role="alert">
            <strong>參加討論請先由上方登入！</strong>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection