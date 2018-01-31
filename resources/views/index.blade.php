@extends('layouts.master')

@section('page-title', '首頁|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">儀表統計</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/dashboard.png') }}" alt="儀表統計logo" width="60">儀表統計</h1>
    </div>
  </div>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-area-chart"></i> 作業按讚排行
    </div>
    <div class="card-body">
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <!-- Example Bar Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bar-chart"></i> 存款排行</div>
        <div class="card-body">

        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <!-- Example Pie Chart Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pie-chart"></i> 打字排行
        </div>
        <div class="card-body">
          <canvas id="myPieChart" width="100%" height="100"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection