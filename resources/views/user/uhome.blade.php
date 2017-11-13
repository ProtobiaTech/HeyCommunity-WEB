@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-user-uhome">
        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-md-3">
                    @include('user._user_profile_card', ['user' => $user])

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
