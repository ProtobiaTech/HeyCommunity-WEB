@extends('layouts.default')

@section('title')
{{ $topic->title }} - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-topic-show">
        <div class="container pt-4 pb-5">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
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

                    <a class="btn btn-block btn-secondary" href="javascript:postSubmit('{{ route('topic.thumb') }}', {type: 'thumb_up', topic_id: {{  $topic->id }}})">
                        @if ($topic->isUserThumbUp)
                            <i class="pull-left fa fa-thumbs-up"></i> 已赞
                        @else
                            <i class="pull-left fa fa-thumbs-o-up"></i> 点赞
                        @endif
                    </a>
                    <a class="btn btn-block btn-secondary" href="javascript:postSubmit('{{ route('topic.thumb') }}', {type: 'thumb_down', topic_id: {{  $topic->id }}})">
                        @if ($topic->isUserThumbDown)
                            <i class="pull-left fa fa-thumbs-down"></i> 已踩
                        @else
                            <i class="pull-left fa fa-thumbs-o-down"></i> 点踩
                        @endif
                    </a>
                    <a class="btn btn-block btn-secondary" href="javascript:postSubmit('{{ route('topic.favorite') }}', {topic_id: {{  $topic->id }}})">
                        @if ($topic->isUserFavorite)
                            <i class="pull-left fa fa-star"></i> 已收藏
                        @else
                            <i class="pull-left fa fa-star-o"></i> 收藏
                        @endif
                    </a>
                </div>

                <!-- body -->
                <div class="col-md-7">
                    <div id="topic-card" class="card">
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
                                {!! ($topic->content) !!} &nbsp;
                            </p>

                            <div class="footer">
                                <div class="pull-right">
                                    <div class="topic-info text-muted">
                                        {{ $topic->favorite_num }} 收藏
                                        &nbsp;/&nbsp;
                                        {{ $topic->thumb_up_num }} 赞
                                        &nbsp;/&nbsp;
                                        {{ $topic->thumb_down_num }} 踩
                                        &nbsp;/&nbsp;
                                        {{ $topic->comment_num }} 评论
                                        &nbsp;/&nbsp;
                                        {{ $topic->read_num }} 阅读
                                    </div>
                                </div>
                            </div>
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
                                            {!! ($comment->content) !!} &nbsp;
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
                                        <textarea name="content" id="input-comment-textarea" class="form-control simditor-editor" rows="3">{{ old('content') }}</textarea>
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>

                                    <div class="pull-right d-none d-md-block">
                                        <button class="btn btn-primary pl-4 pr-4" type="submit">发布</button>
                                    </div>

                                    <div class="d-block d-md-none">
                                        <button class="btn btn-primary btn-block pl-4 pr-4" type="submit">发布</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div id="section-right" class="col-md-3 d-none d-md-block">
                    @include('user._user-profile-card', ['user' => $topic->author])
                </div>
            </div>
        </div>
    </div>
@stop


@section('script')
<script>
    shareTitle = "{{ $topic->title }}";
    shareDesc = "{{ str_limit(strip_tags($topic->content), 60) }}";
    shareImgUrl = "{{ asset($topic->author->avatar) }}";
</script>


<link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor-fullscreen.css') }}" />
<script type="text/javascript" src="{{ asset('assets/simditor/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/simditor/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/simditor/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/simditor/simditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/simditor/simditor-fullscreen.js') }}"></script>
    <script>
        var editor = new Simditor({
            textarea: $('.simditor-editor'),
            toolbar: ['title', 'bold', 'italic', 'underline', 'ol', 'ul', 'hr', 'indent', 'blockquote', 'link', 'image', 'fullscreen'],
            upload: {
                url: '{{ route('upload.simditor-upload-images') }}',
                params: {
                    _token: '{{ csrf_token() }}',
                },
                fileKey: 'files',
                connectionCount: 3,
                leaveConfirm: '图片正在上传，你确定要离开？'
            },
        });
    </script>
@endsection
