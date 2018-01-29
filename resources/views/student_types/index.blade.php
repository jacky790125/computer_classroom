@extends('layouts.master')

@section('page-title', '學生打字|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">學生打字</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/type.png') }}" alt="公告系統logo" width="60">學生打字</h1>
      <p><a href="#" onclick="openwindow('{{ route('student_type.typing') }}')">This is an example of a blank page that you can use as a starting point for creating new ones.</a></p>
    </div>
  </div>
</div>
<script>
    function openwindow(url_str){
        window.open (url_str,"學生打字","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=990,Height=800");
    }

</script>
@endsection