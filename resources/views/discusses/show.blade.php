@extends('layouts.master')

@section('page-title', '討論主題|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('discuss.index') }}">大家討論</a>
    </li>
    <li class="breadcrumb-item active">{{ $discuss->title }}</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/discuss.png') }}" alt="討論區logo" width="60">{{ $discuss->title }} ({{ $discuss->created_at }})</h1>

      <div class="card mb-3">
        <div class="card-header text-right">
          @if($discuss->user_id == auth()->user()->id)
          <a href="{{ route('discuss.destroy',$discuss->id) }}" id="del" class="btn btn-danger" onclick="bbconfirm2('del','真的要刪除？')"><i class="fa fa-trash"></i> 刪除主題</a>
          @else
          <a href="{{ route('discuss.say_bad',$discuss->id) }}" class="btn btn-warning" id="say_bad" onclick="bbconfirm2('say_bad','確定嗎？胡亂檢舉亦會有倫理上的問題喔！')"><i class="fa fa-eye"></i> 檢舉主題</a>
          @endif
        </div>
        <div class="card-body">
            <?php

            if(empty($discuss->user->nickname)){
                $showname = $discuss->user->username;
            }else{
                $showname = $discuss->user->nickname;
            }
            ?>
          <p class="text-left"><img src="{{ url('avatars/'.$discuss->user_id) }}" width="30" height="30" class="rounded-circle"> {{  $showname }}</p>
              <p>{{ $discuss->content }}</p>
        </div>
        <div class="card-footer">
          <table width="100%">
            @foreach($replys as $reply)
            <tr>
              <td width="150" class="text-primary">
                  <?php
                  if(empty($reply->user->nickname)){
                      $showname = $reply->user->username;
                  }else{
                      $showname = $reply->user->nickname;
                  }
                  ?>
                <img src="{{ url('avatars/'.$reply->user_id) }}" width="30" height="30" class="rounded-circle"> {{  $showname }}
              </td>
              <td>
                <input class="form-control" value="{{ $reply->content }}" readonly="readonly">
              </td>
            </tr>
            <tr>
              <td width="20" colspan="2">
                {{ $reply->created_at }}
                @if($reply->user_id == auth()->user()->id)
                  <a href="{{ route('discuss.reply_destroy',$reply->id) }}" id="del{{ $reply->id }}" onclick="bbconfirm2('del{{ $reply->id }}','真的要刪回文？')">刪除</a>
                @else
                  <a href="{{ route('discuss.reply_say_bad',$reply->id) }}" id="say_bad{{ $reply->id }}" class="text-warning" onclick="bbconfirm2('say_bad{{ $reply->id }}','確定嗎？胡亂檢舉，也是有資訊倫理的問題喔！')"></i>檢舉</a>
                @endif
              </td>
            </tr>
            <tr>
              <td>
                　
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        <div class="card-footer">
          {{ Form::open(['route' => 'discuss.reply_store', 'method' => 'POST','id'=>'store','onsubmit'=>'return false;']) }}
          <table width="100%">
            <tr>
              <td width="20">
                <img src="{{ url('avatars/'.auth()->user()->id) }}" width="30" height="30" class="rounded-circle">
              </td>
              <td>
                {{ Form::text('content', null, ['id' => 'content', 'class' => 'form-control', 'placeholder' => '撰寫留言(扣5資訊幣)','required'=>'required']) }}
              </td>
              <td width="20">
                <a href="#" class="btn btn-primary" onclick="bbconfirm('store','確定回文？')">送出</a>
              </td>
            </tr>
          </table>
          <input type="hidden" name="title" value="RE:{{ $discuss->title }}">
          <input type="hidden" name="depend_on" value="{{ $discuss->id }}">
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          {{ Form::close() }}
        </div>
      </div>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>注意！</strong> 回文內容，請遵守資訊倫理，否則應負起法律責任！
      </div>
    </div>
  </div>
</div>
@endsection