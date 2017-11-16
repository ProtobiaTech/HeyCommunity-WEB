@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-user-ucenter">
        <div class="profile-header" style="background-image: url('{{ asset($user->profile_bg_img) }}');">
            <div class="container">
                <div class="container-inner">
                    <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}">
                    <h3 class="profile-header-user">{{ $user->nickname }}</h3>
                    <p class="profile-header-bio">
                        {{ $user->bio ?: '暂无签名' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-sm-2">
                    @include('user._nav')
                </div>

                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.profile-update') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-nickname" class="col-2 col-form-label">昵称</label>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <input name="nickname" type="text" class="form-control" id="input-nickname" value="{{ old('nickname', $user->nickname) }}">

                                        <div class="text-danger">{{ $errors->first('nickname') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-bio" class="col-2 col-form-label">一句话介绍</label>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <input name="bio" type="text" class="form-control" id="input-bio" value="{{ old('bio', $user->bio) }}">

                                        <div class="text-danger">{{ $errors->first('bio') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-gender" class="col-2 col-form-label">性别</label>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <select name="gender" class="custom-select form-control">
                                            <option selected>请选择性别</option>
                                            @foreach (\App\User::$genders as $value => $name)
                                                <option value="{{ $value }}" {{ $value == old('gender', $user->gender) ? 'selected' : '' }}>
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-phone" class="col-2 col-form-label">电话</label>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <input name="phone" type="text" class="form-control" id="input-phone" value="{{ old('phone', $user->phone) }}">

                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-email" class="col-2 col-form-label">邮箱</label>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <input name="email" type="text" class="form-control" id="input-email" value="{{ old('email', $user->email) }}">

                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-2"></div>
                                    <div class="col-10 col-sm-8 col-md-6">
                                        <button class="btn btn-primary btn-block" type="submit">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop