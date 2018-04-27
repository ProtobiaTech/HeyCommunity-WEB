@extends('admin.layouts.default')

@section('search')
    <form class="navbar-form pull-left" role="search" action="{{ route('admin.activity.index') }}">
        <div class="form-group">
            <input type="hidden" name="type" value="activity">
            <input type="text" name="q" class="form-control search-bar" placeholder="搜索" value="{{ Request::get('q') }}">
        </div>
        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
    </form>
@endsection

@section('mainBody')
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">活动列表</h4>
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
                                                <th>活动缩略图</th>
                                                <th>标题</th>
                                                <th>TU TB F C R</th>
                                                <th>发布时间</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if ($activities->isEmpty())
                                                <tr>
                                                    <td colspan="5">无数据</td>
                                                </tr>
                                            @else
                                            @foreach ($activities as $activity)
                                                <tr>
                                                    <td>{{ $activity->id }}</td>
                                                    <td><img src="{{ $activity->avatar }}" alt="活动缩略图" style="width: 4rem;height: 4rem;border-radius: 50%;"></td>
                                                    <td><a target="_blank" href="{{ route('news.show', $activity->id) }}">{{ $activity->title }}</a></td>
                                                    <td>
                                                        {{ $activity->thumb_up_num }}
                                                        /
                                                        {{ $activity->thumb_down_num }}
                                                        /
                                                        {{ $activity->favorite_num }}
                                                        /
                                                        {{ $activity->comment_num }}
                                                        /
                                                        {{ $activity->read_num }}
                                                    </td>
                                                    <td>{{ $activity->created_at }}</td>
                                                    <td><a class="btn btn-xs btn-danger" onclick="activityDestroy('{{ $activity->title }}', {{ $activity->id }})" title="删除"><i class="fa fa-trash-o"></i></a></td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <nav id="section-pagination">
                                            {{ $activities->links() }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function activityDestroy(title,id) {
                var message = '是否要删除 "' + title + '"这个活动';

                if (confirm(message)) {
                    var url = '{{ route('admin.activity.destroy') }}';
                    postSubmit(url, {id: id});
                }
            }
        </script>
    </div>
@stop
