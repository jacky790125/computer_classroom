@extends('layouts.master')

@section('page-title', '好站連結|和東資訊教學網')

@section('content')
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('index') }}">儀表統計</a>
      </li>
      <li class="breadcrumb-item active">好站連結</li>
    </ol>
    <div class="row">
      <div class="col-12">
        <h1><img src="{{ asset('img/title/link.png') }}" alt="公告系統logo" width="60">好站連結</h1>
        <table class="table table-hover">
          <thead>
          <tr>
            <th>
              id
            </th>
            <th>
              名稱
            </th>
            <th>
              說明
            </th>
            <th>
              連結
            </th>
          </tr>
          </thead>
          <tbody>
          <?php $i =1; ?>
          @foreach($links as $link)
            <tr>
              <td>
                {{ $i }}
              </td>
              <td>
                {{ $link->title }}
              </td>
              <td>
                {{ $link->description }}
              </td>
              <td>
                <a href="{{ $link->link }}" target="_blank" class="btn btn-info">立即前往</a>
              </td>
            </tr>
            <?php $i++; ?>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection