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
      <h2><i class="fa fa-list-ul"></i> 文章列表</h2>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>注意！</strong> 打字時間不足60秒，不予計分！
      </div>
        <?php $i=1; ?>
      <table>
        <tr>
          @foreach($articles as $article)
            <td width="300"><a href="#" class="btn btn-info" onclick="openwindow('{{ route('student_type.typing',$article->id) }}')">({{ $i }}) {{ $article->title }}</a><font color=red>({{ $article->words }}字)</font></td>
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
<script>
    function openwindow(url_str){
        window.open (url_str,"學生打字","menubar=0,status=0,directories=0,location=0,top=20,left=20,toolbar=0,scrollbars=1,resizable=1,Width=990,Height=800");
    }

</script>
@endsection