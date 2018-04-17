@extends('layouts.master')

@section('page-title', '快問快答|和東資訊教學網')

@section('content')
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
    </div>
  </div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('quick_ask') }}">挑戰題庫</a>
          </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">題庫管理</a>
        </li>
    </ul>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-bar-chart"></i> 題庫
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                名稱
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::open(['route'=>'quick_ask_store','method'=>'post','id'=>'store','onsubmit'=>'return false;']) }}
                        <tr>
                            <td>

                            </td>
                            <td>
                                {{ Form::text('name',null,['id'=>'name','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
                            </td>
                            <td>
                                <a href="#" class="btn btn-success" onclick="bbconfirm('store','真的嗎？')">新增</a>
                            </td>
                        </tr>
                        {{ Form::close() }}
                        @foreach($ask_courses as $ask_course)
                        <tr>
                            <td>
                                {{ $ask_course->id }}
                            </td>
                            <td>
                                <a href="{{ url('quick_ask_select') }}/{{ $ask_course->id }}" class="btn btn-info">{{ $ask_course->name }} ({{ $ask_course->ask_questions->count() }})</a>
                            </td>
                            <td>
                                @if($ask_course->ask_questions->count() == 0)
                                <a href="{{ route('quick_course_delete',$ask_course->id) }}" class="btn btn-danger" id="del{{ $ask_course->id }}" onclick="bbconfirm2('del{{ $ask_course->id }}','刪除？')">刪除</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-bar-chart"></i> @if(!empty($select_ask_course)){{ $select_ask_course->name }} 題目 @else 請先選題庫 @endif
                </div>
                <div class="card-body">
                    @if(!empty($select_ask_course))
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th colspan="3"><h4>新增題目</h4></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::open(['route'=>'quick_question_store','method'=>'post','id'=>'store_question','files' => true,'onsubmit'=>'return false;']) }}
                        <tr>
                            <th>
                                題目：
                            </th>
                            <td>
                                {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入題目','required'=>'required']) }}
                            </td>
                            <td colspan="2">
                                題目參考圖片：<input type="file" name="file[title_img]">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-danger" nowrap width="120">
                                正確答案A：
                            </th>
                            <td>
                                {{ Form::text('ans_A',null,['id'=>'ans_A','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required']) }}
                            </td>
                            <td colspan="2">
                                答案A參考圖片：<input type="file" name="file[ans_A_img]">
                            </td>
                        </tr>
                        <tr>
                            <th nowrap width="120">
                                答案B：
                            </th>
                            <td>
                                {{ Form::text('ans_B',null,['id'=>'ans_B','class' => 'form-control', 'placeholder' => '請輸入答案B','required'=>'required']) }}
                            </td>
                            <td colspan="2">
                                答案B參考圖片：<input type="file" name="file[ans_B_img]">
                            </td>
                        </tr>
                        <tr>
                            <th nowrap width="120">
                                答案C：
                            </th>
                            <td>
                                {{ Form::text('ans_C',null,['id'=>'ans_C','class' => 'form-control', 'placeholder' => '請輸入答案C','required'=>'required']) }}
                            </td>
                            <td colspan="2">
                                答案C參考圖片：<input type="file" name="file[ans_C_img]">
                            </td>
                        </tr>
                        <tr>
                            <th nowrap width="120">
                                答案D：
                            </th>
                            <td>
                                {{ Form::text('ans_D',null,['id'=>'ans_D','class' => 'form-control', 'placeholder' => '請輸入答案D','required'=>'required']) }}
                            </td>
                            <td colspan="2">
                                答案D參考圖片：<input type="file" name="file[ans_D_img]">
                            </td>
                        </tr>
                        <input type="hidden" name="ask_course_id" value="{{ $select_ask_course->id }}">
                        {{ Form::close() }}
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-success" onclick="bbconfirm('store_question','確定新增？')"><i class="fa fa-plus"></i> 新增題目</a>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>序號</th>
                                    <th>題目</th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>動作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($ask_questions as $ask_question)
                                    <tr>
                                        <td>
                                            {{ $i }}
                                        </td>
                                        <td>
                                            {{ $ask_question->title }}
                                            @if(!empty($ask_question->title_img))
                                                <button onclick="openwindow('{{ route('quick_question_view_img',['img'=>'title_img','id'=>$ask_question->id]) }}')"><img src="{{ asset('img/p.png') }}"></button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ask_question->ans_A }}
                                            @if(!empty($ask_question->ans_A_img))
                                                <button onclick="openwindow('{{ route('quick_question_view_img',['img'=>'ans_A_img','id'=>$ask_question->id]) }}')"><img src="{{ asset('img/p.png') }}"></button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ask_question->ans_B }}
                                            @if(!empty($ask_question->ans_B_img))
                                                <button onclick="openwindow('{{ route('quick_question_view_img',['img'=>'ans_B_img','id'=>$ask_question->id]) }}')"><img src="{{ asset('img/p.png') }}"></button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ask_question->ans_C }}
                                            @if(!empty($ask_question->ans_C_img))
                                                <button onclick="openwindow('{{ route('quick_question_view_img',['img'=>'ans_C_img','id'=>$ask_question->id]) }}')"><img src="{{ asset('img/p.png') }}"></button>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $ask_question->ans_D }}
                                            @if(!empty($ask_question->ans_D_img))
                                                <button onclick="openwindow('{{ route('quick_question_view_img',['img'=>'ans_D_img','id'=>$ask_question->id]) }}')"><img src="{{ asset('img/p.png') }}"></button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('quick_question_delete',$ask_question->id) }}" id="del_q{{ $ask_question->id }}" class="btn btn-danger" onclick="bbconfirm2('del_q{{ $ask_question->id }}','刪除題目？')">刪除</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function openwindow(url_str){
        window.open (url_str,"視窗","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=500,Height=300");
    }

</script>
@endsection