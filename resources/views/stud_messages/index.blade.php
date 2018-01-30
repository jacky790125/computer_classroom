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
          <h2><i class="fa fa-mail-reply"></i> 寄件盒</h2>
        </div>
        <div class="card-body">
          <table class="table table-light">
            <thead>
            <th width="200">
              收件者帳號：
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
          <h2><i class="fa fa-mail-forward"></i> 收件盒</h2>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
              <tr>
                <th width="200">時間</th>
                <th>寄件人(帳號)</th>
                <th>標題</th>
                <th width="50">狀態</th>
                <th>動作</th>
              </tr>
              </thead>
              <tbody>
              @foreach($messages as $message)
                  <?php
                  $user = \App\User::where('username','=',$message->from)->first();
                  if($message->read == "0"){
                      $bold = "font-weight-bold";
                  }else{
                      $bold = "";
                  }
                  ?>
                <tr class="{{ $bold }}">
                  <td>
                    {{ $message->created_at }}
                  </td>
                  <td>
                    {{ $user->name }}({{ $message->from }})
                  </td>
                  <td nowrap>
                    {{ $message->title }}
                  </td>
                  <td>
                    @if($message->read == "0")
                      <p class="text-danger"><i class="fa fa-star"></i>未讀</p>
                    @else
                      已讀
                    @endif
                  </td>
                  <td>
                    <a href="#" class="btn btn-primary" onclick="openwindow('{{ route('stud_message.read',$message->id) }}')">打開</a>
                    @if($message->read == "1")
                    <a href="#" class="btn btn-danger">刪除</a>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <script>
                function openwindow(url_str){
                    window.open (url_str,"閱讀信件","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=800,Height=600");
                }

            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection