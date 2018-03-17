<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>HeyCommunity V4 Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/webadmin/images/favicon.ico') }}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('assets/webadmin/plugins/morris/morris.css') }}">

    <link href="{{ asset('assets/webadmin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/webadmin/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/webadmin/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('assets/webadmin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/webadmin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>


<body class="fixed-left">

<!-- Flash Message -->
@include('flash::message')
<style>
    #section-flash .alert {
        background-color: #fff;
    }
</style>

<div id="wrapper">
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{ route('admin.home.index') }}" class="logo"><span>HeyCommunity</span>V4</a>
                <a href="{{ route('admin.home.index') }}" class="logo-sm"><span>HC</span></a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="ion-navicon"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>
                    @yield('search')

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown hidden-xs">
                            <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg">
                                <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                                <li class="list-group">
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-heading">Your order is placed</div>
                                            <p class="m-0">
                                                <small>Dummy text of the printing and typesetting industry.</small>
                                            </p>
                                        </div>
                                    </a>
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-body clearfix">
                                                <div class="media-heading">New Message received</div>
                                                <p class="m-0">
                                                    <small>You have 87 unread messages</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- list item-->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-body clearfix">
                                                <div class="media-heading">Your item is shipped.</div>
                                                <p class="m-0">
                                                    <small>It is a long established fact that a reader will</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- last list item -->
                                    <a href="javascript:void(0);" class="list-group-item">
                                        <small class="text-primary">See all notifications</small>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="user-img" class="img-circle">
                                <span class="profile-username">
                                    {{ Auth::user()->nickname }} <br/>
                                    <small>{{ str_limit(Auth::user()->bio, 8) }}</small>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"> Profile</a></li>
                                <li><a href="javascript:void(0)"><span class="badge badge-success pull-right">5</span> Settings </a></li>
                                <li><a href="javascript:void(0)"> Lock screen</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)"> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('admin.home.index') }}" class="waves-effect">
                            <i class="mdi mdi-home"></i>
                            <span>首页<span class="badge badge-primary pull-right">1</span></span>
                        </a>
                    </li>



                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-comment-text"></i>
                            <span>新闻管理</span>
                            <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('admin.news.index') }}">新闻列表</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-comment-text"></i>
                            <span>话题管理</span>
                            <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('admin.topic.index') }}">话题列表</a></li>
                            <li><a href="{{ route('admin.topic.node.index') }}">节点管理</a></li>
                        </ul>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-comment-text"></i>
                            <span>活动管理</span>
                            <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('admin.activity.index') }}">活动列表</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.system.edit') }}" class="waves-effect">
                            <i class="mdi mdi-wrench"></i>
                            <span>系统配置</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->


    <div class="content-page">
        <div class="content">
            @yield('mainBody')
        </div>

        <footer class="footer">
            &copy;2017 HeyCommunity V4 - All Rights Reserved.
        </footer>
    </div>
</div>


<!-- jQuery  -->
<script src="{{ asset('assets/webadmin/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/detect.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/fastclick.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/waves.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/jquery.scrollTo.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('assets/webadmin/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('assets/webadmin/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('assets/webadmin/pages/dashborad.js') }}"></script>
<script src="{{ asset('assets/webadmin/js/app.js') }}"></script>

</body>
</html>
