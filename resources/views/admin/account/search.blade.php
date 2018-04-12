@extends('layouts.master')

@section('page-title', '帳號管理|和東資訊教學網')

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
    <li class="breadcrumb-item active">帳號管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/account.png') }}" alt="帳號管理logo" width="60">帳號管理</h1>
    </div>
    </div>

  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.account.index') }}">帳號管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.account.group') }}">群組管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.search') }}">查user_id</a>
          </li>
      </ul>
        <table class="table table-light">
            <tr>
                {{ Form::open(['route' => 'admin.search', 'method' => 'POST','id'=>'search']) }}
                <td width="200">
                    {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '名稱','required'=>'required']) }}
                </td>
                <td width="100">
                    <input type="radio" name="type" value="nickname" checked>暱稱
                </td>
                <td width="100">
                    <input type="radio" name="type" value="username">帳號
                </td>
                <td>
                    <a href="#" class="btn btn-success" onclick="bbconfirm('search','確定？')">送出</a>
                </td>
                {{ Form::close() }}
            </tr>
        </table>
        <table class="table table-light">
            <thead>
            <tr>
                <th>user_id</th><th>帳號</th><th>姓名</th><th>班級座號</th><th>暱稱</th><th>資訊幣餘額</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    {{ $user->username }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->year_class_num }}
                </td>
                <td>
                    {{ $user->nickname }}
                </td>
                <td>
                    {{ $user->money }}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
@endsection