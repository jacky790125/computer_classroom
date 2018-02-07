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
        <table class="table table-hover">
          <thead>
          <tr>
            <th width="160">
              日期
            </th>
            <th>
              標題
            </th>
            <th width="100">
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
                {{ $discuss->created_at }}
              </td>
              <td>
                {{ $discuss->title }}
              </td>
              <td>
                {{ $discuss->user_id }}
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
      </div>
    </div>
  </div>
@endsection