@extends('layouts.default')

@section('title')
{{ $topic->title }} - {{ $system->site_title }}
@endsection

@section('description')
{{ str_limit(strip_tags($topic->content), 150) }}
@endsection

@section('avatar')
{{ $topic->author->avatar }}
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
                    <button class="btn btn-block btn-secondary" onclick="location.assign(getCookie('TopicDetailPageBackUrl'))"><i class="pull-left fa fa-chevron-left"></i> 返回</button>
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

                    @if (Gate::allows('basic-handle', $topic))
                        <br>
                        <a class="btn btn-block btn-secondary" href="{{ route('topic.edit', $topic->id) }}">
                            <i class="pull-left fa fa-edit"></i> 编辑
                        </a>
                        <button class="btn btn-block btn-secondary" onclick="destroyTopic({{ $topic->id }})"><i class="pull-left fa fa-trash"></i> 删除</button>
                    @endif
                </div>

                <!-- body -->
                <div class="col-md-7 m-np">
                    <div id="topic-card" class="card m-nb-r m-nb-y">
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a></h4>

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
                            <div class="card-text">
                                {!! ($topic->content) !!}
                            </div>

                            <div class="footer">
                                <div class="pull-right d-none d-md-block">
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

                                <div class="text-center d-block d-md-none">
                                    <div class="topic-info text-muted">
                                        <div class="mt-5">
                                            {{ $topic->comment_num }} 评论
                                            &nbsp;/&nbsp;
                                            {{ $topic->read_num }} 阅读
                                        </div>

                                        <div>
                                            <div class="btn-group btn-group-sm mt-2">
                                                <button type="button" class="btn btn-secondary {{ $topic->isUserFavorite ? 'active' : '' }}" onclick="postSubmit('{{ route('topic.favorite') }}', {topic_id: {{  $topic->id }}})">
                                                    @if ($topic->isUserFavorite)
                                                        <i class="fa fa-star"></i> 已收藏
                                                    @else
                                                        <i class="fa fa-star-o"></i> 收藏
                                                    @endif
                                                    <small>x{{ $topic->favorite_num }}</small>
                                                </button>
                                                <button type="button" class="btn btn-secondary {{ $topic->isUserThumbUp ? 'active' : '' }}" onclick="postSubmit('{{ route('topic.thumb') }}', {type: 'thumb_up', topic_id: {{  $topic->id }}})">
                                                    @if ($topic->isUserThumbUp)
                                                        <i class="fa fa-thumbs-up"></i> 已赞
                                                    @else
                                                        <i class="fa fa-thumbs-o-up"></i> 赞
                                                    @endif
                                                    <small>x{{ $topic->thumb_up_num }}</small>
                                                </button>
                                                <button type="button" class="btn btn-secondary {{ $topic->isUserThumbDown ? 'active' : '' }}" onclick="postSubmit('{{ route('topic.thumb') }}', {type: 'thumb_down', topic_id: {{  $topic->id }}})">
                                                    @if ($topic->isUserThumbDown)
                                                        <i class="fa fa-thumbs-down"></i> 已踩
                                                    @else
                                                        <i class="fa fa-thumbs-o-down"></i> 踩
                                                    @endif
                                                    <small>x{{ $topic->thumb_down_num }}</small>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="btn-group btn-group-sm mt-4">
                                                <a class="btn btn-secondary" href="{{ route('topic.edit', $topic->id) }}">
                                                    <i class="fa fa-edit"></i> 编辑
                                                </a>
                                                <button type="button" class="btn btn-secondary" onclick="destroyTopic({{ $topic->id }})">
                                                    <i class="fa fa-trash"></i> 删除
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="section-comment-list">
                        <h3><span class="badge badge-secondary">评论列表 <small>({{ $topic->comments()->count() }})</small></span></h3>
                        @foreach ($topic->rootComments as $comment)
                            @include('topic._topic_comment', ['comment' => $comment])
                        @endforeach

                        @if (!$topic->comments()->count())
                            <div class="card m-nb-r m-nb-y">
                                <div class="card-body">
                                    暂无评论
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="section-comment-textarea">
                        <h3><span class="badge badge-secondary">我要评论</span></h3>
                        <div class="card m-nb-r m-nb-y">
                            <div class="card-body">
                                <form action="{{ route('topic.comment.store') }}" method="post">
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                    {{ csrf_field() }}

                                    <div class="form-group simditor-box">
                                        @if (Auth::guest())
                                            <div id="section-textarea-login-tip" style="padding-top:25px;">
                                                请<a href="{{ route('user.login') }}">登入</a>后再发表评论
                                            </div>
                                        @endif
                                        <textarea name="content" id="input-comment-textarea" class="form-control simditor-editor" rows="3" placeholder="{{ Auth::check() ? '在这里, 我们真诚地交流' : '' }}">{{ old('content') }}</textarea>
                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>

                                    <div class="pull-right d-none d-md-block">
                                        <button class="btn btn-primary pl-4 pr-4" {{ setDisabled(Auth::guest()) }} type="submit">提交</button>
                                    </div>

                                    <div class="d-block d-md-none">
                                        <button class="btn btn-primary btn-block pl-4 pr-4" {{ setDisabled(Auth::guest()) }} type="submit">提交</button>
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
@endsection


@section('script')
<script>
    // set topic detail page back url
    if ('{{ URL::previous() }}'.search(/topic\/[0-9]*/) < 0) {
        setCookie('TopicDetailPageBackUrl', '{{ URL::previous() }}');
    }

    /**
     * destroy topic
     */
    function destroyTopic(id) {
        confirmPostSubmit('是否要删除该话题', '{{ route("topic.destroy") }}', {id: id})
    }

    /**
     * destroy topic comment
     */
    function destroyComment(id) {
        confirmPostSubmit('是否要删除该评论', '{{ route("topic.comment.destroy") }}', {id: id})
    }

    /**
     * Show Topic Comment Reply Box
     */
    function showTopicCommentReplyBox(id, device)
    {
        if (device == 'mobile') {
            var selector = '#m-form-topic-reply-' + id;
        } else {
            var selector = '#form-topic-reply-' + id;
        }

        if ($(selector).is(':visible')) {
            $(selector).fadeOut();
        } else {
            $(selector).attr('style', 'display: block !important;').show();
            $(selector).find('[name="parent_id"]').val(id);
        }
    }

    /**
     * Hidden Topic Comment Reply Box
     */
    function hiddenTopicCommentReplyBox(id, device)
    {
        if (device == 'mobile') {
            var selector = '#m-form-topic-reply-' + id;
        } else {
            var selector = '#form-topic-reply-' + id;
        }

        $(selector).fadeOut();
    }

    /**
     * Reply Topic Comment
     */
    function replyTopicComment(event) {
        event.preventDefault();

        var url = '{{ route('topic.comment.reply') }}';
        var params = {};

        var data = $(event.target).serializeArray();
        data.forEach(function(item) {
            params[item.name] = item.value;
        })

        postSubmit(url, params);
    }
</script>
@endsection
