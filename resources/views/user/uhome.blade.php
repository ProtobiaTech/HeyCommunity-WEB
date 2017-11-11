@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-user-uhome">
        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-profile mb-4">
                        <div class="card-header" style="background-image: url({{ asset('assets/bootstrap-application-theme/img/iceland.jpg') }});"></div>
                        <div class="card-body text-center">
                            <a href="profile/index.html">
                                <img class="card-profile-img" src="{{ asset($user->avatar) }}">
                            </a>

                            <h6 class="card-title">
                                <a class="text-inherit" href="{{ route('user.uhome', $user->id) }}">{{ $user->nickname }}</a>
                            </h6>

                            <p class="mb-4">I wish i was a little bit taller, wish i was a baller, wish i had a girl…&nbsp;also.</p>

                            <ul class="card-menu">
                                <li class="card-menu-item">
                                    <a href="#userModal" class="text-inherit" data-toggle="modal">
                                        Friends
                                        <h6 class="my-0">12M</h6>
                                    </a>
                                </li>

                                <li class="card-menu-item">
                                    <a href="#userModal" class="text-inherit" data-toggle="modal">
                                        Enemies
                                        <h6 class="my-0">1</h6>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card d-md-block d-lg-block mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">用户资料 <small>· <a href="#">编辑</a></small></h6>
                            <ul class="list-unstyled list-spaced">
                                <li><span class="text-muted icon icon-calendar mr-3"></span>Went to <a href="#">Oh, Canada</a>
                                </li><li><span class="text-muted icon icon-users mr-3"></span>Became friends with <a href="#">Obama</a>
                                </li><li><span class="text-muted icon icon-github mr-3"></span>Worked at <a href="#">Github</a>
                                </li><li><span class="text-muted icon icon-home mr-3"></span>Lives in <a href="#">San Francisco, CA</a>
                                </li><li><span class="text-muted icon icon-location-pin mr-3"></span>From <a href="#">Seattle, WA</a>
                                </li></ul>
                        </div>
                    </div>

                    <div class="card d-md-block d-lg-block mb-4">
                        <div class="card-body">
                            <h6 class="mb-3">Photos <small>· <a href="#">Edit</a></small></h6>
                            <div data-grid="images" data-target-height="150"><div style="margin-bottom: 10px; margin-right: 10px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_5.jpg" style="width: 114px; height: 115px;">
                                </div><div style="margin-bottom: 10px; margin-right: 0px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_6.jpg" style="width: 115px; height: 115px;">
                                </div><div style="margin-bottom: 10px; margin-right: 10px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_7.jpg" style="width: 114px; height: 115px;">
                                </div><div style="margin-bottom: 10px; margin-right: 0px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_8.jpg" style="width: 115px; height: 115px;">
                                </div><div style="margin-bottom: 10px; margin-right: 10px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_9.jpg" style="width: 114px; height: 115px;">
                                </div><div style="margin-bottom: 10px; margin-right: 0px; display: inline-block; vertical-align: bottom;">
                                    <img data-width="640" data-height="640" data-action="zoom" src="assets/img/instagram_10.jpg" style="width: 115px; height: 115px;">
                                </div></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9" id="section-body">
                    <nav class="nav nav-pills" id="mainTab">
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-timeline">公园</a>
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-topic">话题</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-activity">活动</a>
                    </nav>

                    <div class="tab-content" id="nav-mainTabContent">
                        <div class="tab-pane fade show" id="nav-timeline">
                            <div class="card">
                                <div class="card-body">
                                    暂不可用
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="nav-topic">
                            @include('topic._topic_list', ['topics' => $myTopics])
                        </div>

                        <div class="tab-pane fade show" id="nav-activity">
                            @include('activity._activity_list', ['activities' => $myActivities])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
