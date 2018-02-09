@extends('layouts.master')

@section('page-title', '系統管理|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">系統管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/admin.png') }}" alt="系統管理logo" width="60">系統管理</h1>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
              <div class="mr-5">帳號管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.account.index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-comments"></i>
              </div>
              <div class="mr-5">訊息管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.message.index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-dark o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">公告管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.post.index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-dark bg-white o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-book"></i>
              </div>
              <div class="mr-5">課程管理</div>
            </div>
            <a class="card-footer text-dark clearfix small z-1" href="{{ route('book.admin_index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-files-o"></i>
              </div>
              <div class="mr-5">作業管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.task.index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-sort-alpha-asc"></i>
              </div>
              <div class="mr-5">測驗管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.test.course_index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">打字管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('student_type.admin_index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">連結管理</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('link.admin_index') }}">
              <span class="float-left">前往設定</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection