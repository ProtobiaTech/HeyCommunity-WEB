@extends('layouts.default')

@section('title')
发布一个活动 - {{ $system->site_title }}
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-activity-create">
        <div class="container pt-4">
            <nav id="section-breadcrumb" class="d-none d-md-block" aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">首页</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('activity.index') }}">活动</a></li>
                    <li class="breadcrumb-item active" aria-current="page">发布活动</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-md-4 col-lg-4 d-block d-md-none m-np">
                    <div class="card m-nb-y m-nb-r mb-3">
                        <div class="card-body">
                            在这里发起一个有趣有意义的活动，邀请大家来参加 ~
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            在这里发起一个有趣有意义的活动，邀请大家来参加 ~
                        </div>
                    </div>

                    <div class="mt-3">
                        @include('layouts._tail')
                    </div>
                </div>

                <div class="col-md-8 col-lg-8 m-np">
                    <div class="card m-nb-y m-nb-r">
                        <div class="card-body">
                            <h5 class="card-title">发布一个活动</h5>
                            <hr>

                            <form action="{{ route('activity.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @include('activity._form')

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

                <div class="col-md-4 col-lg-4 d-block d-md-none m-np">
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
