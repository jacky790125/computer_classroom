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
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('discuss.index') }}">大家討論</a>
            </li>
            @if(auth()->user()->group_id == 1)
              <li class="nav-item">
                <a class="nav-link active" href="#">依發表時間列出</a>
              </li>
            @endif
          </ul>
            <table class="table table-hover">
            <thead>
            <tr>
              <th width="160">
                日期
              </th>
              <th width="300">
                發表者
              </th>
              <th>
                標題
              </th>
              <th>
                內文
              </th>
              <th>
                動作
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
                  {{ $discuss->user->year_class_num }}-{{ $discuss->user->name }}
                </td>
                <td>
                  {{ $discuss->title }}
                </td>
                <td>
                  {{ $discuss->content }}
                </td>
                <td>
                  <a href="{{ route('discuss.say_bad',$discuss->id) }}" class="btn btn-warning" id="say_bad" onclick="bbconfirm2('say_bad','確定嗎？！')"><i class="fa fa-eye"></i> 檢舉</a>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          {{ $discusses->links('vendor.pagination.bootstrap-4') }}
        @endif
      </div>
    </div>
  </div>
@endsection