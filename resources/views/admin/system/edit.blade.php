@extends('admin.layouts.default')

@section('mainBody')
<div class="">
<div class="page-header-title">
    <h4 class="page-title">系统配置</h4>
</div>
</div>

<div class="page-content-wrapper ">

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body p-t-10">
                    <h4 class="m-b-30 m-t-0"></h4>

                    <form class="form-horizontal" action="{{ route('admin.system.update') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="input-site-title" class="col-sm-2 control-label">站点标题</label>
                            <div class="col-sm-10">
                                <input name="site_title" type="text" class="form-control" id="input-site-title" value="{{ old('site_title', $system->site_title) }}">
                                <div class="text-danger">{{ $errors->first('site_title') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-site-subheading" class="col-sm-2 control-label">站点副标题</label>
                            <div class="col-sm-10">
                                <input name="site_subheading" type="text" class="form-control" id="input-site-subheading" value="{{ old('site_subheading', $system->site_subheading) }}">
                                <div class="text-danger">{{ $errors->first('site_subheading') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-site-keywords" class="col-sm-2 control-label">站点关键字</label>
                            <div class="col-sm-10">
                                <input name="site_keywords" type="text" class="form-control" id="input-site-keywords" value="{{ old('site_keywords', $system->site_keywords) }}">
                                <div class="text-danger">{{ $errors->first('site_keywords') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-site-description" class="col-sm-2 control-label">站点描述</label>
                            <div class="col-sm-10">
                                <textarea name="site_description" rows="3" class="form-control" id="input-site-description">{{ old('site_description', $system->site_description) }}</textarea>
                                <div class="text-danger">{{ $errors->first('site_description') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-site-analytic-code" class="col-sm-2 control-label">站点统计代码</label>
                            <div class="col-sm-10">
                                <textarea name="site_analytic_code" rows="6" class="form-control" id="input-site-analytic-code">{{ old('site_analytic_code', $system->site_analytic_code) }}</textarea>
                                <div class="text-danger">{{ $errors->first('site_analytic_code') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default btn-block">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- container -->


</div> <!-- Page content Wrapper -->
@stop
