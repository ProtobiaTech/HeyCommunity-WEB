@extends('layouts.default')

@section('title')
更新活动 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-activity-create">
        <div class="container pt-4 pb-5">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">更新活动</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 col-lg-4 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            在这里发起一个有趣有意义的活动，邀请大家来参加 ~
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 m-np">
                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            <h5 class="card-title">更新活动</h5>
                            <hr>

                            <form action="{{ route('activity.update', $activity->id) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="input-title" class="col-sm-2 col-form-label">标题</label>
                                    <div class="col-sm-10">
                                        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', $activity->title) }}">

                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-avatar" class="col-sm-2 col-form-label">封面</label>
                                    <div class="col-sm-10">
                                        <input name="avatar" type="file" class="form-control" id="input-avatar" value="{{ old('avatar', $activity->avatar) }}">

                                        <div class="text-danger">{{ $errors->first('avatar') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-intro" class="col-sm-2 col-form-label">介绍</label>
                                    <div class="col-sm-10">
                                        <textarea name="intro" class="form-control" id="input-intro" rows="3">{{ old('intro', $activity->intro) }}</textarea>

                                        <div class="text-danger">{{ $errors->first('intro') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="input-content" class="col-sm-2 col-form-label">内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content', $activity->content) }}</textarea>

                                        <div class="text-danger">{{ $errors->first('content') }}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary btn-block" type="submit">保存</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 d-block d-md-none mt-3 m-np">
                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            在这里发起一个有趣有意义的活动，邀请大家来参加 ~
                        </div>
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
