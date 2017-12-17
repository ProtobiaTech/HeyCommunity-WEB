<div class="card m-nb-r m-nb-y">
    <div class="card-body">
        <a class="avatar" href="{{ route('user.uhome', $comment->author->id) }}"><img class="avatar" src="{{ asset($comment->author->avatar) }}"></a>
        <div class="pull-left body">
            <div class="title">
                <a href="{{ route('user.uhome', $comment->author->id) }}">{{ $comment->author->nickname }}</a>

                @if ($comment->root_id && $comment->root_id !== $comment->parent_id)
                    <sup><small class="text-muted">Re #{{ $comment->parent->floor_number }}</small></sup>
                    &nbsp;
                @endif

                <span class="info m-desktop pull-right text-muted d-none d-md-inline-block">
                    <span class="">
                        <a href="javascript:showTopicCommentReplyBox({{ $comment->id }})"><i class="fa fa-reply"></i></a>
                        &nbsp;&nbsp;
                        <a href="javascript:alert('此功能暂不可用');commentThumbUp({{ $comment->id }})"><i class="fa fa-thumbs-up"></i></a>
                        &nbsp;&nbsp;
                    </span>

                    &nbsp;
                    <span><b>#{{ $comment->floor_number }}</b></span>

                    &nbsp;&nbsp;
                    {{ $comment->created_at }}

                    @if (Gate::allows('basic-handle', $comment))
                        <span class="span-trash">
                            &nbsp;&nbsp;
                            <span><a href="javascript:destroyComment({{ $comment->id }})"><i class="fa fa-trash"></i></a></span>
                        </span>
                    @endif
                </span>

                <span class="info m-mobile pull-right text-muted d-inline-block d-md-none">
                    <span><b>#{{ $comment->floor_number }}</b></span>
                    &nbsp;&nbsp;

                    <span class="">
                        <a href="javascript:showTopicCommentReplyBox({{ $comment->id }}, 'mobile')"><i class="fa fa-reply"></i></a>
                        &nbsp;
                        <a href="javascript:alert('此功能暂不可用');commentThumbUp({{ $comment->id }})"><i class="fa fa-thumbs-up"></i></a>
                        @if (Gate::allows('basic-handle', $comment))
                            &nbsp;
                            <span><a href="javascript:destroyComment({{ $comment->id }})"><i class="fa fa-trash"></i></a></span>
                        @endif
                    </span>
                </span>
            </div>

            <div class="content">
                {!! ($comment->content) !!}
            </div>

            @if ($comment->childComments()->count())
                <div class="child-comments mt-4">
                    @foreach($comment->childComments as $childComment)
                        @include('topic._topic_comment', ['comment' => $childComment])
                    @endforeach
                </div>
            @endif


            <form onsubmit="replyTopicComment(event)" method="post" class="d-none d-md-block form-topic-reply-box" id="form-topic-reply-{{ $comment->id }}">
                <hr class="mt-4">
                <input type="hidden" name="parent_id">
                <div class="form-group">
                    <textarea name="content" class="form-control" placeholder="输入你的回复内容"></textarea>
                </div>
                <div class="form-group pull-right">
                    <button type="button" onclick="hiddenTopicCommentReplyBox({{ $comment->id }})" class="btn btn-secondary">取消</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </form>
        </div>

        <div class="clearfix"></div>

        <form onsubmit="replyTopicComment(event)" method="post" class="d-block d-md-none form-topic-reply-box" id="m-form-topic-reply-{{ $comment->id }}">
            <hr class="mt-4">
            <input type="hidden" name="parent_id">
            <div class="form-group">
                <textarea name="content" class="form-control" placeholder="输入你的回复内容"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-secondary">提交</button>
                <button type="button" onclick="hiddenTopicCommentReplyBox({{ $comment->id }}, 'mobile')" class="btn btn-block btn-light">取消</button>
            </div>
        </form>
    </div>
</div>
