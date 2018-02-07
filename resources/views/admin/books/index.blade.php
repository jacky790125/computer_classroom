@extends('layouts.master')

@section('page-title', '連結管理|和東資訊教學網')

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
    <li class="breadcrumb-item active">課程管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/book.png') }}" alt="課程logo" width="60">課程管理</h1>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>
            id
          </th>
          <th>
            名稱
          </th>
          <th>
            說明
          </th>
          <th>
            連結
          </th>
          <th>
            動作
          </th>
        </tr>
        </thead>
        <tbody>
        {{ Form::open(['route'=>'book.admin_store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
        <tr>
          <td>

          </td>
          <td>
            {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
          </td>
          <td>
            {{ Form::text('description',null,['id'=>'description','class' => 'form-control', 'placeholder' => '請輸入說明','required'=>'required']) }}
          </td>
          <td>
            {{ Form::text('link',null,['id'=>'link','class' => 'form-control', 'placeholder' => '請輸入連結 http://','required'=>'required']) }}
          </td>
          <td>
            <a href="#" class="btn btn-success" onclick="bbconfirm('store','你確定要新增')">新增連結</a>
          </td>
        </tr>
        {{ Form::close() }}
        @foreach($books as $book)
          {{ Form::open(['route'=>['book.admin_update',$book->id],'method'=>'post','id'=>'update'.$book->id,'onsubmit'=>'return false;']) }}
          <tr>
            <td>
              {{ $book->id }}
            </td>
            <td>
              {{ Form::text('title',$book->title,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
            </td>
            <td>
              {{ Form::text('description',$book->description,['id'=>'description','class' => 'form-control', 'placeholder' => '請輸入說明','required'=>'required']) }}
            </td>
            <td>
              {{ Form::text('link',$book->link,['id'=>'link','class' => 'form-control', 'placeholder' => '請輸入連結','required'=>'required']) }}
            </td>
            <td>
              <a href="#" class="btn btn-primary" onclick="bbconfirm('update{{ $book->id }}','確定修改？')">儲存修改</a>
              <a href="{{ route('book.admin_del',$book->id) }}" class="btn btn-danger" id="del{{ $book->id }}" onclick="bbconfirm2('del{{ $book->id }}','確定刪除？')">刪除</a>
            </td>
          </tr>
          {{ Form::close() }}
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection