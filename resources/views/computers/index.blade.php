@extends('layouts.master')

@section('page-title', '我的小資資|和東資訊教學網')

@section('content')
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('index') }}">儀表統計</a>
    </li>
    <li class="breadcrumb-item active">我的小資資</li>
  </ol>
  <div class="row">
    <div class="col-12">
      <h1><img src="{{ asset('img/title/game.png') }}" alt="遊戲logo" width="60">小資資</h1>
    </div>
  </div>
  <table>
    <tr>
      <td width="400" valign="top">
        <table>
          <tr>
            <td rowspan="2">
              <a href="{{ url('computer/case') }}"><img src="{{ asset('img/computer/show/case-g.png') }}" width="128"></a>
            </td>
            <td>
              <a href="{{ url('computer/monitor') }}"><img src="{{ asset('img/computer/show/monitor-g.png') }}" width="128"></a>
            </td>
            <td colspan="2">
              <a href="{{ url('computer/speaker') }}"><img src="{{ asset('img/computer/show/speaker-g.png') }}" width="80"></a>
            </td>
          </tr>
          <tr>
            <td style="vertical-align:text-top;">
              <a href="{{ url('computer/keyboard') }}"><img src="{{ asset('img/computer/show/keyboard-g.png') }}" width="128"></a>
            </td>
            <td>
              <a href="{{ url('computer/mouse') }}"><img src="{{ asset('img/computer/show/mouse-g.png') }}" width="60"></a>
            </td>
            <td>
            </td>
          </tr>
        </table>
      </td>
      <td valign="top">
        <table>
          <tr>
            @if($thing == "show")
              <h2>請選購電腦配備</h2>
            @else
              <h2>{{ $com[$thing] }}@if($com[$thing]=="主機")機殼@endif</h2>
            @endif
          </tr>
          <tr>
            @if($thing != "show")
              @for ($i = 1; $i < 9; $i++)
                @if($i == 5)
                </tr><tr>
                @endif
                <td>
                  <img src="{{ asset('img/computer/'.$thing.'/0'.$i.'.png') }}" width="128">
                </td>
              @endfor
            @endif
          </tr>
        </table>
        @if($com[$thing]=="主機")
          <hr>
          <table>
            <tr>
              <h2>主機板</h2>
            </tr>
            <tr>
            @for ($i = 1; $i < 9; $i++)
              @if($i == 5)
                </tr><tr>
              @endif
              <td>
                <img src="{{ asset('img/computer/case/01mainboard/0'.$i.'.png') }}" width="128">
              </td>
            @endfor
            </tr>
          </table>
          <hr>
          <table>
            <tr>
              <h2>CPU 中央處理器</h2>
            </tr>
            <tr>
              @for ($i = 1; $i < 9; $i++)
                @if($i == 5)
            </tr><tr>
              @endif
              <td>
                <img src="{{ asset('img/computer/case/02CPU/0'.$i.'.png') }}" width="128">
              </td>
              @endfor
            </tr>
          </table>
          <hr>
          <table>
            <tr>
              <h2>RAM 記憶體</h2>
            </tr>
            <tr>
              @for ($i = 1; $i < 9; $i++)
                @if($i == 5)
            </tr><tr>
              @endif
              <td>
                <img src="{{ asset('img/computer/case/03RAM/0'.$i.'.png') }}" width="128">
              </td>
              @endfor
            </tr>
          </table>
          <hr>
          <table>
            <tr>
              <h2>硬碟機</h2>
            </tr>
            <tr>
              @for ($i = 1; $i < 9; $i++)
                @if($i == 5)
            </tr><tr>
              @endif
              <td>
                <img src="{{ asset('img/computer/case/04HD/0'.$i.'.png') }}" width="128">
              </td>
              @endfor
            </tr>
          </table>
          <hr>
          <table>
            <tr>
              <h2>光碟機 (選配)</h2>
            </tr>
            <tr>
              @for ($i = 1; $i < 5; $i++)
              <td>
                <img src="{{ asset('img/computer/case/05CDROM/0'.$i.'.png') }}" width="128">
              </td>
              @endfor
            </tr>
          </table>
        @endif
      </td>
    </tr>
  </table>

</div>
@endsection