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

                <div class="operations">
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="line-1 mb-2">
                                <a href="" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-user-circle-o"></i> 更换头像</a>
                                <a href="" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-picture-o"></i> 更换封面</a>
                            </div>
                            <div class="">
                                <a href="{{ route('user.uhome', $user->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-info-circle"></i> 我的主页</a>
                                <a href="{{ route('user.profile') }}" class="btn btn-sm btn-secondary"><i class="fa fa-w fa-id-card-o"></i> 更新个人资料</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-sm-2">
                    @include('user._nav')
                </div>

                <div class="col-sm-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show" id="pills-timeline">暂不可用</div>
                        <div class="tab-pane fade show active" id="pills-topic">
                            @include('topic._topic_list', ['topics' => $myTopics])
                        </div>
                        <div class="tab-pane fade show" id="pills-activity">
                            @include('activity._activity_list', ['activities' => $myActivities])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
