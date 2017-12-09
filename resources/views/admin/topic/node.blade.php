@extends('admin.layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-topic-node">
    <div class="">
        <div class="page-header-title">
            <div class="pull-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal-create-node">
                    <i class="fa fa-plus">&nbsp;</i>
                    创建节点
                </button>
            </div>
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
                                        <button {{ $rootNode->children->count() ? 'disabled' : '' }} onclick="nodeDestroy('{{ $rootNode->name }}', {{ $rootNode->id }})" class="btn btn-danger btn-xs">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                        &nbsp;&nbsp;

                                        <button onclick="nodeToLeft({{ $rootNode->id }})" class="btn btn-default btn-xs" {{ $rnIndex === 0 ? 'disabled' : '' }}>
                                            <i class="glyphicon glyphicon-arrow-left"></i>
                                        </button>
                                        <button onclick="nodeToRight({{ $rootNode->id }})" class="btn btn-default btn-xs" {{ $rnIndex === $rootNodes->count() - 1 ? 'disabled' : '' }}>
                                            <i class="glyphicon glyphicon-arrow-right"></i>
                                        </button>
                                        <button onclick="nodeUpdate('{{ $rootNode->name }}', {{ $rootNode->id }}, '{{ $rootNode->description }}')" data-toggle="modal" data-target="#modal-update-node" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
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
                                            <button onclick="nodeUpdate('{{ $node->name }}', {{ $node->id }}, '{{ $node->description }}', '{{ $node->parent_id }}')" data-toggle="modal" data-target="#modal-update-node" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
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


    <!-- update node modal -->
    <div id="modal-update-node" class="modal fade in" tabindex="-1" role="dialog" style="margin-top:120px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('admin.topic.node.update') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="id">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">更新节点</h4>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="form-group form-group-parent_id">
                            <label for="input-parent_id" class="col-sm-3 control-label">父节点</label>
                            <div class="col-sm-7">
                                <select name="parent_id" class="form-control">
                                    <option value="0">根节点</option>
                                    @foreach ($rootNodes as $rootNode)
                                        <option value="{{ $rootNode->id }}">{{ $rootNode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-7">
                                <input name="name" type="text" class="form-control" id="input-name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="col-sm-3 control-label">描述</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- create node modal -->
    <div id="modal-create-node" class="modal fade in" tabindex="-1" role="dialog" style="margin-top:120px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('admin.topic.node.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">创建节点</h4>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="form-group ">
                            <label for="input-parend_id" class="col-sm-3 control-label">父节点</label>
                            <div class="col-sm-7">
                                <select name="parent_id" class="form-control">
                                    <option value="0">根节点</option>
                                    @foreach ($rootNodes as $rootNode)
                                        <option value="{{ $rootNode->id }}">{{ $rootNode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-7">
                                <input name="name" type="text" class="form-control" id="input-name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="col-sm-3 control-label">描述</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">提交</button>
                    </div>
                </form>
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

        /**
         * node update
         */
        function nodeUpdate(name, nodeId, description, parentId) {
            var modal = $('#modal-update-node');

            if (!parentId) {
                modal.find('.form-group-parent_id').hide();
                modal.find('select[name="parent_id"]').val(null)
            } else {
                modal.find('option[value="' + parentId+ '"]').attr('selected', 'selected')
            }

            modal.find('input[name="id"]').val(nodeId)
            modal.find('input[name="name"]').val(name)
            modal.find('textarea[name="description"]').val(description)
        }
    </script>
</div>
@stop
