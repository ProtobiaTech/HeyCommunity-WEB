@extends('layouts.default')

@section('title')
{{ $news->title }} - {{ $system->site_title }}
@endsection

@section('description')
{{ str_limit(strip_tags($news->content), 100) }}
@endsection

@section('avatar')
{{ $news->avatar }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-show">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-9 m-np mb-3">
                    <div class="card card-news">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <span class="news-origin">
                                    {{ $news->origin }}
                                </span>

                                <span class="pull-right news-date">
                                    {{ $news->time }}
                                </span>
                            </h6>

                            <div class="card-text">
                                {!! $news->content !!}
                            </div>

                            <br class="m-inline">
                            <a target="_blank" href="{{ $news->url ?: $news->weburl }}" class="card-link m-inline">访问原文</a>
                            <br class="m-hide">
                            <a target="_blank" href="{{ $news->weburl ?: $news->url }}" class="card-link m-hide">访问原文</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 m-np">
                    @include('layouts._tail')
                </div>
            </div>
        </div>
    </div>
@stop
