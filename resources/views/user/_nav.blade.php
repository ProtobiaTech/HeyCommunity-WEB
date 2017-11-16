<div class="list-group">
    <a data-toggle="pill" href="#pills-timeline" class="list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的动态</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
    <a data-toggle="pill" href="#pills-topic" class="{{ setNavActive('user/ucenter') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的话题</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
    <a data-toggle="pill" href="#pills-activity" class="list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的活动</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>

<br>
<div class="list-group">
    <a href="{{ route('user.profile') }}" class="{{ setNavActive('user/profile') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>个人资料</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>

<br>
<div class="list-group">
    <a href="{{ route('notification.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between">
        <span>通知</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>
