@extends('layouts.default')

@section('title')
微信登录 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-user-login-wechat">
    <div class="container container-fill-height">

        <br>
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-md-1 col-lg-1 col-xl-1">
            </div>
            <div class="col-md-5 col-lg-5 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <br>
                        <h4 class="text-center card-title">微信扫码进行登录</h4>

                        <img class="rounded img-fluid" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(600)->generate(route('user.login-by-wechat', ['token' => $token]))) !!} ">

                        <br>
                        <p class="card-text text-center">
                            打开手机微信，扫描上方二维码进行登录
                            &nbsp;&nbsp;
                            <small><a href="">帮助</a></small>
                        </p>

                        <hr>

                        <p class="card-text text-center">
                            <a href="{{ route('user.default-login') }}">使用帐号密码登录</a>，或<a href="{{ route('user.default-signup') }}">注册一个新帐号</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-6 text-center d-none d-md-block">
                <h2>欢迎登录 {{ $system->site_title }}</h2>

                <br>
                <p>
                    {{ $system->site_title }} 是一个开放、平等、高质量的交流社区，欢迎你的登录 ~
                </p>
            </div>
        </div>
    </div>
</div>


<script>
    Echo.channel('logged-by-wechat-transfer-t-{{ $token }}')
        .listen('.transfer', function(e) {
            var url = '{{ route('user.login-by-wechat-handler') }}';
            var params = {
                user_id: e.user.id,
            };
            postSubmit(url, params);
        });
</script>
@endsection
