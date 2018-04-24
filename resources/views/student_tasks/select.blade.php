@extends('layouts.master')

@section('page-title', '作品欣賞|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">作品欣賞</li>
  </ol>
  <div class="row">
    <div class="col-12">
    <h1><img src="{{ asset('img/title/open.png') }}" alt="學生作業logo" width="60">作品欣賞</h1>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-reorder"></i> 選擇學生作品集
        </div>
        <div class="card-body">
            <select name="task_id" id="select1" class="form-control" onchange="if(this.value != 0) { window.location=''; }">
              <option value="">請選擇</option>
              @foreach($tasks as $k=>$v)
              <option value="{{ $k }}/open">{{ $v }}</option>
              @endforeach
            </select>
          <script>
              $(function(){
                  // bind change event to select
                  $('#select1').on('change', function () {
                      var url = $(this).val(); // get selected value
                      if (url) { // require a URL
                          window.location = url; // redirect
                      }
                      return false;
                  });
              });
          </script>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection