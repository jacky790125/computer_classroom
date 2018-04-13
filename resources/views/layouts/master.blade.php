<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="{{ asset('sb_admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <title>@yield('page-title')</title>
    @include('layouts.head_css')

    <style type="text/css">
        body {
            cursor: url('{{ asset('cursor/02/left_ptr.cur') }}'), default;
        }
        a{
            cursor: url('{{ asset('cursor/02/pointer.cur') }}'), default;
        }

        input[type="text"],textarea{
            cursor: url('{{ asset('cursor/02/xterm.cur') }}'), default;
        }
        input[type="radio"],input[type="checkbox"]{
            cursor: url('{{ asset('cursor/02/center_ptr.cur') }}'), default;
        }
        select{
            cursor: url('{{ asset('cursor/02/plus.cur') }}'),default;
        }

    </style>
</head>
@if(auth()->check())
    @if(auth()->user()->group_id == "1")
        <body>
    @else
        <body class="fixed-nav sticky-footer bg-dark" id="page-top" onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
    @endif
@else
    <body class="fixed-nav sticky-footer bg-dark" id="page-top" onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
@endif

@include('layouts.nav')
<div class="content-wrapper">
@yield('content')
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <br>
    <br>
    <br>
    <br>
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © 彰化縣和東國小資訊教學網 2017 Power By Laravel 5.5</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    @include('layouts.bootbox')
    @include('layouts.under_js')
</div>

</body>
</html>