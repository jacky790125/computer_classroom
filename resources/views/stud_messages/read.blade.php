@extends('layouts.master')

@section('page-title', '我的信件|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">我的件信</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
        <div class="card-header">
          <h2><i class="fa fa-folder-open"></i> 打開信件</h2>
        </div>
        <div class="card-body">
          <table class="table table-light">
            <thead>
            <th width="200">
              寄件者帳號：
            </th>
            <th>
              主題：
            </th>
            </thead>
            <tbody>
            <tr>
              <td>
                {{ $message['from'] }}({{ $message['username'] }})
              </td>
              <td>
                {{ $message['title'] }}
              </td>
            </tr>
            <tr>
              <td colspan="2">
                {{ $message['content'] }}
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <a href="{{ route('stud_message.close') }}" class="btn btn-info">關閉視窗</a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection