@extends('layouts.default')

@section('title')
    {{ $activity->title }} - {{ $system->site_title }}
@endsection

@section('description')
    {{ str_limit(strip_tags($activity->content), 100) }}
@endsection

@section('avatar')
    {{ $activity->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-activity-show">
        <div class="container pt-4">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('activity') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">活动详情</li>
                </ol>
            </nav>

            <div class="row" id="section-row-1">
                <div class="col-md-5 m-np m-nb-y box-avatar">
                    <img src="{{ asset($activity->avatar) }}" class="img-fluid img-thumbnail m-np m-nb-r" style="width:100%;">
                </div>
                <div class="col-md-7 m-np m-nb card-intro">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $activity->title }}</h4>

                            <div class="d-block d-sm-none mb-3">
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    {{ $activity->start_time }} - {{ $activity->end_time }}
                                </h6>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fa fa-map-signs"></i>&nbsp;
                                    {{ $activity->local }}
                                </h6>
                            </div>

                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fa fa-user"></i>&nbsp;
                                {{ $activity->author->nickname }}

                                <span class="pull-right">
                                    <small>发布于 {{ $activity->created_at }}</small>
                                </span>
                            </h6>

                            <p class="card-text">{!! $activity->intro !!}</p>

                            <div class="box-redirect">
                                <a class="btn btn-primary" href="{{ $activity->redirect_url }}" target="_blank">
                                    <i class="fa fa-send"></i> &nbsp;
                                    报名或了解活动详情
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row" id="section-row-2">
                <div class="col-md-8 m-np" id="section-body">
                    <nav class="nav nav-tabs" id="mainTab">
                        <a class="nav-item nav-link active" id="nav-content-tab" data-toggle="tab" href="#nav-content">活动详情</a>
                        <a class="nav-item nav-link" id="nav-topic-tab" data-toggle="tab" href="#nav-topic">相关讨论</a>
                    </nav>
                    <div class="tab-content pt-0" id="nav-mainTabContent">
                        <div class="tab-pane fade show active" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
                            <div class="card border-top-0">
                                <div class="card-body">
                                    {!! $activity->content !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-topic" role="tabpanel" aria-labelledby="nav-topic-tab">
                            <div class="card border-top-0">
                                <div class="card-body">
                                    话题讨论暂不可用
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 m-np d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-calendar"></i>
                                &nbsp;
                                <b>{{ $activity->start_time }}</b> <br>
                            </h4>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fa fa-map-signs"></i>
                                &nbsp;
                                {{ $activity->local }}
                            </h6>
                            <p class="card-text">
                                活动于 {{ $activity->end_time }} 结束，欢迎你参加 ~ <br>
                                <a href="{{ $activity->redidrect_url }}" target="_blank">点击这里</a>，报名或了解更多活动详情
                            </p>
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-12 d-block d-md-none m-np mt-3">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
