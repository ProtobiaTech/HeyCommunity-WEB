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
