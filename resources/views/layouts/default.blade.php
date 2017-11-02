<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>HeyCommunity V4</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="/assets/bootstrap-application-theme/css/toolkit.css" rel="stylesheet">
    <link href="/assets/bootstrap-application-theme/css/application.css" rel="stylesheet">

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
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary app-navbar">
    <a class="navbar-brand">
        HeyCommunity
    </a>

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
                <a class="nav-link" href="{{ url('/') }}">首页</a>
            </li>
            <li class="nav-item {{ setItemActive('activity*') }}">
                <a class="nav-link" href="{{ url('activity') }}">活动</a>
            </li>
        </ul>

        <form class="form-inline float-right d-none d-md-flex">
            <input class="form-control" type="text" data-action="grow" placeholder="搜索">
        </form>

        <ul id="#js-popoverContent" class="nav navbar-nav float-right mr-0 d-none d-md-flex">
            <li class="nav-item">
                <a class="app-notifications nav-link">
                    <span class="icon icon-bell"></span>
                </a>
            </li>
            <li class="nav-item ml-2">
                <button class="btn btn-default navbar-btn navbar-btn-avatar" data-toggle="popover">
                    @if (Auth::check())
                        <img class="rounded-circle" src="{{ Auth::user()->avatar }}">
                    @else
                        <img class="rounded-circle" src="{{ User::guestAvatar() }}">
                    @endif
                </button>
            </li>
        </ul>

        <ul class="nav navbar-nav d-none" id="js-popoverContent">
            @if (Auth::check())
                <li class="nav-item"><a class="nav-link">Logout</a></li>
            @else
                <li class="nav-item"><a class="nav-link">Login</a></li>
            @endif
        </ul>
    </div>
</nav>


<!-- Main Body -->
@yield('mainBody')


<script src="/assets/bootstrap-application-theme/js/jquery.min.js"></script>
<script src="/assets/bootstrap-application-theme/js/popper.min.js"></script>
<script src="/assets/bootstrap-application-theme/js/chart.js"></script>
<script src="/assets/bootstrap-application-theme/js/toolkit.js"></script>
<script src="/assets/bootstrap-application-theme/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function () {
        while (window.BS && window.BS.loader && window.BS.loader.length) {
            (window.BS.loader.pop())()
        }
    })
</script>
</body>
</html>
