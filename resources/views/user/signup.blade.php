@extends('layouts.default')

@section('mainBody')
    <div class="container-fluid container-fill-height">
        <div class="container-content-middle">
            <form action="{{ route('user.signup-handler') }}" method="post" class="mx-auto app-login-form">
                {{ csrf_field() }}

                <h2 class="text-center">注册一个新用户</h2>
                <br>

                @if ($errors)
                    <ul style="color:red">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif


                <div class="form-group">
                    <input class="form-control" type="text" name="nickname" value="{{ old('nickname') }}"
                           placeholder="昵称">
                </div>

                <div class="form-group">
                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}"
                           placeholder="手机号码">
                </div>

                <div class="form-group mb-3">
                    <input class="form-control" type="password" name="password" value="{{ old('password') }}"
                           placeholder="密码">
                </div>

                <div class="mb-5 text-center ">
                    <button type="submit" class="btn btn-primary">注册</button>
                    <a class="btn btn-secondary btn-link" href="{{ route('user.login') }}">登录</a>
                </div>
            </form>
        </div>
    </div>
@endsection
