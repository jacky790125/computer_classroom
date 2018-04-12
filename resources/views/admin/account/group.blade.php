@extends('layouts.master')

@section('page-title', '群組管理|和東資訊教學網')

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
            <li class="breadcrumb-item">
                <a href="{{ route('admin.account.index') }}">帳號管理</a>
            </li>
            <li class="breadcrumb-item active">群組管理</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1><img src="{{ asset('img/title/group.png') }}" alt="群組管理logo" width="60">群組管理</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.account.index') }}">帳號管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.account.group') }}">群組管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.search') }}">查user_id</a>
                    </li>
                </ul>
                <table class="table table-light">
                    <tr>
                        <th>
                            id
                        </th>
                        <th>
                            名稱
                        </th>
                        <th>
                            啟用
                        </th>
                        <th>
                            動作
                        </th>
                    </tr>
                    <tr>
                        {{ Form::open(['route'=>'admin.group.store', 'method' => 'POST','id'=>'store_group','onsubmit'=>'return false;']) }}
                        <td>
                        </td>
                        <td>
                            {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '群組名稱','required'=>'required']) }}
                        </td>
                        <td>
                            <input type="radio" name="active" value="1" checked>啟用 <input type="radio" name="active" value="0">停用
                        </td>
                        <td>
                            <a href="#" class="btn btn-success" onclick="bbconfirm('store_group','你確定要新增群組嗎？')"><i class="fa fa-plus-circle"></i> 新增群組</a>
                        </td>
                        {{ Form::close() }}
                    </tr>
                </table>
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
                                啟用
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            {{ Form::open(['route'=>['admin.group.update',$group->id], 'method' => 'PATCH','id'=>'update_group'.$group->id]) }}
                            <td>
                                {{ $group->id }}
                            </td>
                            <td>
                                @if($group->id == 1 or $group->id == 2)
                                    {{ $group->name }}
                                @else
                                    {{ Form::text('name', $group->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '群組名稱','required'=>'required']) }}
                                @endif
                            </td>
                            <td>
                                <?php
                                if($group->active == 1){
                                    $check1 = "checked";
                                    $check2 ="";
                                }elseif($group->active == 0){
                                    $check1 = "";
                                    $check2 = "checked";
                                }
                                ?>
                                @if($group->id == 1 or $group->id == 2)
                                    啟用
                                @else
                                    <input type="radio" name="active" value="1" {{ $check1 }}>啟用 <input type="radio" name="active" value="0" {{ $check2 }}>停用
                                @endif
                            </td>
                            <td>
                                @if($group->id > 2)
                                    <a href="#" class="btn btn-info" onclick="bbconfirm('update_group{{ $group->id }}','你確定要修改這個群組嗎？')"><i class="fa fa-floppy-o"></i> 儲存修改</a>
                                @endif
                            </td>
                            {{ Form::close() }}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection