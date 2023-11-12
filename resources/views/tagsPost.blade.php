@extends('layouts.app')

@section('title-block')
    Posts by Tag
@endsection

@section('content')
    <div class="container">
        <h1 >what`s interesting:</h1>
        <a href="{{ route('home') }}">Back to home</a>
        <ul style="list-style-type: none; padding-left: 0">
            @foreach($posts as $post)
                <hr>
                <div class="d-flex mt-5 border-1" style=" max-width: 740px;">
                    <img src="{{  '/' . 'images' . '/' . ($post->image) }}" alt="Изображение поста" width="300">
                    <div style="max-width: 440px;word-wrap: break-word;">
                        <li style="font-size: 30px;"><a class="ml-5" style="color: black;" href="{{ route('viewPost', ['id' => $post->id]) }}">title: {{ $post->title }}</a></li>
                        <a class="ml-5" href="{{ route('tagPosts', ['tag' => $post->tag]) }}">tag: {{ $post->tag }}</a>
                        <p class="ml-5" style="white-space: normal !important; ">{!! Str::limit($post->content, 200) !!}<a href="{{ route('viewPost', ['id' => $post->id]) }}">more</a></p>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>

@endsection
