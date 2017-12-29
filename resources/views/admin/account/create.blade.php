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
    <li class="breadcrumb-item">
      <a href="{{ route('admin.account.index') }}">帳號管理</a>
    </li>
    <li class="breadcrumb-item active">新增使用者</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1>帳號管理</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-plus-circle"></i> 新增使用者
        </div>
        <div class="card-body">
          <div class="col-6">
           {{ Form::open(['route' => 'admin.account.store', 'method' => 'POST','name'=>'form1','id'=>'store_account','onsubmit'=>'return false;']) }}
          <table class="table table-light">
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 帳號*：
              </td>
              <td colspan="2">
                {{ Form::text('username', null, ['id' => 'username', 'class' => 'form-control', 'placeholder' => '帳號','required'=>'required']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 密碼*：
              </td>
              <td>
                {{ Form::password('password1', ['id' => 'password1', 'class' => 'form-control','placeholder' => '密碼','required'=>'required']) }}
              </td>
              <td>
                {{ Form::password('password2', ['id' => 'password2', 'class' => 'form-control','placeholder' => '再一次密碼','required'=>'required','onchange'=>'checkpwd()']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 姓名*：
              </td>
              <td colspan="2">
                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '姓名','required'=>'required']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 群組 ：
              </td>
              <td colspan="2">
                {{ Form::select('group_id', $groups_array, null, ['id' => 'group_id', 'class' => 'form-control','placeholder'=>'請選擇群組']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 性別 ：
              </td>
              <td colspan="2">
                {{ Form::radio('sex', '1') }}男生　　{{ Form::radio('sex', '2') }}女生
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 年班座號 ：
              </td>
              <td colspan="2">
                {{ Form::text('year_class_num', null, ['id' => 'year_class_num', 'class' => 'form-control','maxlength'=>'5','placeholder' => '60101','required'=>'required']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 電子郵件 ：
              </td>
              <td colspan="2">
                {{ Form::email('email', null,['class' => 'form-control','placeholder' => 'example.gmail.com']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 個人網站 ：
              </td>
              <td colspan="2">
                {{ Form::text('website', null, ['id' => 'website', 'class' => 'form-control', 'placeholder' => 'http://www.example.com.tw( 含 http:// )']) }}
              </td>
            </tr>
            <tr>
              <td>
                <i class="fa fa-dot-circle-o"></i> 帳號停用 ？
              </td>
              <td colspan="2">
                {{ Form::radio('active', '1',true) }}啟用　　{{ Form::radio('active', '2') }}學生轉出　　{{ Form::radio('active', '0') }}停用
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <a href="#" class="btn btn-success" onclick="checkpwd2()"><i class="fa fa-plus-square"></i> 新增使用者</a>
              </td>
            </tr>
          </table>
          <script>
              function checkpwd()
              {
                  with(document.all){
                      if(password1.value!=password2.value)
                      {
                          bbalert('兩次密碼不同！');
                          password1.value = "";
                          password2.value = "";
                      }
                  }
              }
              function checkpwd2()
              {
                  with(document.all) {
                      if (password1.value == "" | password2.value == "") {
                          bbalert('密碼不得為空值！');
                          password1.value = "";
                          password2.value = "";
                          return false;
                      }else if(name.value == ""){
                          bbalert('姓名不得為空值！');
                      }else if(username.value == ""){
                          bbalert('帳號不得為空值！');
                      }
                      else{
                          bbconfirm('store_account','你確定要新增嗎？');
                      }
                  }
              }
          </script>
          {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@include('layouts.bootbox')