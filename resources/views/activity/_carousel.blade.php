<?php
    if ($elementId == 'section-carousel-top') {
        $carouselClassStr = 'slide d-md-none';
    } else if ($elementId == 'section-carousel') {
        $carouselClassStr = 'slide d-none d-md-block';
    }
?>

<div id="{{ $elementId }}" class="carousel {{ $carouselClassStr }}">
    <ol class="carousel-indicators">
        @foreach ($exhibits as $index =>$item)
            <li data-target="#{{ $elementId }}" data-slide-to="{{ $index }}" class="{{ $index != 0 ?: 'active' }}"></li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach ($exhibits as $index =>$item)
            <div class="carousel-item {{ $index != 0 ?: 'active' }}">
                <img src="{{ $item->avatar }}">

                <div class="carousel-caption">
                    <h3><a href="{{ route('activity.show', $item->id) }}">{{ $item->title }}</a></h3>
                    <p>{{ $item->intro }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#{{ $elementId }}" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#{{ $elementId }}" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

