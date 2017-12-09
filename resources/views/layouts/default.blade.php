<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="{{ $system->site_description }}">
    <meta name="keywords" content="{{ $system->site_keywords }}">
    <meta name="author" content="HeyCommunity Team">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $system->site_title . ' - ' . $system->site_subheading)</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('bower-assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/toolkit.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-application-theme/css/application.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-application-theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
    </style>
</head>

<body class="with-top-navbar">

<!-- Nav -->
<nav id="section-mainNav" class="navbar navbar-expand-md fixed-top navbar-dark bg-primary app-navbar">
    <a class="navbar-brand" href="{{ url('/') }}">{{ $system->site_title }}</a>

    <button
            class="navbar-toggler navbar-toggler-right d-md-none"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ setNavActive('/') }}" href="{{ url('/') }}">首页</a>
            </li>
            <li class="nav-item {{ setNavActive('topic*') }}">
                <a class="nav-link" href="{{ route('topic.index') }}">话题</a>
            </li>
            <!--
            <li class="nav-item {{ setNavActive('activity*') }}">
                <a class="nav-link" href="{{ url('activity') }}">活动</a>
            </li>
            -->

            @if (Auth::check())
                <li class="nav-item d-block d-md-none {{ setNavActive('*ucenter*') }}">
                    <a class="nav-link" href="{{ route('user.ucenter') }}">用户中心</a>
                </li>
                <li class="nav-item d-block d-md-none">
                    <a class="nav-link" href="{{ route('user.logout') }}">登出</a>
                </li>
            @else
                <li class="nav-item d-block d-md-none {{ setNavActive('*login*') }}">
                    <a class="nav-link" href="{{ route('user.login') }}">登录</a>
                </li>
            @endif
        </ul>

        <form class="form-inline float-right d-none d-md-flex">
            <input class="form-control" type="text" data-action="grow" placeholder="搜索暂不可用" disabled>
        </form>

        <ul id="#js-popoverContent" class="nav navbar-nav float-right mr-0 d-none d-md-flex">
            <li class="nav-item">
                <a class="app-notifications nav-link" href="{{ route('notification.index') }}">
                    <span class="icon icon-bell"></span>
                </a>
            </li>
            <li class="nav-item ml-2">
                <button class="btn btn-default navbar-btn navbar-btn-avatar" data-toggle="popover">
                    @if (Auth::check())
                        <img class="rounded-circle" src="{{ asset(Auth::user()->avatar) }}">
                    @else
                        <img class="rounded-circle" src="{{ asset(\App\User::guestAvatar()) }}">
                    @endif
                </button>
            </li>
        </ul>

        <ul class="nav navbar-nav d-none" id="js-popoverContent">
            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.ucenter') }}">
                        <i class="fa fa-id-card-o"></i> &nbsp; 用户中心
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}">
                        <i class="fa fa-sign-out"></i> &nbsp; 登出
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.login') }}">
                        <i class="fa fa-sign-in"></i> &nbsp; 登入
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>


<!-- Flash Message -->
@include('flash::message')

<!-- Main Body -->
@yield('mainBody')


<script src="{{ asset('assets/bootstrap-application-theme/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/chart.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/toolkit.js') }}"></script>
<script src="{{ asset('assets/bootstrap-application-theme/js/application.js') }}"></script>
<script>
    // execute/clear BS loaders for docs
    $(function () {
        while (window.BS && window.BS.loader && window.BS.loader.length) {
            (window.BS.loader.pop())()
        }
    })
</script>

<!-- Analytic code -->
{!! $system->site_analyti_code !!}
</body>
</html>
