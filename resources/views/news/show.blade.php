@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-4 pb-5">
            <div class="row">
                <div class="col-md-3"></div>

                <div class="col-md-6 m-np">
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

                            <a target="_blank" href="{{ $news->url ?: $news->weburl }}" class="card-link m-inline">访问原文</a>
                            <a target="_blank" href="{{ $news->weburl ?: $news->url }}" class="card-link m-hide">访问原文</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
