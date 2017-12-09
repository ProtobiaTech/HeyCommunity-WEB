@extends('layouts.default')

@section('title')
    发起一个话题 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-module-page">
        <div class="container pt-4 pb-5">
            <nav id="section-breadcrumb" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('topic') }}">话题</a></li>
                    <li class="breadcrumb-item active" aria-current="page">发布话题</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            欢迎你在这里分享你知识与见解，或者有什么问题也可以在此与社区的朋友们一起交流讨论 ~ <br><br>

                            但请注意以下几点
                            <ol>
                                <li>
                                    请传播美好的事物，这里拒绝低俗、诋毁、谩骂等相关信息
                                </li>
                                <li>
                                    谢绝发布社会, 政治等相关新闻
                                </li>
                                <li>
                                    这里绝对不讨论任何有关盗版软件、音乐、电影如何获得的问题
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">发起一个话题</h5>
                            <hr>

                            <form action="{{ route('topic.store') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-title" class="col-2 col-form-label">标题</label>
                                    <div class="col-10">
                                        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title') }}">

                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-node" class="col-2 col-form-label">节点</label>
                                    <div class="col-10">
                                        <select name="node_id" class="custom-select form-control">
                                            <option selected>请选择一个节点</option>
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

                                        <div class="text-danger">{{ $errors->first('node_id') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-content" class="col-2 col-form-label">内容</label>
                                    <div class="col-10">
                                        <textarea name="content" class="form-control" id="input-content" rows="8">{{ old('content') }}</textarea>

                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-2"></div>
                                    <div class="col-10">
                                        <button class="btn btn-primary btn-block" type="submit">发布</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
