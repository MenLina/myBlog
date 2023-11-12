@extends('layouts.app')

@section('title-block')
    Home
@endsection

@section('content')
    <h1>Home</h1>
    @if (Auth::check() && Auth::user()->role === 'admin')
        <a class="btn btn-info" href="{{route('newPost')}}">New post</a>
        <a class="btn btn-success" href="{{route('yourPosts')}}">Your posts</a>
    @endif
    <a href="{{route('tagCloud')}}">Tag cloud</a>
    <div class="container">
        <h1 >what`s interesting:</h1>
        <ul style="list-style-type: none; padding-left: 0">
            @foreach($posts as $post)
                <hr>
                <div class="d-flex mt-5 border-1" style=" max-width: 740px;">
                    <img src="{{ 'images' . '/' . ($post->image) }}" alt="Изображение поста" width="300">
                    <div style="max-width: 440px;word-wrap: break-word;">
                        <li style="font-size: 30px;"><a class="ml-5" style="color: black;" href="{{ route('viewPost', ['id' => $post->id]) }}">title: {{ $post->title }}</a></li>
                        <a class="ml-5" href="{{ route('tagPosts', ['tag' => $post->tag]) }}">tag: {{ $post->tag }}</a>
                        <p class="ml-5">Author: {{ $post->user->name}}</p>
                        <p class="ml-5" style="white-space: normal !important; ">{!! Str::limit($post->content, 200) !!}<a href="{{ route('viewPost', ['id' => $post->id]) }}">more</a></p>
                    </div>
                </div>
            @endforeach
        </ul>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

@section('aside')
    @parent
    <p>additional text</p>
@endsection
