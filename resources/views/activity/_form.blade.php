@php
if (!isset($activity)) {
    $activity = null;
}
@endphp

<div class="form-group row">
    <label for="input-title" class="col-sm-2 col-form-label">活动标题</label>
    <div class="col-sm-10">
        <input name="title" type="text" class="form-control" id="input-title" value="{{ old('title', formValue($activity, 'title')) }}">

        <div class="text-danger">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">活动时间</label>
    <div class="col-sm-5">
        <input name="start_time" type="text" class="form-control" id="input-start_time" value="{{ old('start_time', formValue($activity, 'start_time')) }}" placeholder="开始时间">

        <div class="text-danger">{{ $errors->first('start_time') }}</div>
    </div>
    <div class="col-sm-5">
        <input name="end_time" type="text" class="form-control" id="input-end_time" value="{{ old('end_time', formValue($activity, 'end_time')) }}" placeholder="结束时间">

        <div class="text-danger">{{ $errors->first('end_time') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-local" class="col-sm-2 col-form-label">活动地点</label>
    <div class="col-sm-10">
        <input name="local" type="text" class="form-control" id="input-local" value="{{ old('local', formValue($activity, 'local')) }}">

        <div class="text-danger">{{ $errors->first('local') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-avatar" class="col-sm-2 col-form-label">活动封面</label>
    <div class="col-sm-10">
        <input name="avatar" type="file" class="form-control" id="input-avatar" value="{{ old('avatar', formValue($activity, 'avatar')) }}">

        <div class="text-danger">{{ $errors->first('avatar') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-redirect_url" class="col-sm-2 col-form-label">报名&详情页</label>
    <div class="col-sm-10">
        <input name="redirect_url" type="text" class="form-control" id="input-redirect_url" value="{{ old('redirect_url', formValue($activity, 'redirect_url')) }}">

        <div class="text-danger">{{ $errors->first('redirect_url') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-intro" class="col-sm-2 col-form-label">活动介绍</label>
    <div class="col-sm-10">
        <textarea name="intro" class="form-control" id="input-intro" rows="3">{{ old('intro', formValue($activity, 'intro')) }}</textarea>

        <div class="text-danger">{{ $errors->first('intro') }}</div>
    </div>
</div>

<div class="form-group row">
    <label for="input-content" class="col-sm-2 col-form-label">活动详情</label>
    <div class="col-sm-10">
        <textarea name="content" class="form-control simditor-editor" id="input-content" rows="8">{{ old('content', formValue($activity, 'content')) }}</textarea>

        <div class="text-danger">{{ $errors->first('content') }}</div>
    </div>
</div>
