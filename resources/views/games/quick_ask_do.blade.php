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
      <?php
            if(empty(session('n'))){
                session(['n' => 1]);
            }else{
                if(session('n') < 15 and session('a'. session('n')) != null){
                    session(['n' => session('n')+1]);
                }
            }

            if(empty(session('begin'.session('n')))){
                session(['begin'.session('n')=>'1']);
            }
        $num = session('n');

        ?>
      <br>
      <button class="btn btn-info" id="button1" onclick="BackSec('number')">題目 {{ $num }} 準備好了，開始挑戰！</button>
      <div id="question" style="display: none;">
        <h2>( {{ $num }} )：{{ $question_data[session('q'.$num)]['title'] }}</h2>
        <div id="answer">
          <h2>答案：</h2>
          <div>
            {{ Form::open(['route' => 'quick_ask_answer','id'=>'form1', 'method' => 'POST']) }}
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="answer" value="{{ substr($question_data[session('q'.$num)]['ans_1'],0,1) }}">
            <input type="hidden" name="num" value="{{ $num }}">
            <button class="btn btn-success"><h3>{{ $question_data[session('q'.$num)]['ans_1'] }}</h3></button>
            {{ Form::close() }}
          </div>
          <br><br>
          <div>
            {{ Form::open(['route' => 'quick_ask_answer','id'=>'form2', 'method' => 'POST']) }}
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="answer" value="{{ substr($question_data[session('q'.$num)]['ans_2'],0,1) }}">
            <input type="hidden" name="num" value="{{ $num }}">
            <button class="btn btn-success"><h3>{{ $question_data[session('q'.$num)]['ans_2'] }}</h3></button>
            {{ Form::close() }}
          </div>
          <br><br>
          <div>
            {{ Form::open(['route' => 'quick_ask_answer','id'=>'form4', 'method' => 'POST']) }}
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="answer" value="{{ substr($question_data[session('q'.$num)]['ans_3'],0,1) }}">
            <input type="hidden" name="num" value="{{ $num }}">
            <button class="btn btn-success"><h3>{{ $question_data[session('q'.$num)]['ans_3'] }}</h3></button>
            {{ Form::close() }}
          </div>
          <br><br>
          <div>
            {{ Form::open(['route' => 'quick_ask_answer','id'=>'form4', 'method' => 'POST']) }}
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="hidden" name="answer" value="{{ substr($question_data[session('q'.$num)]['ans_4'],0,1) }}">
            <input type="hidden" name="num" value="{{ $num }}">
            <button class="btn btn-success"><h3>{{ $question_data[session('q'.$num)]['ans_4'] }}</h3></button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
  <audio id="bgMusic">
    <source src="{{ asset('games/mp3/543210.mp3') }}" type="audio/mp3">
  </audio>
<script type='text/javascript'>
    var time=5000;//設定倒數3秒
    function BackSec(objid){
        document.getElementById('bgMusic').play();
        document.getElementById('button1').style.display = 'none';
        document.getElementById('question').style.display = 'block';
        if(time>-1) {
            document.getElementById(objid).innerHTML = (time / 1000);
            setTimeout("BackSec('" + objid + "')", 1000);
        }else{
            document.getElementById('answer').style.display = 'none';
            document.getElementById('next').style.display = 'block';
        }
        time-=1000;
    }
</script>
@endsection