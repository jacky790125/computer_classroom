@extends('layouts.master2')

@section('page-title', '學生測驗|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1 class="text-center">{{ $test->title }}</h1>
      <h4 class="text-right">每題： {{ $test->score }} 分</h4>
      <h2><i class="fa fa-list-ul"></i> 選擇題</h2>
      @for($i=1;$i<=$num;$i++)
      <div class="card mb-3">
        <div class="card-header">
          <h2>第 ({{ $i }}) 題</h2>
        </div>
        <div class="card-body">
          <?php
            $q = explode('-',session('q'.$i));
          ?>
          <h3>{{ $question_data[$q[1]]['title'] }}</h3>
          <table class="table table-hover">
            <tr>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="q[{{ $q[1] }}]" id="optionsRadios1" value="{{ substr($question_data[$q[1]]['ans_1'],0,1) }}">
                    (1){{ substr($question_data[$q[1]]['ans_1'],2) }}
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="q[{{ $q[1] }}]" id="optionsRadios2" value="{{ substr($question_data[$q[1]]['ans_1'],0,1) }}">
                    (2){{ substr($question_data[$q[1]]['ans_2'],2) }}
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="q[{{ $q[1] }}]" id="optionsRadios3" value="{{ substr($question_data[$q[1]]['ans_1'],0,1) }}">
                    (3){{ substr($question_data[$q[1]]['ans_3'],2) }}
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="radio">
                  <label>
                    <input type="radio" name="q[{{ $q[1] }}]" id="optionsRadios4" value="{{ substr($question_data[$q[1]]['ans_1'],0,1) }}">
                    (4){{ substr($question_data[$q[1]]['ans_4'],2) }}
                  </label>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
      @endfor
    </div>
  </div>
</div>
@endsection