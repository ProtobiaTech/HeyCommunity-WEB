<?php
    if ($elementId == 'section-carousel-top') {
        $carouselClassStr = 'slide d-md-none';
    } else if ($elementId == 'section-carousel') {
        $carouselClassStr = 'slide d-none d-md-block';
    }
?>

<div id="{{ $elementId }}" class="carousel {{ $carouselClassStr }}" data-ride="carousel" style="background-color:#ddd;">
    <div class="carousel-inner">
        @foreach ($exhibits as $index =>$item)
            <div class="carousel-item {{ $index != 0 ?: 'active' }}">
                <img src="{{ $item->avatar }}" style="width:100%">

                <div class="carousel-caption d-none d-md-block">
                    <h3>{{ $item->title }}</h3>
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

