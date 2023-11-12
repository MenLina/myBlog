@extends('layouts.app')

@section('title-block')
    All Tags
@endsection

@section('content')
    <h1>All Tags</h1>
    <ul>
        @foreach($tags as $tag)
            <li><a href="{{ route('tagPosts', ['tag' => $tag->name]) }}">{{ $tag->name }}</a></li>
            (total posts: {{ $tag->frequency }})
        @endforeach
    </ul>
@endsection
