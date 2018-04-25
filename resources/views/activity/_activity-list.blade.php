@if ($activities->count())
    <div class="row">
        @foreach ($activities as $item)
            <div class="col-md-3 m-np">
                <div id="component-activity-card" class="card card-activity">
                    <a class="box-pic" href="{{ route('activity.show', $item->id) }}">
                        <div class="start-time">
                            <i class="fa fa-calendar"></i>&nbsp; {{ $item->start_time }}
                        </div>
                        <img class="card-img-top m-nb-r" src="{{ asset($item->avatar) }}" alt="{{ $item->title }}">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('activity.show', $item->id) }}">{{ $item->title }}</a></h4>
                        <p class="card-text">{{ $item->intro }}</p>
                        <!--
                        <a href="{{ route('activity.show', $item->id) }}" class="btn btn-primary">立即报名</a>
                        -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav id="section-pagination">
        {{ $activities->links() }}
    </nav>
@else
    <div class="card">
        <div class="card-body">
            暂无数据
        </div>
    </div>
@endif
