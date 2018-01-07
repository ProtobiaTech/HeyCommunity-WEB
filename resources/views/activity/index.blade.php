@extends('layouts.default')

@section('title')
活动 - {{ $system->site_title }}
@endsection

@section('mainBody')
<div id="section-mainbody" class="page-activity-index">
    <!--
    @include('activity._carousel', ['elementId' => 'section-carousel-top'])
    -->

    <div class="container pt-4 pb-5">
        @include('activity._carousel', ['elementId' => 'section-carousel'])

        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary " href="{{ route('activity.create') }}">发布新活动</a>
                &nbsp;&nbsp;

                <a class="btn btn-secondary " href="{{ route('activity.index') }}">最近</a>

                <div class="pull-right">
                    <a class="btn btn-secondary" href="{{ route('activity.index') }}">刷新</a>
                </div>

                <hr class="mt-2 mb-4 m-hide">
                <div class="mb-3 m-block"></div>
            </div>
        </div>

        <!-- Activity List -->
        @include('activity._activity-list', ['activities' => $activities])
    </div>
</div>
@stop
