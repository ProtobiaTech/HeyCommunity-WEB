@extends('layouts.default')

@section('title')
登录 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-login">
    <div class="container-fluid container-fill-height">
        <div class="container-content-middle">
            <form action="{{ route('user.default-login-handler') }}" method="post" class="mx-auto app-login-form">
                {{ csrf_field() }}

                <h2 class="text-center">欢迎登入</h2>
                <br>

                @if ($errors)
                    <ul style="color:red">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="form-group">
                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="手机号码">
                </div>

                <div class="form-group mb-3">
                    <input class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="密码">
                </div>

                <div class="text-center">
                    <button class="btn btn-block btn-primary">登入</button>
                </div>

                <footer class="mt-3 text-center">
                    没有帐号? 现在<a class="" href="{{ route('user.default-signup') }}">注册</a>
                    &nbsp;&nbsp;
                    <a class="text-muted">忘记密码？</a>

                    @if (Agent::isDesktop())
                        <p class="mt-2">
                            <a href="{{ route('user.login-wechat') }}"><i class="fa fa-wechat"></i> 使用微信快速登录</a>
                        </p>
                    @endif
                </footer>
            </form>
        </div>
    </div>
</div>
@endsection
