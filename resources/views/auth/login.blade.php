<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 登录</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="{{ asset('backend/favicon.ico') }}">
    <link href="{{ asset('backend/css/bootstrap.min.css?v=3.3.5') }}" rel="stylesheet">
{{--    <link href="{{ asset('backend/css/font-awesome.min.css?v=4.4.0') }}" rel="stylesheet">--}}

{{--    <link href="{{ asset('backend/css/animate.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('backend/css/style.min.css?v=4.0.0') }}" rel="stylesheet">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">H+</h1>

        </div>
        <ul class="list-group">
            {{-- 这个代码是额外的，主要是为了看验证失败的时候的报错信息，laravel会将错误信息写到$errors里面去，所以能够在页面获取来看 --}}
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{$error}}</li>
            @endforeach
        </ul>
        <form class="m-t" role="form" method="post" action="{{ url('/login') }}">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="用户名" required="">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="密码" required="">
            </div>

            <div class="row form-group">
                <div class="col-md-6"><input type="text" class="form-control" placeholder="验证码" name="captcha" required /></div>
                <div class="col-md-4"><img src="{{ captcha_src() }}" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}'+Math.random()"></div>
            </div>
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
            {{--<p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>--}}
            </p>

        </form>
    </div>
</div>
{{--<script src="{{ asset('backend/js/jquery.min.js?v=2.1.4') }}"></script>--}}
{{--<script src="{{ asset('backend/js/bootstrap.min.js?v=3.3.5') }}"></script>--}}
</body>

</html>