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

<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<!-- Navigation-->
<div class="content-wrapper">
@yield('content')
@include('layouts.bootbox')
@include('layouts.under_js')
</div>

</body>
</html>