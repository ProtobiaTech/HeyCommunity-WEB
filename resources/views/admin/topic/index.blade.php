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
            <div class="col-sm-6 col-lg-3">
                <div class="panel text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title text-muted font-light">本周话题数量</h4>
                    </div>
                    <div class="panel-body p-t-10">
                        <h2 class="m-t-0 m-b-15"><i class="mdi mdi-arrow-down-bold-circle-outline text-danger m-r-10"></i><b>8952</b></h2>
                        <p class="text-muted m-b-0 m-t-20"><b>48%</b> From Last 24 Hours</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title text-muted font-light">本周评论数量</h4>
                    </div>
                    <div class="panel-body p-t-10">
                        <h2 class="m-t-0 m-b-15"><i class="mdi mdi-arrow-up-bold-circle-outline text-primary m-r-10"></i><b>6521</b></h2>
                        <p class="text-muted m-b-0 m-t-20"><b>42%</b> Orders in Last 10 months</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title text-muted font-light">总话题数量</h4>
                    </div>
                    <div class="panel-body p-t-10">
                        <h2 class="m-t-0 m-b-15"><i class="mdi mdi-arrow-up-bold-circle-outline text-primary m-r-10"></i><b>452</b></h2>
                        <p class="text-muted m-b-0 m-t-20"><b>22%</b> From Last 24 Hours</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title text-muted font-light">总评论数量</h4>
                    </div>
                    <div class="panel-body p-t-10">
                        <h2 class="m-t-0 m-b-15"><i class="mdi mdi-arrow-down-bold-circle-outline text-danger m-r-10"></i><b>5621</b></h2>
                        <p class="text-muted m-b-0 m-t-20"><b>35%</b> From Last 1 Month</p>
                    </div>
                </div>
            </div>
        </div>

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
