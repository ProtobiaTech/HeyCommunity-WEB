@extends('layouts.default')

@section('title')
新闻资讯 - {{ $system->site_title }}
@endsection

@section('description')
实时的新闻与资讯
@endsection

@section('mainBody')
    <div id="section-mainbody" class="page-news-index">
        <div class="container pt-2 pb-5">
            <div class="row">
                @foreach ($news as $index => $item)
                    <div class="col-md-3 mt-4 m-np">
                        <div class="card">
                            @if ($item->avatar)
                                <a href="{{ route('news.show', $item->id) }}"><img class="card-img-top" src="{{ $item->avatar }}"></a>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></h5>
                                    <p class="card-text">{{ str_limit(strip_tags($item->content), 60) }}</p>
                                </div>
                            @else
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a></h5>
                                    <p class="card-text">{{ str_limit(strip_tags($item->content), 200) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

                @if ($news->count() == 0)
                    <div class="col mt-4 m-np">
                        <div class="card">
                            <div class="card-body">
                                暂无数据
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            <nav id="section-pagination">
                {{ $news->links() }}
            </nav>
        </div>
    </div>

    <script src="{{ asset('bower-assets/masonry-layout/dist/masonry.pkgd.min.js') }}"></script>
    <script>$('.row').masonry({itemSelector: '.col-md-3'})</script>
@stop
