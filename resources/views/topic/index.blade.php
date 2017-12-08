@extends('layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-topic-index">
    <div class="container pt-4 pb-5">
        <div class="row">
            <div id="section-left" class="col-md-3">
                <div class="left-tools d-none d-md-block">
                    <a class="btn btn-primary btn-block" href="{{ route('topic.create') }}">发布话题</a>
                </div>

                <div class="card card-nodes d-none d-md-block">
                    <div class="card-body">
                        <h6 class="card-title">节点列表</h6>
                        <div class="">
                            @foreach ($rootNodes as $rootNode)
                            <div class="nodes-item">
                                <a class="rootNode {{ setParamActive('node', $rootNode->name) }}"
                                   href="{{ route('topic.index', ['node' => $rootNode->name]) }}">{{ $rootNode->name }}</a>

                                @foreach ($rootNode->childNodes as $node)
                                <a class="{{ setParamActive('node', $node->name) }}" href="{{ route('topic.index', ['node' => $node->name]) }}">{{ $node->name }}</a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card card-tags d-none d-md-block">
                    <div class="card-body">
                        <h6 class="card-title">我们正在讨论</h6>
                        <div class="tags">
                            <a class="l1">暂不可用</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="section-right" class="col-md-9">
                <div class="right-tools">
                    <a class="btn btn-primary d-inline-block d-md-none pull-left" href="{{ route('topic.create') }}">发布话题</a>

                    <a class="btn btn-secondary {{ setParamActive('filter', 'recent') }}" href="{{ route('topic.index', ['filter' => 'recent']) }}">最近</a>
                    <a class="btn btn-secondary {{ setParamActive('filter', 'hot') }}" href="{{ route('topic.index', ['filter' => 'hot']) }}">最热</a>
                    &nbsp;&nbsp;
                    <a class="btn btn-secondary {{ setParamActive('filter', 'excellent') }}" href="{{ route('topic.index', ['filter' => 'excellent']) }}">精华</a>
                    <a class="btn btn-secondary {{ setParamActive('filter', 'noreply') }}" href="{{ route('topic.index', ['filter' => 'noreply']) }}">零回复</a>

                    <div class="pull-right d-none d-sm-block">
                        <a class="btn btn-secondary" href="{{ route('topic.index', ['filter' => 'default']) }}">刷新</a>
                    </div>
                </div>

                <!-- Topic List -->
                @include('topic._topic-list', ['topics' => $topics])
            </div>

            <div class="col-12 card-nodes d-block d-md-none">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-center">节点列表</h6>
                        <div class="">
                            @foreach ($rootNodes as $rootNode)
                                <div class="nodes-item">
                                    <a class="rootNode {{ setParamActive('node', $rootNode->name) }}"
                                       href="{{ route('topic.index', ['node' => $rootNode->name]) }}">{{ $rootNode->name }}</a>

                                    @foreach ($rootNode->childNodes as $node)
                                        <a class="{{ setParamActive('node', $node->name) }}" href="{{ route('topic.index', ['node' => $node->name]) }}">{{ $node->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-center">我们正在讨论</h6>
                        <div class="tags">
                            <a class="l1">暂不可用</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
