@extends('layouts.master')

@section('page-title', '十賭九輸|和東資訊教學網')

@section('content')
  <style type="text/css">
    body {
      background-color: #eee;
    }
    .abgne-loading-20140104-2 {
      position: relative;
      height: 100px;
      width: 100px;
    }
    .loading {
      border: 6px solid #168;
      border-right: 6px solid #fff;
      border-bottom: 6px solid #fff;
      border-radius: 100%;
      height: 100%;
      width: 100%;
      -webkit-animation: loading 1s infinite linear;
      -moz-animation: loading 1s infinite linear;
      -ms-animation: loading 1s infinite linear;
      -o-animation: loading 1s infinite linear;
      animation: loading 1s infinite linear;
    }
    .word {
      position: absolute;
      top: 0;
      left: 0;
      color: #168;
      display: inline-block;
      text-align: center;
      font-size: 72px;
      line-height: 72px;
      font-family: 微軟正黑體, arial;
      margin: 18px 0 0 20px;
      padding: 0;
    }
    @-webkit-keyframes loading {
      from {
        -webkit-transform: rotate(0deg);
      }
      to {
        -webkit-transform: rotate(360deg);
      }
    }
    @-moz-keyframes loading {
      from {
        -moz-transform: rotate(0deg);
      }
      to {
        -moz-transform: rotate(360deg);
      }
    }
    @-o-keyframes loading {
      from {
        -o-transform: rotate(0deg);
      }
      to {
        -o-transform: rotate(360deg);
      }
    }
    @keyframes loading {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }
  </style>
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">十賭九輸</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">十賭九輸</h1>
    </div>
  </div>
  @if(auth()->check())
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-reorder"></i> 猜一猜，0~9，下注後，猜中得十倍獎金！
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <td width="150">

              </td>
              <td width="200" nowrap>
                <h4>選一個幸運數字</h4>
              </td>
              <td nowrap>
                <h4>下注</h4>
              </td>
              <td nowrap>
                <h4>開始</h4>
              </td>
            </tr>
            {{ Form::open(['route' => 'do10_done', 'method' => 'POST','name'=>'form1','id'=>'do10','onsubmit'=>'return false;']) }}
            <tr>
              <td>
                <div class="abgne-loading-20140104-2">
                  <div class="loading"></div>
                  <div class="word" id="number">猜</div>
                </div>
              </td>
              <td>
                  <?php
                  $set_number_menu = [
                      "0"=>"0",
                      "1"=>"1",
                      "2"=>"2",
                      "3"=>"3",
                      "4"=>"4",
                      "5"=>"5",
                      "6"=>"6",
                      "7"=>"7",
                      "8"=>"8",
                      "9"=>"9",
                  ];
                  ?>
                {{ Form::select('set_number', $set_number_menu, null, ['id' => 'set_number', 'class' => 'form-control','placeholder'=>"選一個"]) }}
              </td>
              <td width="150">
                <?php
                  $set_money_menu = [
                      "1"=>"1 資訊幣",
                      "2"=>"2 資訊幣",
                      "3"=>"3 資訊幣",
                      "4"=>"4 資訊幣",
                      "5"=>"5 資訊幣",
                      "10"=>"10 資訊幣",
                      "20"=>"20 資訊幣",
                      "50"=>"50 資訊幣",
                      "100"=>"100 資訊幣",
                      "200"=>"200 資訊幣",
                  ];
                  ?>
                {{ Form::select('set_money', $set_money_menu, null, ['id' => 'set_money', 'class' => 'form-control']) }}
              </td>
              <td>
                <a href="#" class="btn btn-success" onclick="bbconfirm('do10','真的要試運氣？')"><img src="{{ asset('img/dice.png') }}" width="80"></a>
              </td>
            </tr>
            {{ Form::close() }}
          </table>
        </div>
      </div>
      <a href="https://www.moedict.tw/%E5%8D%81%E8%B3%AD%E4%B9%9D%E8%BC%B8" target="_blank"><img src="{{ asset('img/do102.png') }}"></a>
    </div>
  </div>
  @else
    <div class="alert alert-danger" role="alert">
      <strong>學生兌換遊戲請先由上方登入！</strong>
    </div>
  @endif
</div>
@endsection