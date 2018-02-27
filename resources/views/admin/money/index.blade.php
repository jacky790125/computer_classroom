@extends('layouts.master')

@section('page-title', '貨幣管理|和東資訊教學網')

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
    <li class="breadcrumb-item active">貨幣管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/link.png') }}" alt="好站連結logo" width="60">貨幣管理</h1>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>
            勾選
          </th>
          <td>
            班級
          </td>
          <th>
            姓名(id)
          </th>
          <th>
            項目(id)
          </th>
          <th>
            金額
          </th>
          <th>
            說明
          </th>
          <th>
            時間點
          </th>
          <th>
            刪除
          </th>
        </tr>
        </thead>
        <tbody>
        {{ Form::open(['route'=>'money.admin_destroy_check','method'=>'post','id'=>'destroy','onsubmit'=>'return false;']) }}
        @foreach($moneys as $money)
          <tr>
            <td>
              <input type="checkbox" name="stud_money[]" value="{{ $money->id }}">
            </td>
            <td>
              {{ $money->user->year_class_num }}
            </td>
            <td>
              {{ $money->user->name }}({{ $money->user_id }})
            </td>
            <td>
              {{ $money->thing }}({{ $money->thing_id }})
            </td>
            <td>
              {{ $money->stud_money }}
            </td>
            <td>
              {{ $money->description }}
            </td>
            <td>
              {{ $money->created_at }}
            </td>
            <td>
              <?php
                $page = \Illuminate\Support\Facades\Input::input('page');
                if(empty($page)) $page = 1;
                ?>
              <a href="{{ url('money/admin/index')."?page=".$page }}" class="btn btn-danger" id="del{{ $money->id }}" onclick="bbconfirm2('del{{ $money->id }}','確定刪除？')">刪除</a>
            </td>
          </tr>
        @endforeach
        <tr>
          <td>
            <a href="#" class="btn btn-danger" onclick="bbconfirm('destroy','刪除勾選？')">刪除勾選</a>
          </td>
        </tr>
        {{ Form::close() }}
        </tbody>
      </table>
      <nav class="nav-item" aria-label="Page navigation">
        {{ $moneys->links('vendor.pagination.bootstrap-4') }}
      </nav>
    </div>
  </div>
</div>
@endsection