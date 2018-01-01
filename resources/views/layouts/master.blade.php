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
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->

@include('layouts.nav')
<div class="content-wrapper">
@yield('content')
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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
    @include('layouts.under_js')
</div>
</body>
</html>