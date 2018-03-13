@extends('layouts.master')

@section('page-title', '資訊幣收支|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">檢視資訊幣收支</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/money.png') }}" alt="收支狀況logo" width="60">檢視資訊幣收支</h1>
      <h2>餘：{{ get_stud_total_money(auth()->user()->id) }} 元</h2>
      <table class="table table-hover">
        <thead>
        <tr>
          <th>
            時間
          </th>
          <th>
            事由
          </th>
          <th>
            收支
          </th>
        </tr>
        </thead>
        <tbody>
        @foreach($stud_moneys as $stud_money)
            <?php
            if($stud_money->stud_money > 0){
                $icon = "+";
                $color = "text-success";
            }else{
                $icon = "-";
                $color = "text-danger";
            }
            ?>
        <tr>
          <td>
            {{ $stud_money->created_at }}
          </td>
          <td>
            {{ $stud_money->description }}
          </td>
          <td>
            <p class="{{ $color }}">{{ $icon }}{{ $stud_money->stud_money }}</p>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
      <nav class="nav-item" aria-label="Page navigation">
        {{ $stud_moneys->links('vendor.pagination.bootstrap-4') }}
      </nav>
    </div>
  </div>
</div>
@endsection