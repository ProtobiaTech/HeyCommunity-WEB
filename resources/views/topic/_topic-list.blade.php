@if ($topics->count())
    <div id="component-topic-list" class="list-group">
        @foreach ($topics as $topic)
            <div class="list-group-item m-nb-y m-nb-r">
                <a class="avatar" href="{{ route('user.uhome', $topic->author->id) }}"><img class="avatar" src="{{ asset($topic->author->avatar) }}"></a>
                <div class="pull-left body">
                    <div class="title">
                        <span class="info d-none d-sm-inline-block text-muted">
                            {{ $topic->thumb_up_num }} &nbsp; / &nbsp; {{ $topic->comment_num }} &nbsp; / &nbsp; {{ $topic->read_num }}
                            &nbsp;&nbsp;&nbsp; {{ $topic->created_at->format('m-d') }}
                        </span>
                        <a href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a>
                    </div>

                    <div class="content">
                        {{ mb_substr(strip_tags($topic->content), 0, 150) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav id="section-pagination">
        {{ $topics->links() }}
    </nav>
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif
