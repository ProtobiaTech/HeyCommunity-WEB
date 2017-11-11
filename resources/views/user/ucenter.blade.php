@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-user-ucenter">
        <div class="profile-header" style="background-image: url(/assets/bootstrap-application-theme/img/iceland.jpg);">
            <div class="container">
                <div class="container-inner">
                    <img class="rounded-circle media-object" src="{{ asset($user->avatar) }}">
                    <h3 class="profile-header-user">{{ $user->nickname }}</h3>
                    <p class="profile-header-bio">
                        {{ $user->bio }}
                        暂无个性签名
                    </p>
                </div>
            </div>
        </div>

        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-sm-2">
                    <div class="list-group">
                        <a data-toggle="pill" href="#pills-timeline" class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span>我的动态</span>
                            <span class="icon icon-chevron-thin-right"></span>
                        </a>
                        <a data-toggle="pill" href="#pills-topic" class="active list-group-item list-group-item-action d-flex justify-content-between">
                            <span>我的话题</span>
                            <span class="icon icon-chevron-thin-right"></span>
                        </a>
                        <a data-toggle="pill" href="#pills-activity" class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span>我的活动</span>
                            <span class="icon icon-chevron-thin-right"></span>
                        </a>
                    </div>

                    <br>
                    <div class="list-group">
                        <a href="{{ route('notification.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between">
                            <span>通知</span>
                            <span class="icon icon-chevron-thin-right"></span>
                        </a>
                    </div>
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
