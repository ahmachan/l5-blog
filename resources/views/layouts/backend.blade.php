<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 后台主题UI框架  - 主页</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="{{ asset('backend/favicon.ico') }}">
    <link href="{{ asset('backend/css/bootstrap.min.css?v=3.3.5') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/font-awesome.min.css?v=4.4.0') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.min.css?v=4.0.0') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="gray-bg">
@yield('content')
<script src="{{ asset('backend/js/jquery.min.js?v=2.1.4') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js?v=3.3.5') }}"></script>
@yield('script')
</body>
</html>