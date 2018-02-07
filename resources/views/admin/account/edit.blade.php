@extends('layouts.master')

@section('page-title', '編輯帳號|和東資訊教學網')

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
    <li class="breadcrumb-item">
      <a href="{{ route('admin.account.index') }}">帳號管理</a>
    </li>
    <li class="breadcrumb-item active">編輯帳號</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>帳號管理</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pencil-square"></i> 編輯帳號
        </div>
        <div class="card-body">
          <div class="col-6">
           {{ Form::open(['route' => ['admin.account.update',$user->id], 'method' => 'POST','name'=>'form1','id'=>'update_account','onsubmit'=>'return false;']) }}
            <table class="table table-light">
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 帳號*：
                </td>
                <td>
                  {{ Form::text('username', $user->username, ['id' => 'username', 'class' => 'form-control', 'placeholder' => '帳號','required'=>'required']) }}
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 姓名*：
                </td>
                <td>
                  {{ Form::text('name', $user->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '姓名','required'=>'required']) }}
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 群組 ：
                </td>
                <td>
                  {{ Form::select('group_id', $groups_array, $user->group_id, ['id' => 'group_id', 'class' => 'form-control','placeholder'=>'請選擇群組']) }}
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 性別 ：
                </td>
                <td>
                  <?php
                    if($user->sex == "1"){
                        $sex_b = "true";
                        $sex_g = "";
                    }elseif($user->sex == "2"){
                        $sex_b = "";
                        $sex_g = "true";
                    }else{
                        $sex_b = "";
                        $sex_g = "";
                    }
                  ?>
                  {{ Form::radio('sex', '1',$sex_b) }}男生　　{{ Form::radio('sex', '2',$sex_g) }}女生
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 年班座號* ：
                </td>
                <td>
                  {{ Form::text('year_class_num', $user->year_class_num, ['id' => 'year_class_num', 'class' => 'form-control','maxlength'=>'9','placeholder' => '例：60101','required'=>'required']) }}
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 電子郵件 ：
                </td>
                <td>
                  {{ Form::email('email', $user->email,['class' => 'form-control','placeholder' => '例：example.gmail.com']) }}
                </td>
              </tr>
              <tr>
                <td>
                  <i class="fa fa-dot-circle-o"></i> 個人網站 ：
                </td>
                <td>
                  {{ Form::text('website', $user->website, ['id' => 'website', 'class' => 'form-control', 'placeholder' => '例：http://www.example.com.tw( 含 http:// )']) }}
                </td>
              </tr>
              <tr>
                <td>
                    <?php
                    if($user->active == "1"){
                        $active1 = "true";
                        $active0 = "";
                        $active2 = "";
                    }elseif($user->active == "2"){
                        $active1 = "";
                        $active0 = "";
                        $active2 = "true";
                    }elseif($user->active == "0"){
                        $active1 = "";
                        $active0 = "true";
                        $active2 = "";
                    }
                    ?>
                  <i class="fa fa-dot-circle-o"></i> 帳號停用 ？
                </td>
                <td>
                  {{ Form::radio('active', '1',$active1) }}啟用　　{{ Form::radio('active', '2',$active2) }}學生轉出　　{{ Form::radio('active', '0',$active0) }}停用
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <a href="#" class="btn btn-success" onclick="bbconfirm('update_account','你確定要儲存嗎？');"><i class="fa fa-floppy-o"></i> 儲存使用者</a>
                </td>
              </tr>
              {{ Form::close() }}
              <tr>
                <td>
                  <a href="{{ route('admin.account.reset',$user->id) }}" class="btn btn-info" id="reset_account" onclick="bbconfirm2('reset_account','你確定要重置密碼為：{{ env('DEFAULT_USER_PWD') }}')"><i class="fa fa-reply-all"></i> 還原密碼</a>
                  <a href="{{ route('admin.account.destroy',$user->id) }}" class="btn btn-danger" id="destroy_account" onclick="bbconfirm2('destroy_account','你確定要刪除帳號：{{ $user->username }}({{ $user->name }})')"><i class="fa fa-trash"></i> 刪除帳號</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection