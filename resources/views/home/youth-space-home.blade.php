@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-home-index">
        <div class="container pt-4 pb-5">
            <br>
            <br>
            <div class="text-center">
                <h2 class="h1">HEY赣州 青年空间</h2>
                <h3 class="h5 text-muted">HeyGanzhou YouthSpace</h3>

                <p class="mt-4">
                    坐落于赣州老城区的一个服务青年 创作 / 学习 / 交流 / 活动场所，总面积 270m² <br>
                    5 楼用于生活，提供食宿服务，一应具全的厨房，客厅阳台可供休闲娱乐<br>
                    6 楼用于工作，可同时容纳 6 - 10 人工作，100M 宽带，免费打印机，小会议室<br>
                    楼顶露天花园，晒太阳、吹晚风、数星星，还可以喝啤酒弹吉他 ~
                </p>

                <p>
                    正在筹建中，预计 5 月初开始试运营 <br>
                    如果你对此有兴趣，欢迎你来参观交流，或者参与到项目的建设
                </p>

                <p>
                    地址: 赣州市章贡区新赣南路 71 号（副食品大院） <br>
                    联系方式: 罗德（17600719763 / Rod@protobia.tech）
                </p>
            </div>

            <div class="mt-5 mb-3 text-center"></div>

            <div class="row">
                <div class="col-sm-4">
                    <img src="{{ asset('images/youth-space/wq1.jpg') }}" alt="" class="img-thumbnail">
                </div>

                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{ asset('images/youth-space/tt1.jpg') }}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('images/youth-space/tt2.jpg') }}" alt="" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <img src="{{ asset('images/youth-space/kt2.jpg') }}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ asset('images/youth-space/kt1.jpg') }}" alt="" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
