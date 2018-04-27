@extends('admin.layouts.default')

@section('search')
    <form class="navbar-form pull-left" role="search" action="{{ route('admin.topic.index') }}">
        <div class="form-group">
            <input type="hidden" name="type" value="topics">
            <input type="text" name="q" class="form-control search-bar" placeholder="搜索" value="{{ Request::get('q') }}">
        </div>
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>
@endsection

@section('mainBody')
<div class="">
    <div class="page-header-title">
        <h4 class="page-title">话题列表</h4>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" id="section-datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>标题</th>
                                                <th>作者</th>
                                                <th>TU TB F C R</th>
                                                <th>发布时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($topics->isEmpty())
                                            <tr>
                                                <td colspan="5">无数据</td>
                                            </tr>
                                        @else
                                            @foreach ($topics as $topic)
                                                <tr>
                                                    <td>{{ $topic->id }}</td>
                                                    <td><a target="_blank" href="{{ route('topic.show', $topic->id) }}">{{ $topic->title }}</a></td>
                                                    <td>{{ $topic->author->nickname }}</td>
                                                    <td>
                                                        {{ $topic->thumb_up_num }}
                                                        /
                                                        {{ $topic->thumb_down_num }}
                                                        /
                                                        {{ $topic->favorite_num }}
                                                        /
                                                        {{ $topic->comment_num }}
                                                        /
                                                        {{ $topic->read_num }}
                                                    </td>
                                                    <td>{{ $topic->created_at }}</td>
                                                    <td><a class="btn btn-xs btn-danger" onclick="topicDestroy('{{ $topic->title }}', {{ $topic->id }})" title="删除"><i class="fa fa-trash-o"></i></a></td>

                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <nav id="section-pagination">
                                        {{ $topics->links() }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
