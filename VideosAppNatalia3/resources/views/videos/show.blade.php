@extends('layouts.VideosAppLayout')

@section('content')
    <h2 class="text-2xl font-bold">{{ $video->title }}</h2>
    <p>{{ $video->description }}</p>
    <a href="{{ $video->url }}" target="_blank">Ver video</a>
@endsection
