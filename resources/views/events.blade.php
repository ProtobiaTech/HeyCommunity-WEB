@extends('layouts.default')

@section('mainBody')
<div id="section-event-carousel" class="carousel slide d-md-none" data-ride="carousel" style="background-color:#ddd;">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="text-center" style="line-height:260px; font-size:60px;">
                Hi
            </div>
        </div>
        <div class="carousel-item">
            <div class="text-center" style="line-height:260px; font-size:60px;">
                HeyCommunity
            </div>
        </div>
        <div class="carousel-item">
            <div class="text-center" style="line-height:260px; font-size:60px;">
                V4
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#section-event-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#section-event-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container pt-4 pb-5">
    <div id="section-event-carousel" class="carousel slide d-none d-md-block" data-ride="carousel" style="background-color:#ddd; margin-bottom:21px;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="text-center" style="line-height:260px; font-size:60px;">
                    Hi
                </div>
            </div>
            <div class="carousel-item">
                <div class="text-center" style="line-height:260px; font-size:60px;">
                    HeyCommunity
                </div>
            </div>
            <div class="carousel-item">
                <div class="text-center" style="line-height:260px; font-size:60px;">
                    V4
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#section-event-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#section-event-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row">
        @foreach (range(1, 6) as $item)
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="https://lorempixel.com/640/480" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">活动名称</h4>
                        <p class="card-text">活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述活动描述</p>
                        <a href="#" class="btn btn-primary">立即报名</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop
