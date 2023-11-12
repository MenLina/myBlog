@extends('layouts.app')

@section('title-block')
    {{ $post->title }}
@endsection

@section('content')
    <a href="{{ route('home') }}">Back to home</a>
    <h1 class="ml-5">{{ $post->title }}</h1>
    <a class="ml-5" href="#">tag: {{ $post->tag }}</a>
    <div class="container">
        <div class="d-flex mt-5 border-1">
            <img src="{{ asset('images/' . $post->image) }}" alt="Изображение поста" width="250" height="400">
            <div style="max-width: 600px; word-wrap: break-word;">
                <p style="white-space: normal !important;">{{ $post->content }}</p>
            </div>
        </div>
    </div>
    <p>Author: {{ $post->user->name}}</p>
    <div class="container mt-5">
        <h2>Comments:</h2>
        @foreach($post->comments as $comment)
            <p>
                Author: {{ $comment->author }}<br>
                Content: {{ $comment->content }}<br>
                Created At: {{ $comment->created_at }}<br>
            </p>
            <hr>
        @endforeach

        <form action="{{ route('commentsStore') }}" method="post">
            @csrf
            @auth
                <p>Здравствуйте, {{ auth()->user()->name }}!</p>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            @else
                <p>Гость</p>
                <input type="hidden" name="user_id" value="0">
            @endauth

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="form-group">
                <label for="comment">Ваш комментарий:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Оставить комментарий</button>
        </form>
    </div>
@endsection
