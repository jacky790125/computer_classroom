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
          <div class="col-4">
            {{ Form::open(['route' => 'admin.account.store', 'method' => 'POST','name'=>'form1','id'=>'store_account','onsubmit'=>'return false;']) }}
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">帳號*</label>
              {{ Form::text('username', null, ['id' => 'username', 'class' => 'form-control', 'placeholder' => '帳號','required'=>'required']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">密碼*</label>
              {{ Form::password('password1', ['id' => 'password1', 'class' => 'form-control','placeholder' => '密碼','required'=>'required']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">重複密碼*</label>
              {{ Form::password('password2', ['id' => 'password2', 'class' => 'form-control','placeholder' => '再一次密碼','required'=>'required','onchange'=>'checkpwd()']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">姓名*</label>
              {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '姓名','required'=>'required']) }}
            </div>
            <div class="form-group">
              <label for="category_id">群組：</label>
              {{ Form::select('group_id', $groups_array, null, ['id' => 'group_id', 'class' => 'form-control','placeholder'=>'請選擇群組']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">性別</label><br>
              　　{{ Form::radio('sex', '1') }}男生　　{{ Form::radio('sex', '2') }}女生
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">年_班_座號</label>
              {{ Form::text('year_class_num', null, ['id' => 'year_class_num', 'class' => 'form-control', 'placeholder' => '6_01_01','required'=>'required']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">電子郵件</label>
              {{ Form::email('email', null,['class' => 'form-control','placeholder' => 'example.gmail.com']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">個人網站</label>
              {{ Form::text('website', null, ['id' => 'website', 'class' => 'form-control', 'placeholder' => 'http://www.example.com.tw( 含 http:// )']) }}
            </div>
            <div class="form-group">
              <i class="fa fa-dot-circle-o"></i> <label for="title">帳號停用？</label><br>
              　　{{ Form::radio('un_active', '0',true) }}啟用　　{{ Form::radio('un_active', '1') }}停用
            </div>
            <a href="#" class="btn btn-success" onclick="checkpwd2()"><i class="fa fa-plus-square"></i> 新增使用者</a>
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