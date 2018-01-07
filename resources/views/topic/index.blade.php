@extends('layouts.default')

@section('title')
话题 - {{ $system->site_title }}
@endsection

@section('description')
欢迎你在这里分享你知识与见解，或者有什么问题也可以在此与社区的朋友们一起交流讨论 ~
@endsection

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
                                    <a class="childNode {{ setParamActive('node', $node->name) }}" href="{{ route('topic.index', ['node' => $node->name]) }}">{{ $node->name }}</a>
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

            <div id="section-right" class="col-md-9 m-np">
                <div class="right-tools m-p15-x">
                    <a class="btn btn-primary btn-create d-inline-block d-md-none pull-left" href="{{ route('topic.create') }}">发布话题</a>

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

            <div id="section-bottom" class="col-12 d-block d-md-none m-np">
                <div class="div-create-btn m-p15-x">
                    <a href="{{ route('topic.create') }}" class="btn btn-block btn-primary mt-3 mb-3">发起一个新话题</a>
                </div>

                <div class="card card-nodes mb-3 m-nb-r m-nb-y">
                    <div class="card-body">
                        <h6 class="card-title text-center">节点列表</h6>
                        <div class="">
                            @foreach ($rootNodes as $rootNode)
                                <div class="nodes-item">
                                    <a class="rootNode {{ setParamActive('node', $rootNode->name) }}"
                                       href="{{ route('topic.index', ['node' => $rootNode->name]) }}">{{ $rootNode->name }}</a>

                                    @foreach ($rootNode->childNodes as $node)
                                        <a class="childNode {{ setParamActive('node', $node->name) }}" href="{{ route('topic.index', ['node' => $node->name]) }}">{{ $node->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card card-tags mb-3 m-nb-r m-nb-y">
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
