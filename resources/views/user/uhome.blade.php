@extends('layouts.default')

@section('title')
{{ $user->nickname }} 的主页 - {{ $system->site_title }}
@endsection

@section('description')
{{ $user->bio }}
@endsection

@section('avatar')
{{ $user->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-user-uhome">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-3 m-np">
                    @include('user._user-profile-card', ['user' => $user])

                    <div class="card d-md-block d-lg-block mb-4 m-nb-r m-nb-y">
                        <div class="card-body">
                            <h6 class="mb-3">
                                用户资料
                                <!--
                                <small> · <a href="#">编辑</a></small>
                                -->
                            </h6>
                            <ul class="list-unstyled list-spaced">
                                <li><span class="text-muted icon icon-user mr-3"></span>U{{ $user->id }}</li>
                                <li><span class="text-muted icon icon-location-pin mr-3"></span>中国大陆</li>
                                <li><span class="text-muted icon icon-calendar mr-3"></span>注册于 {{ $user->created_at->format('Y年m月d日') }}, 第 {{ $user->id }} 名会员 </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-3 d-none d-md-block">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-9 m-np" id="section-body">
                    <nav class="nav nav-pills" id="mainTab">
                        <!--
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-timeline">公园</a>
                        -->
                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-topic">话题</a>
                        <!--
                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-activity">活动</a>
                        -->
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
                            @include('topic._topic-list', ['topics' => $myTopics])
                        </div>

                        <div class="tab-pane fade show" id="nav-activity">
                            @include('activity._activity-list', ['activities' => $myActivities])
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 d-block d-md-none m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
