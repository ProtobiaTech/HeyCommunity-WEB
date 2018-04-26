@extends('layouts.default')

@section('title')
发起一个话题 - {{ $system->site_title }}
@endsection

@section('description')
欢迎你在这里分享你知识与见解，或者有什么问题也可以在此与社区的朋友们一起交流讨论 ~
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-topic-create">
        <div class="container pt-4">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('topic') }}">话题</a></li>
                    <li class="breadcrumb-item active" aria-current="page">发布话题</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-4 d-block d-md-none m-np">
                    <div class="card m-nb-y m-nb-r mb-3">
                        <div class="card-body">
                            欢迎你在这里分享你知识与见解，或者有什么问题也可以在此与社区的朋友们一起交流讨论 ~
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            欢迎你在这里分享你知识与见解，或者有什么问题也可以在此与社区的朋友们一起交流讨论 ~
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 m-np">
                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            <h5 class="card-title">发起一个新话题</h5>
                            <hr>

                            <form action="{{ route('topic.store') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">标题</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title') }}">

                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-node" class="col-sm-2 col-form-label">节点</label>
                                    <div class="col-sm-10">
                                        <select name="node_id" class="custom-select form-control">
                                            @foreach ($rootNodes as $rootNode)
                                                <optgroup label="{{ $rootNode->name }}">
                                                    @foreach ($rootNode->childNodes as $node)
                                                        <option value="{{ $node->id }}" {{ $node->id == old('node_id') ? 'selected' : '' }}>
                                                            {{ $node->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>

                                        <div class="text-danger">{{ $errors->has('node_id') ? '请选择一个节点' : '' }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-content" class="col-sm-2 col-form-label">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content') }}</textarea>

                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary btn-block" type="submit">发布</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-4 d-block d-md-none m-np">
                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/simditor/simditor-fullscreen.css') }}" />
    <script type="text/javascript" src="{{ asset('assets/simditor/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/simditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/simditor/simditor-fullscreen.js') }}"></script>
    <script>
        var editor = new Simditor({
            textarea: $('.simditor-editor'),
            toolbar: ['title', 'bold', 'italic', 'underline', 'ol', 'ul', 'hr', 'indent', 'blockquote', 'link', 'image', 'fullscreen'],
            pasteImage: true,
            cleanPaste: true,
            upload: {
                url: '{{ route('upload.simditor-upload-images') }}',
                params: {
                    _token: '{{ csrf_token() }}',
                },
                fileKey: 'files',
                connectionCount: 3,
                leaveConfirm: '图片正在上传，你确定要离开？'
            },
        });
    </script>
@endsection
