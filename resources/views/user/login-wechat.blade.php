@extends('layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-user-login-wechat">
    <div class="container container-fill-height">

        <br>
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <br>
                        <h4 class="text-center card-title">微信扫码进行登录</h4>

                        <img class="rounded img-fluid" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(600)->generate(route('user.login-wechat-transfer'))) !!} ">

                        <br>
                        <p class="card-text text-center">
                            打开手机微信，扫描上方二维码进行登录
                            &nbsp;&nbsp;
                            <small><a href="">帮助</a></small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-7 text-center">
                <h2>欢迎登录 HeyCommunity</h2>

                <br>
                <p>
                    HeyCommunity 是一个开放、平等、高质量的交流社区，欢迎使用 ~
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
