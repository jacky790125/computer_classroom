@extends('layouts.master')

@section('page-title', '快問快答|和東資訊教學網')

@section('content')
  <style type="text/css">
    body {
      background-color: #eee;
    }
    .abgne-loading-20140104-2 {
      position: relative;
      height: 80px;
      width: 80px;
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
      top: -15px;
      left: 5px;
      color: #168;
      display: inline-block;
      text-align: center;
      font-size: 60px;
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
    <li class="breadcrumb-item active">快問快答</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">快問快答</h1>
      <h2>題庫：{{ $course->name }}</h2>
      <table>
        <tr>
          <td>
            <div class="abgne-loading-20140104-2">
              <div class="loading"></div>
              <div class="word" id="number">5</div>
            </div>
          </td>
          <td>
            @if(session('wrong') > 0)
              <img id="img1" src="{{ asset('img/red_light.png') }}" width="80">
            @else
              <img id="img1" src="{{ asset('img/green_light.png') }}" width="80">
            @endif
          </td>
          <td>
            @if(session('wrong') > 1)
              <img id="img1" src="{{ asset('img/red_light.png') }}" width="80">
            @else
              <img id="img1" src="{{ asset('img/green_light.png') }}" width="80">
            @endif
          </td>
          <td>
            @if(session('wrong') > 2)
              <img id="img1" src="{{ asset('img/red_light.png') }}" width="80">
            @else
              <img id="img1" src="{{ asset('img/green_light.png') }}" width="80">
            @endif
          </td>
        </tr>
      </table>
      <h2>題目：第 {{ session('n') }} 題</h2>
      <br>
      @if(session('a'. session('n')) == "right")
      <table>
        <tr>
          <td>
            <h1 class="text-danger">答對了！</h1>
          </td>
          <td>
            <img src="{{ asset('img/答對.gif') }}" height="200">
          </td>
        </tr>
      </table>
      <audio id="right" autoplay="autoplay">
        <source src="{{ asset('games/mp3/right.mp3') }}" type="audio/mp3">
      </audio>
      @endif
      @if(session('a'. session('n')) == "wrong")
        <table>
          <tr>
            <td>
              <h1 class="text-danger">答錯了！</h1>
            </td>
            <td>
              <img src="{{ asset('img/答錯.gif') }}" height="200">
            </td>
          </tr>
        </table>
        <audio id="wrong" autoplay="autoplay">
          <source src="{{ asset('games/mp3/wrong.mp3') }}" type="audio/mp3">
        </audio>
      @endif
      @if(session('n')==15)
        {{ Form::open(['route' => 'quick_ask_money', 'method' => 'POST']) }}
        <button class="btn btn-success">你過關了，登錄成績！</button>
        <input type="hidden" name="id" value="{{ $course->id }}">
        <input type="hidden" name="name" value="{{ $course->name }}">
        {{ Form::close() }}
      @else
        @if(session('wrong')==3)
          <a href="{{ route('quick_ask') }}" class="btn btn-danger">你挑戰失敗了！</a>
        @else
        <a href="{{ route('quick_ask_do',$course->id) }}" class="btn btn-primary">下一題</a>
        @endif
      @endif
    </div>
  </div>
</div>
<br>
@endsection