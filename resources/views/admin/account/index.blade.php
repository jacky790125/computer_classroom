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
    <div class="col-4">
      <h2>群組</h2>
      <table class="table table-light">
        <tr>
          <th>
            id
          </th>
          <th>
            名稱
          </th>
          <th>
            動作
          </th>
        </tr>
        <tr>
          {{ Form::open(['route'=>'admin.group.store', 'method' => 'POST','id'=>'store_group','onsubmit'=>'return false;']) }}
          <td>
          </td>
          <td>
            {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '群組名稱','required'=>'required']) }}
          </td>
          <td>
            <a href="#" class="btn btn-success" onclick="bbconfirm('store_group','你確定要新增群組嗎？')"><i class="fa fa-plus-circle"></i> 新增群組</a>
          </td>
          {{ Form::close() }}
        </tr>
        @foreach($groups as $group)
          <tr>
            {{ Form::open(['route'=>['admin.group.update',$group->id], 'method' => 'PATCH','id'=>'update_group'.$group->id]) }}
            <td>
              {{ $group->id }}
            </td>
            <td>
              @if($group->id == 1 or $group->id == 2)
              {{ $group->name }}
              @else
                {{ Form::text('name', $group->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '群組名稱','required'=>'required','onsubmit'=>'return false']) }}
              @endif
            </td>
            <td>
              @if($group->id > 2)
                <a href="#" class="btn btn-info" onclick="bbconfirm('update_group{{ $group->id }}','你確定要修改這個群組嗎？')"><i class="fa fa-floppy-o"></i> 儲存修改</a>
              @endif
            </td>
            {{ Form::close() }}
          </tr>
        @endforeach
      </table>
    </div>
    <div class="col-8">
      <h2>帳號</h2>
      <table class="table table-light">
        <tr>
          <td>
            <div clss="text-left">
              <a class="btn btn-success" href="{{ route('admin.account.create') }}"><i class="fa fa-plus"></i> 新增單筆</a>
            </div>
          </td>
          <td style="text-align:right">
            {{ Form::open(['route' => 'admin.account.storeMore', 'method' => 'POST','id'=>'upload_csv','files'=>true]) }}
            <a class="btn btn-primary" href="{{ route('admin.account.download_csv') }}"><i class="fa fa-cloud-download"></i> 先下載範本</a>
            <input name="csv" type="file" required="required" multiple>
            <a class="btn btn-success" href="#" onclick="bbconfirm('upload_csv','你確定要大量匯入嗎？')"><i class="fa fa-cloud-upload"></i> 再匯入</a>
            {{ Form::close() }}
          </td>
        </tr>
      </table>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-users"></i> <span class="glyphicon glyphicon-adjust"></span>帳號列表</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
              <tr>
                <th>群組</th>
                <th>年班座號</th>
                <th>帳(學)號</th>
                <th>性別</th>
                <th>狀態</th>
                <th>動作</th>
              </tr>
              </thead>
              <tfoot>
              <tr>
                <th>群組</th>
                <th>年班座號</th>
                <th>帳(學)號</th>
                <th>性別</th>
                <th>狀態</th>
                <th>動作</th>
              </tr>
              </tfoot>
              <tbody>
              <?php $updated_date="1978-10-26 00:00:00"; ?>
              @foreach($users as $user)
              <tr>
                <td>{{ $user->group_id }} - {{ $user->group->name }}</td>
                <td>{{ $user->year_class_num }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                @if($user->active == 1)
                  <td><span class="text-success">啟用</span></td>
                @elseif($user->active == 2)
                  <td><span class="text-info">轉出</span></td>
                @else
                  <td><span class="text-danger">停用</span></td>
                @endif
                <td><a href="{{ route('admin.account.edit',$user->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> 編輯</a></td>
              </tr>
                <?php
                  $this_date = $user->updated_at;
                  if($this_date > $updated_date) $updated_date = $this_date;
                ?>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">{{ $updated_date }} updated</div>
      </div>
    </div>
  </div>
</div>
@endsection