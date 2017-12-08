<div class="list-group">
    <a href="{{ route('user.ucenter.my-timelines') }}" class="{{ setNavActive(['*my-timelines', '*ucenter']) }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的动态</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>

<br>
<div class="list-group">
    <a href="{{ route('user.ucenter.my-topics') }}" class="{{ setNavActive('*my-topics') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的话题</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
    <a href="{{ route('user.ucenter.my-topic-comments') }}" class="{{ setNavActive('*my-topic-comments') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我的评论</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>

<br>
<div class="list-group">
    <a href="{{ route('user.ucenter.my-activities') }}" class="{{ setNavActive('*my-activities') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我发起的活动</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
    <a href="{{ route('user.ucenter.my-activity-signups') }}" class="{{ setNavActive('*my-activity-signups') }} list-group-item list-group-item-action d-flex justify-content-between">
        <span>我参加的活动</span>
        <span class="icon icon-chevron-thin-right"></span>
    </a>
</div>
