@extends('layouts.master')

@section('page-title', '新增討論主題|和東資訊教學網')

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
    <li class="breadcrumb-item active">新增討論主題</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/discuss.png') }}" alt="討論區logo" width="60">新增討論主題</h1>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>注意！</strong> 討論主題及內容，請遵守資訊倫理，否則應負起法律責任！
      </div>
      {{ Form::open(['route' => 'discuss.store', 'method' => 'POST','id'=>'store','onsubmit'=>'return false;']) }}
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-plus"></i> 主題：
          {{ Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => '標題(扣10資訊幣)','required'=>'required']) }}
        </div>
        <div class="card-body">
          <textarea name="content" class="form-control" placeholder="請輸入內文" required="required"></textarea>
          <br>
          <a href="#" class="btn btn-success" onclick="bbconfirm('store','確定新增？')"><i class="fa fa-plus"></i> 新增</a>
        </div>
      </div>
      <input type="hidden" name="depend_on" value="0">
      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection