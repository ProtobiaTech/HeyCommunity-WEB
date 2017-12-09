@extends('admin.layouts.default')

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
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>标题</th>
                                                <th>作者</th>
                                                <th>TU TB F C R</th>
                                                <th>发布时间</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topics as $topic)
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
                                                </tr>
                                            @endforeach
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
