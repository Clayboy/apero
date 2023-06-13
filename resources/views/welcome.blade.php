@extends('layouts.app')


@section('content')
<div class="container mx-auto h-full flex flex-col justify-center">
    <div class="md:flex md:items-stretch md:justify-center">
        <time-widget class="md:w-1/2"></time-widget>
        <weather-widget class="md:w-1/2" :data="{{$weather}}" :lat="lat" :lng="lng">
        </weather-widget>
    </div>
    <div class="text-white text-2xl md:text-4xl text-center mx-2 px-8 py-10 rounded shadow black-transparent">
        {{$decision}}
    </div>
</div>
@endsection


@section('scripts')
    <script>
        window.App = {
            lat : {{$location->lat}},
            lng : {{$location->lng}}
        }
    </script>
@endsection
