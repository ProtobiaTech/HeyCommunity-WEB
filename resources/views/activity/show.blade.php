@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-activity-index">
        <div class="container pt-4 pb-5">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('activity') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-sm-5">
                    <img src="{{ asset($activity->avatar) }}" class="img-fluid img-thumbnail">
                </div>
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $activity->title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $activity->created_at }}</h6>
                            <p class="card-text">{{ $activity->intro }}</p>
                            <a href="#" class="card-link">立即报名</a>
                            <a href="#" class="card-link">参与讨论</a>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <div class="row">
                <div class="col-sm-8">
                    <nav class="nav nav-tabs" id="myTab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-content-tab" data-toggle="tab" href="#nav-content" role="tab" aria-controls="nav-content" aria-selected="true">详情</a>
                        <a class="nav-item nav-link" id="nav-participant-tab" data-toggle="tab" href="#nav-participant" role="tab" aria-controls="nav-participant" aria-selected="false">报名</a>
                        <a class="nav-item nav-link" id="nav-topic-tab" data-toggle="tab" href="#nav-topic" role="tab" aria-controls="nav-topic" aria-selected="false">讨论</a>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
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
        </div>
    </div>
@stop
