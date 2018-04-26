@if ($topicComments->count())
    <div id="component-topic-list" class="list-group">
        @foreach ($topicComments as $topicComment)
            <div class="list-group-item m-nb-y m-nb-r">
                <a class="avatar" href="{{ route('user.uhome', $user->id) }}"><img class="avatar" src="{{ asset($topicComment->topic->author->avatar) }}"></a>
                <div class="pull-left body">
                    <div class="title">
                        <span class="info d-none d-sm-inline-block text-muted">
                            <i class="fa fa-thumbs-o-up"></i> {{ $topicComment->thumb_up_num }}
                            &nbsp; / &nbsp;&nbsp;
                            {{ $topicComment->created_at->format('m-d') }}
                        </span>
                        <a href="{{ route('topic.show', $topicComment->topic->id) }}">{{ $topicComment->topic->title }}</a>
                    </div>

                    <div class="content">
                        {{ mb_substr(strip_tags($topicComment->content), 0, 150) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav id="section-pagination">
        {{ $topicComments->links() }}
    </nav>
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif
