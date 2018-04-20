@extends('layouts.master')

@section('page-title', '錯誤|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">錯誤頁面</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/error.png') }}" alt="儀表統計logo" width="60">有東西錯了</h1>
      <h1 class="text-danger">{!! $words !!} </h1>
    </div>
  </div>
</div>
@endsection