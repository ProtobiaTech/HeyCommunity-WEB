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
        <div class="container pt-4 pb-5">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('activity') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">活动详情</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-5 m-np m-nb-y">
                    <img src="{{ asset($activity->avatar) }}" class="img-fluid img-thumbnail m-np m-nb-r" style="width:100%;">
                </div>
                <div class="col-md-7 m-np m-nb">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $activity->title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $activity->author->nickname }}

                                <span class="pull-right">
                                    <small>{{ $activity->created_at }}</small>
                                </span>
                            </h6>
                            <p class="card-text">{!! $activity->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!--
            <br>
            <div class="row" id="section-row2">
                <div class="col-sm-8" id="section-body">
                    <nav class="nav nav-tabs" id="mainTab">
                        <a class="nav-item nav-link active" id="nav-content-tab" data-toggle="tab" href="#nav-content">详情</a>
                        <a class="nav-item nav-link" id="nav-participant-tab" data-toggle="tab" href="#nav-participant">报名</a>
                        <a class="nav-item nav-link" id="nav-topic-tab" data-toggle="tab" href="#nav-topic">讨论</a>
                    </nav>
                    <div class="tab-content" id="nav-mainTabContent">
                        <div class="tab-pane fade show active" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
                            {{ $activity->content }}
                        </div>
                        <div class="tab-pane fade" id="nav-participant" role="tabpanel" aria-labelledby="nav-participant-tab">报名</div>
                        <div class="tab-pane fade" id="nav-topic" role="tabpanel" aria-labelledby="nav-topic-tab">话题讨论</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fa fa-calendar"></i>
                                &nbsp;
                                <b>{{ $activity->created_at }}</b>
                            </h4>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fa fa-map-signs"></i>
                                &nbsp;
                                XXX 路
                            </h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
@stop
