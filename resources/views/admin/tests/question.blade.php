@extends('layouts.master')

@section('page-title', '帳號管理|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.index') }}">系統管理</a>
    </li>
    <li class="breadcrumb-item active">測驗管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/test.png') }}" alt="測驗管理logo" width="60">測驗管理</h1>
    </div>
    </div>

  <div class="row">
    <div class="col-12">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.test.course_index') }}">課程管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.test.question') }}">題庫管理</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">試卷管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">分數管理</a>
          </li>
      </ul>
    </div>
  </div>
    <br>
  <div class="row">
      <div class="col-12">
          <div class="card mb-3">
              <div class="card-header">
                  題庫
              </div>
              <div class="card-body">
                  {{ Form::open(['route' => 'admin.test.question', 'method' => 'GET']) }}
                  {{ Form::select('course_id', $course_menu, $course_id, ['id' => 'course_id','placeholder'=>'請選擇','class' => 'form-control','onchange'=>'if(this.value != 0) { this.form.submit(); }']) }}
                  {{ Form::close() }}
                  @if(!empty($course_id))
                  <table class="table table-hover">
                      <thead>
                      <tr>
                          <th colspan="2"><h4>列出題目</h4></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      @foreach($questions as $question)
                          {{ Form::open(['route'=>['admin.test.question_update',$question->id],'method'=>'post','id'=>'update_question'.$question->id,'files' => true,'onsubmit'=>'return false;']) }}
                      <tr>
                          <th>({{ $i }}).題目</th>
                          <td>
                              {{ Form::text('title',$question->title,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入題目','required'=>'required']) }}
                          </td>
                          <td>
                              @if(!empty($question->title_img))
                                  <a href="#" onclick="openwindow('{{ route('admin.test.question_view_img',['img'=>'title_img','id'=>$question->id]) }}')"><img src="{{ asset('img/p.png') }}"></a> <a href="{{ route('admin.test.question_delete_img',['img'=>'title_img','id'=>$question->id]) }}" id="del_title_img{{ $question->id }}" onclick="bbconfirm2('del_title_img{{ $question->id }}','要刪除照片？')"><img src="{{ asset('img/p_del.png') }}"></a>
                              @endif
                              <input type="file" name="file[title_img]">
                          </td>
                      </tr>
                      <tr>
                          <th rowspan="4">答案</th>
                          <td class="text-danger">
                              {{ Form::text('ans_A',$question->ans_A,['id'=>'ans_A','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required','style'=>'color:red']) }}
                          </td>
                          <td>
                              @if(!empty($question->ans_A_img))
                                  <a href="#" onclick="openwindow('{{ route('admin.test.question_view_img',['img'=>'ans_A_img','id'=>$question->id]) }}')"><img src="{{ asset('img/p.png') }}"></a> <a href="{{ route('admin.test.question_delete_img',['img'=>'ans_A_img','id'=>$question->id]) }}" id="del_ans_A_img{{ $question->id }}" onclick="bbconfirm2('del_ans_A_img{{ $question->id }}','要刪除照片？')"><img src="{{ asset('img/p_del.png') }}"></a>
                              @endif
                              <input type="file" name="file[ans_A_img]">
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{ Form::text('ans_B',$question->ans_B,['id'=>'ans_B','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required']) }}
                          </td>
                          <td>
                              @if(!empty($question->ans_B_img))
                                  <a href="#" onclick="openwindow('{{ route('admin.test.question_view_img',['img'=>'ans_B_img','id'=>$question->id]) }}')"><img src="{{ asset('img/p.png') }}"></a> <a href="{{ route('admin.test.question_delete_img',['img'=>'ans_B_img','id'=>$question->id]) }}" id="del_ans_B_img{{ $question->id }}" onclick="bbconfirm2('del_ans_B_img{{ $question->id }}','要刪除照片？')"><img src="{{ asset('img/p_del.png') }}"></a>
                              @endif
                              <input type="file" name="file[ans_B_img]">
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{ Form::text('ans_C',$question->ans_C,['id'=>'ans_C','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required']) }}
                          </td>
                          <td>
                              @if(!empty($question->ans_C_img))
                                  <a href="#" onclick="openwindow('{{ route('admin.test.question_view_img',['img'=>'ans_C_img','id'=>$question->id]) }}')"><img src="{{ asset('img/p.png') }}"></a> <a href="{{ route('admin.test.question_delete_img',['img'=>'ans_C_img','id'=>$question->id]) }}" id="del_ans_C_img{{ $question->id }}" onclick="bbconfirm2('del_ans_C_img{{ $question->id }}','要刪除照片？')"><img src="{{ asset('img/p_del.png') }}"></a>
                              @endif
                              <input type="file" name="file[ans_C_img]">
                          </td>
                      </tr>
                      <tr>
                          <td>
                              {{ Form::text('ans_D',$question->ans_D,['id'=>'ans_D','class' => 'form-control', 'placeholder' => '請輸入正確答案A','required'=>'required']) }}
                          </td>
                          <td>
                              @if(!empty($question->ans_D_img))
                                  <a href="#" onclick="openwindow('{{ route('admin.test.question_view_img',['img'=>'ans_D_img','id'=>$question->id]) }}')"><img src="{{ asset('img/p.png') }}"></a> <a href="{{ route('admin.test.question_delete_img',['img'=>'ans_D_img','id'=>$question->id]) }}" id="del_ans_D_img{{ $question->id }}" onclick="bbconfirm2('del_ans_D_img{{ $question->id }}','要刪除照片？')"><img src="{{ asset('img/p_del.png') }}"></a>
                              @endif
                              <input type="file" name="file[ans_D_img]">
                          </td>
                      </tr>
                      <tr>
                      <td colspan="3"><a href="#" class="btn btn-info" onclick="bbconfirm('update_question{{ $question->id }}','確定修改？')"><i class="fa fa-edit"> 題目({{ $i }})儲存修改</i></a></td>
                      </tr>
                          {{ Form::close() }}
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