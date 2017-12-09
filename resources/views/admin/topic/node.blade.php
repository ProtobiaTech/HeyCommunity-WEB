@extends('admin.layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-topic-node">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">话题节点管理</h4>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container">
            <div class="well">
                <div class="row">
                    @foreach ($rootNodes as $rnIndex => $rootNode)
                        <div id="section-node-item" class="col-sm-4">
                            <div class="list-group">
                                <div class="list-group-item active">
                                    <span class="text-muted">#{{ $rnIndex + 1 }}</span> {{ $rootNode->name }}
                                    <div class="pull-right section-editbox disnone">
                                        <button onclick="nodeDestroy('{{ $rootNode->name }}', {{ $rootNode->id }})" class="btn btn-danger btn-xs">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                        &nbsp;&nbsp;

                                        <button onclick="nodeToLeft({{ $rootNode->id }})" class="btn btn-default btn-xs" {{ $rnIndex === 0 ? 'disabled' : '' }}>
                                            <i class="glyphicon glyphicon-arrow-left"></i>
                                        </button>
                                        <button onclick="nodeToRight({{ $rootNode->id }})" class="btn btn-default btn-xs" {{ $rnIndex === $rootNodes->count() - 1 ? 'disabled' : '' }}>
                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                        </button>
                                        <button onclick="nodeRenamePretreatment(1, '默认')" data-toggle="modal" data-target="#nodeRenameModal" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </div>
                                </div>

                                @foreach ($rootNode->children as $index => $node)
                                    <div class="list-group-item">
                                        {{ $node->name }}
                                        <div class="pull-right section-editbox disnone">
                                            <button onclick="nodeDestroy('{{ $node->name }}', {{ $node->id }})" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                                            &nbsp;&nbsp;

                                            <button onclick="nodeToLeft({{ $node->id }})" class="btn btn-default btn-xs" {{ $index === 0 ? 'disabled' : '' }}>
                                                <i class="glyphicon glyphicon-arrow-up"></i>
                                            </button>
                                            <button onclick="nodeToRight({{ $node->id }})" class="btn btn-default btn-xs" {{ $index === $rootNode->children->count() - 1 ? 'disabled' : '' }}>
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </button>
                                            <button onclick="nodeRenamePretreatment(2, '默认1')" data-toggle="modal" data-target="#nodeRenameModal" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * node to left
         */
        function nodeToLeft(nodeId) {
            var url = '{{ route('admin.topic.node.to-left') }}';
            postSubmit(url, {id: nodeId});
        }

        /**
         * node to right
         */
        function nodeToRight(nodeId) {
            var url = '{{ route('admin.topic.node.to-right') }}';
            postSubmit(url, {id: nodeId});
        }

        /**
         * node destroy
         */
        function nodeDestroy(name, nodeId) {
            var message = '是否要删除 ' + name + ' 节点';

            if (confirm(message)) {
                var url = '{{ route('admin.topic.node.destroy') }}';
                postSubmit(url, {id: nodeId});
            }
        }
    </script>
</div>
@stop
