@extends('layouts.master')

@section('page-title', '資訊幣收支|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">檢視資訊幣收支</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('view_stud_money') }}">個人記錄</a>
        </li>
        @if(auth()->user()->group_id == "1")
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('view_stud_money2') }}">查詢學生</a>
          </li>
        @endif
      </ul>
      <h1><img src="{{ asset('img/title/money.png') }}" alt="收支狀況logo" width="60">檢視資訊幣收支</h1>
      <table class="table table-light">
        <tr>
          {{ Form::open(['route' => 'view_stud_money2', 'method' => 'POST','id'=>'search']) }}
          <td width="200">
            {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '名稱','required'=>'required']) }}
          </td>
          <td width="100">
            <input type="radio" name="type" value="nickname" checked>暱稱
          </td>
          <td width="100">
            <input type="radio" name="type" value="username">帳號
          </td>
          <td>
            <a href="#" class="btn btn-success" onclick="bbconfirm('search','確定？')">送出</a>
          </td>
          {{ Form::close() }}
        </tr>
      </table>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>
            班級座號
          </th>
          <th>
            姓名
          </th>
          <th>
            時間
          </th>
          <th>
            事由
          </th>
          <th>
            收支
          </th>
        </tr>
        </thead>
        <tbody>
        <?php $total=0; ?>
        @foreach($stud_moneys as $stud_money)
            <?php
            if($stud_money->stud_money > 0){
                $icon = "+";
                $color = "text-success";
            }else{
                $icon = "-";
                $color = "text-danger";
            }
            ?>
        <tr>
          <td>
            {{ $stud_money->user->year_class_num }}
          </td>
          <td>
            {{ $stud_money->user->name }}
          </td>
          <td>
            {{ $stud_money->created_at }}
          </td>
          <td>
            {{ $stud_money->description }}
          </td>
          <td>
            <p class="{{ $color }}">{{ $icon }}{{ $stud_money->stud_money }}</p>
          </td>
          <?php $total += $stud_money->stud_money; ?>
        </tr>
        @endforeach
        <tr>
          <td>

          </td>
          <td>

          </td>
          <td>

          </td>
          <td>

          </td>
          <td>
            <h2>{{ $total }}</h2>
          </td>
        </tr>
        </tbody>
      </table>
      <br>
      <br>
    </div>
  </div>
</div>
@endsection