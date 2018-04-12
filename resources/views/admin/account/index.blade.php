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
            <a class="nav-link active" href="{{ route('admin.account.index') }}">帳號管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.account.group') }}">群組管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.search') }}">查user_id</a>
          </li>
      </ul>
      <table class="table table-light">
        <tr>
          <td>
            <div clss="text-left">
              <a class="btn btn-success" href="{{ route('admin.account.create') }}"><i class="fa fa-plus"></i> 1.新增單筆</a>
            </div>
          </td>
          <td style="text-align:right">
            {{ Form::open(['route' => 'admin.account.storeMore', 'method' => 'POST','id'=>'upload_csv','files'=>true]) }}
            <a class="btn btn-primary" href="{{ route('admin.account.download_csv') }}"><i class="fa fa-cloud-download"></i> 2.1.多筆先下載範本</a>
            <input name="csv" type="file" required="required" multiple>
            <a class="btn btn-success" href="#" onclick="bbconfirm('upload_csv','你確定要大量匯入嗎？')"><i class="fa fa-cloud-upload"></i> 2.2.再匯入上傳多筆</a>
            {{ Form::close() }}
          </td>
        </tr>
      </table>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-users"></i> 選擇群組
          {{ Form::open(['route' => 'admin.account.index', 'method' => 'POST']) }}
          {{ Form::select('group_id', $groups, $group, ['id' => 'group_id', 'class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
          {{ Form::close() }}
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" width="100%" cellspacing="0">
              <thead>
              <tr>
                <th>群組</th>
                <th>年班座號</th>
                <th>帳(學)號</th>
                <th>姓名</th>
                <th>狀態</th>
                <th>動作</th>
              </tr>
              </thead>
              <tbody>
              <?php $updated_date="1978-10-26 00:00:00"; ?>
              @foreach($users as $user)
              <tr>
                <?php $group_name = (empty($user->group))?"無群組":$user->group->name; ?>
                <td>{{ $user->group_id }} - {{ $group_name }}</td>
                <td>{{ $user->year_class_num }}</td>
                <td>{{ $user->username }}</td>
                <td>
                  @if($user->sex == "1")
                    <img src="{{ asset('img/boy.gif') }}"><span class="text-primary">{{ $user->name }}</span>
                  @elseif($user->sex =="2")
                    <img src="{{ asset('img/girl.gif') }}"><span class="text-danger">{{ $user->name }}</span>
                  @else
                    <img src="{{ asset('img/user.png') }}" height="25">{{ $user->name }}
                  @endif
                </td>
                @if($user->active == 1)
                  <td><span class="text-success">啟用</span></td>
                @elseif($user->active == 2)
                  <td><span class="text-info">轉出</span></td>
                @else
                  <td><span class="text-danger">停用</span></td>
                @endif
                <td><a href="{{ route('admin.account.edit',$user->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i> 編輯</a></td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection