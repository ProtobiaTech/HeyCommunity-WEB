@extends('layouts.default')

@section('mainBody')
<div id="section-mainbody" class="page-activity-index">
    @include('activity._carousel', ['elementId' => 'section-carousel-top'])

    <div class="container pt-4 pb-5">
        @include('activity._carousel', ['elementId' => 'section-carousel'])

        <!-- Activity List -->
        @include('activity._activity_list', ['activities' => $activities])
    </div>
</div>
@stop
