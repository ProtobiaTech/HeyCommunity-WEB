<div class="d-none d-md-block">
    <div class="list-group">
        <a href="{{ route('site.about') }}" class="{{ setNavActive('*about') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>关于</span>
            <span class="icon icon-chevron-thin-right"></span>
        </a>

        <a href="{{ route('site.help') }}" class="{{ setNavActive('*help') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>帮助</span>
            <span class="icon icon-chevron-thin-right"></span>
        </a>

        <a href="{{ route('site.terms') }}" class="{{ setNavActive('*terms') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>用户协议</span>
            <span class="icon icon-chevron-thin-right"></span>
        </a>

        <a href="{{ route('site.privacy') }}" class="{{ setNavActive('*privacy') }} list-group-item list-group-item-action d-flex justify-content-between">
            <span>隐私政策</span>
            <span class="icon icon-chevron-thin-right"></span>
        </a>
    </div>
</div>


<div class="d-block d-md-none mb-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*about') }}" href="{{ route('site.about') }}">关于</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*help') }}" href="{{ route('site.help') }}">帮助</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*terms') }}" href="{{ route('site.terms') }}">用户协议</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setNavActive('*privacy') }}" href="{{ route('site.privacy') }}">隐私政策</a>
        </li>
    </ul>
</div>


<div class="d-none d-md-block mt-4">
    @include('layouts._tail')
</div>