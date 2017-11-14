@extends('layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-user-login">
    <div class="container-fluid container-fill-height">
        <div class="container-content-middle">
            <form action="{{ route('user.login-handler') }}" method="post" class="mx-auto app-login-form">
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

                <div class="mb-5 text-center">
                    <button class="btn btn-primary">登入</button>
                    <a class="btn btn-secondary btn-link" href="{{ route('user.signup') }}">注册</a>
                </div>


                <footer class="screen-login text-center">
                    <a class="text-muted">忘记密码？</a>
                </footer>
            </form>
        </div>
    </div>
</div>
@endsection
