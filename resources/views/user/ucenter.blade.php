@extends('layouts.default')

@section('title')
用户中心 - {{ $system->site_title }}
@endsection

@php
$wxShareDisable = true;
@endphp

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

                <div class="row operations">
                    <div class="col-sm-6 text-right d-none d-sm-block">
                        <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</a>
                        &nbsp;
                        <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-picture-o"></i> 更换封面</a>
                    </div>

                    <div class="col-sm-6 text-left d-none d-sm-block">
                        <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-info-circle"></i> 我的主页</a>
                        &nbsp;
                        <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-id-card-o"></i> 更新资料</a>
                    </div>

                    <div class="col-12 d-block d-sm-none">
                        <div class="btn-group btn-group-sm">
                            <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换头像</a>
                            <a onclick="alert('暂不可用')" class="btn btn-sm btn-secondary">更换封面</a>
                            <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary">我的主页</a>
                            <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary">更新资料</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 col-md-3 m-np">
                    @include('user._ucenter-nav')

                    <div class="d-none d-md-block">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 m-np">
                    <div class="tab-content">
                        @if (request()->is('*my-timelines') || request()->is('*ucenter'))
                            <div class="tab-pane fade show active">
                                <div class="card m-nb-r m-nb-y">
                                    <div class="card-body">
                                        暂不可用
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (request()->is('*my-topics'))
                            <div class="tab-pane fade show active">
                                @include('topic._topic-list', ['topics' => $myTopics])
                            </div>
                        @endif

                        @if (request()->is('*my-topic-comments'))
                            <div class="tab-pane fade show active">
                                @include('topic._topic-list-with-comment', ['topicComments' => $myTopicComments])
                            </div>
                        @endif

                        @if (request()->is('*my-activit*'))
                            <div class="tab-pane fade show active">
                                @include('activity._activity-list', ['activities' => $myActivities])
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
