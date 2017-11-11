@extends('layouts.default')

@section('mainBody')
    <div id="section-mainbody" class="page-topic-show">
        <div class="container pt-4 pb-5">
            <nav id="section-breadcrumb" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('topic') }}">话题</a></li>
                    @if ($topic->node->parent)
                        <li class="breadcrumb-item"><a href="{{ route('topic.index', ['node' => $topic->node->parent->name]) }}">{{ $topic->node->parent->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item"><a href="{{ route('topic.index', ['node' => $topic->node->name]) }}">{{ $topic->node->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">话题详情</li>
                </ol>
            </nav>

            <div class="row">
                <!-- operation -->
                <div id="section-operation" class="col-md-2 d-none d-md-block">
                    <a class="btn btn-block btn-secondary" href="{{ request()->header('referer') }}"><i class="pull-left fa fa-chevron-left"></i> 返回</a>
                    <br>

                    <a class="btn btn-block btn-secondary" href="javascript:$('#input-comment-textarea').focus();">
                        <i class="pull-left fa fa-reply"></i> 回复
                    </a>

                    <a class="btn btn-block btn-secondary" onclick="event.preventDefault();
                   document.getElementById('topic-thumb-up').submit();"><i class="pull-left fa fa-thumbs-o-up"></i> 点赞</a>
                    <a class="btn btn-block btn-secondary" onclick="event.preventDefault();
                   document.getElementById('topic-thumb-down').submit();"><i class="pull-left fa fa-thumbs-o-down"></i> 点踩</a>
                    <a class="btn btn-block btn-secondary" onclick="event.preventDefault();
                   document.getElementById('topic-star-form').submit();"><i class="pull-left fa fa-star-o"></i> 收藏</a>

                    <div style="display: none">
                        <form method="POST" action="http://the.hey-community.com/topic/set-thumb" accept-charset="UTF-8" id="topic-thumb-up"><input name="_token" type="hidden" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input type="hidden" name="_token" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input name="id" type="hidden" value="17">
                            <input name="value" type="hidden" value="up">
                        </form>
                    </div>

                    <div style="display: none">
                        <form method="POST" action="http://the.hey-community.com/topic/set-thumb" accept-charset="UTF-8" id="topic-thumb-down"><input name="_token" type="hidden" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input type="hidden" name="_token" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input name="id" type="hidden" value="17">
                            <input name="value" type="hidden" value="down">
                        </form>
                    </div>

                    <div style="display: none">
                        <form method="POST" action="http://the.hey-community.com/topic/set-star" accept-charset="UTF-8" id="topic-star-form"><input name="_token" type="hidden" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input type="hidden" name="_token" value="OlxgtSIpuqRrZj8g9LFnziDt6l1Cn9lFmuuiVHyl">
                            <input name="id" type="hidden" value="17">
                        </form>
                    </div>
                </div>

                <!-- body -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $topic->title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <span class="d-none d-md-inline-block">
                                    @if ($topic->node->parent)
                                        <a href="{{ route('topic.index', ['node' => $topic->node->parent->name]) }}">{{ $topic->node->parent->name }}</a>
                                        <span>/</span>
                                    @endif
                                    <a href="{{ route('topic.index', ['node' => $topic->node->name]) }}">{{ $topic->node->name }}</a>
                                </span>
                                <a class="d-inline-block d-md-none" href="{{ route('user.uhome', $topic->author->id) }}">{{ $topic->author->nickname }}</a>
                                <span class="pull-right date">{{ $topic->created_at }}</span>
                            </h6>
                            <p class="card-text">
                                {{ $topic->content }}
                            </p>
                        </div>
                    </div>

                    <div id="section-comment-list">
                        <h3><span class="badge badge-secondary">评论列表 <small>({{ $topic->comments()->count() }})</small></span></h3>
                        @foreach ($topic->comments as $comment)
                            <div class="card">
                                <div class="card-body">
                                    <a class="avatar" href="{{ route('user.uhome', $comment->author->id) }}"><img class="avatar" src="{{ asset($comment->author->avatar) }}"></a>
                                    <div class="pull-left body">
                                        <div class="title">
                                            <a href="{{ route('user.uhome', $comment->author->id) }}">{{ $comment->author->nickname }}</a>
                                            <span class="info pull-right text-muted">
                                                <span><b>#{{ $comment->floor_number }}</b></span>
                                                &nbsp;&nbsp;
                                                {{ $comment->created_at }}
                                            </span>
                                        </div>
                                        <div class="content">
                                            {{ $comment->content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if (!$topic->comments()->count())
                            <div class="card">
                                <div class="card-body">
                                    暂无评论
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="section-comment-textarea">
                        <h3><span class="badge badge-secondary">我要评论</span></h3>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('topic.comment.store') }}" method="post">
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <textarea name="content" class="form-control" rows="3">{{ old('content') }}</textarea>
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>
                                    <div class="pull-right">
                                        <button class="btn btn-primary pl-4 pr-4" type="submit">发布</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div id="section-right" class="col-md-3 d-none d-md-block">
                    @include('user._user_profile_card', ['user' => $topic->author])
                </div>
            </div>
        </div>
    </div>
@stop
