@extends('layouts.app')

@section('title-block')
    Comments
@endsection

@section('content')
<div class="row"></div>
<h1>comments</h1>
@if (Auth::check() && Auth::user()->role === 'admin')
    <p>
        <a class="btn btn-info" href="{{route('yourPosts')}}">Your posts</a>
    </p>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>name</th>
                <th>content</th>
                <th>status</th>
                <th>post</th>
                <th>created at</th>
                <th>publish</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->status }}</td>
                    <td> <a  href="{{route('viewPost', $comment->post_id)}}">/viewPost/{{$comment->post_id}}</a></td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <form action="{{ route('commentsPublish', $comment->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-info">
                                {{ $comment->status === 'published' ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
