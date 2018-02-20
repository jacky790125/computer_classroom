@extends('layouts.master')

@section('page-title', '學生測驗|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('student_test.index') }}">學生測驗</a>
    </li>
    <li class="breadcrumb-item active">測驗分析</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/type.png') }}" alt="學生測驗logo" width="60">{{ $test_title }}</h1>
      <h4>得分：{{ $total_score }}分</h4>
      <table class="table table-hover">
        <thead>
        <tr>
          <th nowrap>
            序號
          </th>
          <th>
            你的答案
          </th>
          <th>
            題目
          </th>
          <th>
            正確答案A
          </th>
          <th>
            錯誤答案B
          </th>
          <th>
            錯誤答案C
          </th>
          <th>
            錯誤答案D
          </th>
        </tr>
        </thead>
        <tbody>
        <?php $num=1; ?>
        @foreach($question_array as $k=>$v)
            <?php
            $question = \App\CourseQuestion::where('id','=',$v)->first();
            ?>
        <tr>
          <td>
            @if($answer_array[$k] == "A")
              <img src="{{ asset('img/check.png') }}">
            @else
              <img src="{{ asset('img/no_check.png') }}">
            @endif
            {{ $num }}
          </td>
          <td>
            {{ $answer_array[$k] }}
          </td>
          <td>
            <h6>{{ $question->title }}</h6>
          </td>
          <td class="text-danger">
            {{ $question->ans_A }}
          </td>
          <td>
            {{ $question->ans_B }}
          </td>
          <td>
            {{ $question->ans_C }}
          </td>
          <td>
            {{ $question->ans_D }}
          </td>
        </tr>
          <?php $num++; ?>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection