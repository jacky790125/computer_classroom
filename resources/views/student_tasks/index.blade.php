@extends('layouts.master')

@section('page-title', '學生作業|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">學生作業</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/student_task.png') }}" alt="學生作業logo" width="60">學生作業</h1>
      @if(auth()->check())
        <table class="table table-hover">
        <thead>
        <tr>
          <th>
            時間
          </th>
          <th>
            標題
          </th>
          <th>
            說明
          </th>
          <th>
            類型
          </th>
          <th>
            繳交狀態
          </th>
          <th>
            公開
          </th>
          <th>
            <i class="fa fa-usd"></i> 得分
          </th>
          <th>
            <i class="fa fa-balance-scale"></i> 評語
          </th>
          <th>
            <i class="fa fa-heart"></i> 喜歡
          </th>
          <th>
            <i class="fa fa-eye"></i> 點閱
          </th>
        </tr>
        </thead>
        <tbody>
        @foreach($student_tasks as $student_task)
        <tr>
          <td>
            {{ $student_task->created_at }}
          </td>
          <td>
            {{ $student_task->task->title }}
          </td>
          <td>
            {{ $student_task->task->description }}
          </td>
          <td>
            {{ $student_task->task->type }}
          </td>
          <td>
            @if(empty($student_task->report))
              @if(str_replace("-",'',substr($student_task->created_at,0,10)) < date('Ymd') and !empty($student_task->created_at))
              <a href="#" class="btn btn-secondary disabled"><i class="fa fa-plus"></i> 逾時</a>
              @else
              <a href="{{ route('student_task.upload',$student_task->id) }}" class="btn btn-success"><i class="fa fa-plus"></i> 我要交作業</a>
              @endif
            @else
              <a href="{{ route('student_task.view',$student_task->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i> 我要看作業</a>
            @endif
          </td>
          <td>
            @if($student_task->public == 1)
            <img src="{{ asset('img/earth.png') }}">
            @elseif(empty($student_task->report))
            @else
            <img src="{{ asset('img/lock.png') }}">
            @endif
          </td>
          <td>
            {{ $student_task->score }}
          </td>
          <td>
            {{ $student_task->saying }}
          </td>
          <td>
            {{ $student_task->likes }}
            @if($student_task->likes > 0 and ($student_task->likes-$student_task->to_money/5)>0)
              <a href="{{ route('student_task.for_money',$student_task->id) }}" class="btn btn-warning">換$</a>
            @endif
          </td>
          <td>
            {{ $student_task->views }}
          </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        <nav class="text-center" aria-label="Page navigation">
          {{ $student_tasks->links('vendor.pagination.bootstrap-4') }}
        </nav>
      @else
        <div class="alert alert-danger" role="alert">
          <strong>學生上傳作業請先由上方登入！</strong>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection