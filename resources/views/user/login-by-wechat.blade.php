@extends('layouts.default')

@section('title')
微信登录 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-login-wechat-transfer">
    <div class="container container-fill-height">

        <br>
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 text-center">
                <h2>{{ Auth::user()->nickname }}, 欢迎您登录 {{ $system->site_title }}</h2>

                <br>
                <p>
                    {{ $system->site_title }} 是一个开放、平等、高质量的交流社区 ~
                    <br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
