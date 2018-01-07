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
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="col-md-8 m-np">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ $news->origin }}
                                <span class="pull-right">
                                    <small>
                                        {{ $news->time }}
                                    </small>
                                </span>
                            </h6>

                            <p class="card-text">
                                {!! $news->content !!}
                            </p>

                            <br class="m-inline">
                            <a target="_blank" href="{{ $news->url ?: $news->weburl }}" class="card-link m-inline">访问原文</a>
                            <br class="m-hide">
                            <a target="_blank" href="{{ $news->weburl ?: $news->url }}" class="card-link m-hide">访问原文</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
