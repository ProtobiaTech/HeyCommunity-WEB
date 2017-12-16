<div class="d-none d-md-block">
    <!--
    <div class="list-group">
        <a href="{{ route('user.ucenter.my-timelines') }}" class="{{ setNavActive(['*my-timelines', '*ucenter']) }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>我的动态</span>
            <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>
    <br>
    -->

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

    <!--
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
    -->
</div>

<div class="d-block d-md-none mb-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ setNavActive(['*my-timelines', '*ucenter']) }}" href="{{ route('user.ucenter.my-timelines') }}">我的动态</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*my-topics') }}" href="{{ route('user.ucenter.my-topics') }}">我的话题</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*my-topic-comments') }}" href="{{ route('user.ucenter.my-topic-comments') }}">我评论的话题</a>
        </li>
    </ul>
</div>
