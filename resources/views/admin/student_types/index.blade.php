@extends('layouts.master')

@section('page-title', '學生打字|和東資訊教學網')

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
    <li class="breadcrumb-item active">打字管理</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/article.png') }}" alt="打字管理logo" width="60">打字管理</h1>
      <a href="{{ route('student_type.admin_show') }}" class="btn btn-info">各班打字</a>
      <h2><i class="fa fa-plus-circle"></i> 新增文章</h2>
      {{ Form::open(['route' => 'student_type.admin_store', 'method' => 'POST','id'=>'store','onsubmit'=>'return false']) }}
      <table class="table">
        <tr>
          <td class="text-right">
            <h5>*語言</h5>
          </td>
          <td>
            <input type="radio" name="language" id="cht" value="1" checked><label for="cht">中文</label>　　<input type="radio" name="language" id="eng" value="2"><label for="eng">英文</label>
          </td>
          <td>

          </td>
        </tr>
        <tr>
          <td class="text-right">
            <h5>*題目</h5>
          </td>
          <td>
            {{ Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => '請輸入標題','required'=>'required']) }}
          </td>
        </tr>
        <tr>
          <td class="text-right">
            <h5>*內文</h5>
          </td>
          <td>
            {{ Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control', 'placeholder' => '請輸入內文至少50字，否則會出錯！','required'=>'required']) }}
          </td>
        </tr>
      </table>
      <a href="#" class="btn btn-success" onclick="bbconfirm('store','確定送出？')">新增打字文章</a>
      {{ Form::close() }}
      <br><br>
      <h2><i class="fa fa-list-ul"></i> 文章列表</h2>
      <?php $i=1; ?>
      <table>
        <tr>
      @foreach($articles as $article)
            <td width="300"><a href="#" class="btn btn-info">({{ $i }}) {{ $article->title }}</a><font color=red>({{ $article->words }}字)</font> <a href="{{ route('student_type.admin_delete',$article->id) }}" id="delete" onclick="bbconfirm2('delete','真的要刪除？')"><img src="{{ asset('img/delete.png') }}"></a></td>
        @if($i%4 == 0)
        </tr><tr>
        @endif
          <?php $i++;?>
      @endforeach
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection