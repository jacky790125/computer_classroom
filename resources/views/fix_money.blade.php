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
            <a class="nav-link" href="{{ route('view_stud_money2') }}">查詢學生</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('fix_money') }}">餘額修正</a>
          </li>
        @endif
      </ul>
      <h1><img src="{{ asset('img/title/money.png') }}" alt="收支狀況logo" width="60">餘額修正</h1>
      <a href="{{ route('fix_go') }}" class="btn btn-success" id="go" onclick="bbconfirm2('go','很花時間喔！')">開始修正</a>
      <br>
      <br>
      <table class="table table-hover">
        <tr>
          <td>
            班級座號
          </td>
          <td>
            學號
          </td>
          <td>
            姓名
          </td>
          <td>
            目前金額
          </td>
          <td>
            正確金額
          </td>
        </tr>
        @foreach($show_user as $k=>$v)
          <tr>
            <td>
              {{ $v['year_class_num'] }}
            </td>
            <td>
              {{ $v['username'] }}
            </td>
            <td>
              {{ $v['name'] }}
            </td>
            <td>
              {{ $v['user_money'] }}
            </td>
            <td>
              {{ $v['right_money'] }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection