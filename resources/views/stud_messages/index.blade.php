@extends('layouts.master')

@section('page-title', '我的訊息|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">我的訊息</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/mail.png') }}" alt="我的訊息logo" width="60">訊息中心</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-mail-reply"></i> 寄件盒</div>
        <div class="card-body">
          <table class="table table-light">
            <thead>
            <th width="200">
              收件者：
            </th>
            <th>
              主題：
            </th>
            </thead>
            <tbody>
            {{ Form::open(['route'=>'stud_message.store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
            <tr>
              <td>
                {{ Form::text('to',null,['id'=>'to','class' => 'form-control', 'placeholder' => '請輸入收件者','required'=>'required']) }}
              </td>
              <td>
                {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入標題','required'=>'required']) }}
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <textarea name="content" class="form-control" placeholder="訊息內文"></textarea>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <a href="#" class="btn btn-success" onclick="bbconfirm('store','確定寄出？')">寄出</a>
              </td>
            </tr>
            <input type="hidden" name="from" value="{{ auth()->user()->username }}">
            <input type="hidden" name="read" value="0">
            {{ Form::close() }}
            </tbody>
          </table>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-mail-forward"></i> 收件盒</div>
        <div class="card-body">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection