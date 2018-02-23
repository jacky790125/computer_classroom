@extends('layouts.master')

@section('page-title', '訊息管理|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">訊息管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/message.png') }}" alt="訊息管理logo" width="60">訊息管理-群組寄信</h1>
      <table class="table table-light">
        <thead>
        <th width="200">
          收件者群組：
        </th>
        <th>
          主題：
        </th>
        </thead>
        <tbody>
        {{ Form::open(['route'=>'admin.message.store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
        <tr>
          <td>
            {{ Form::select('for[]', $groups, null, ['id' => 'for', 'class' => 'form-control','multiple'=>'multiple','placeholder'=>'請多選群組']) }}
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
        {{ Form::close() }}
        </tbody>
      </table>

      <div class="card mb-3">
        <div class="card-header">
          <h4>給予獎懲</h4>
        </div>
        <div class="card-body">
          {{ Form::open(['route'=>'stud_message.give','method'=>'post','id'=>'give','onsubmit'=>'return false;']) }}
          <table class="table">
            <thead>
            <tr>
              <th>
                對方帳號
              </th>
              <th>
                金額
              </th>
              <th>
                事由
              </th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                {{ Form::text('username',null,['id'=>'username','class' => 'form-control', 'placeholder' => '請輸入對方帳號','required'=>'required']) }}
              </td>
              <td>
                {{ Form::text('stud_money',null,['id'=>'stud_money','class' => 'form-control', 'placeholder' => '請輸入金額','required'=>'required']) }}
              </td>
              <td>
                {{ Form::text('description',null,['id'=>'description','class' => 'form-control', 'placeholder' => '請輸入事由','required'=>'required']) }}
              </td>
            </tr>
            </tbody>
          </table>
          <a href="#" class="btn btn-success" onclick="bbconfirm('give','真的送出？')">送出</a>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection