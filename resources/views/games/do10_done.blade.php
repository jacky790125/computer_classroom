@extends('layouts.master')

@section('page-title', '十賭九輸|和東資訊教學網')

@section('content')
  <style type="text/css">
    body {
      background-color: #eee;
    }
    .abgne-loading-20140104-2 {
      position: relative;
      height: 400px;
      width: 400px;
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
      top: 130px;
      left: 80px;
      color: #168;
      display: inline-block;
      text-align: center;
      font-size: 350px;
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
  <?php
    $number = rand(0,9);
    ?>
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-reorder"></i> 開獎：你猜的是「{{ $set_number }}」，下注「{{ $set_money }} 資訊幣」
        </div>
        <div class="card-body">
          @if($number == $set_number)
            <h1 class="text-danger">你猜對了！！！ 獲得 「{{ $set_money*10 }} 資訊幣」 <img src="{{ asset('img/good.png') }}" width="160"></h1>
          @else
            <h1 class="text-danger">你輸了！！！ 「{{ $set_money }} 資訊幣」 沒收 <img src="{{ asset('img/10.png') }}" width="160"></h1>
          @endif
          <table>
            <tr>
              <td>
                <div class="abgne-loading-20140104-2">
                  <div class="loading"></div>
                  <div class="word" id="number">{{ $number }}</div>
                </div>
              </td>
              <td>
                @if($number == $set_number)
                  <img src="{{ asset('img/good.gif') }}" width="300">
                @else
                  <img src="{{ asset('img/seeyou.jpeg') }}" width="300">
                @endif
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection