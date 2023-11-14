@extends('layouts.app')

@section('title-block')
    Your posts
@endsection

@section('content')
    <div class="row"></div>
    <h1>Your posts</h1>
    @if (Auth::check() && Auth::user()->role === 'Admin')
        <p>
            <a class="btn btn-success" href="{{route('newPost')}}">New post</a>
            <a class="btn btn-info" href="{{route('comments')}}">Comments</a>
        </p>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>title</th>
                    <th>tag</th>
                    <th>content</th>
                    <th>image</th>
                    <th>status</th>
                    <th>created at</th>
                    <th>updated at</th>
                    <th>publish</th>
                    <th>option</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->tag }}</td>
                            <td style="max-width: 200px;word-wrap: break-word;">{!! Str::limit($post->content, 200) !!}</td>
                            <td><img src="{{ 'images' . '/' . ($post->image) }}" alt="Изображение поста" width="100"></td>
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>
                                @if ($post->status === 'Draft')
                                <form method="POST" action="{{ route('publishPost', $post->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Publish</button>
                                </form>
                                @elseif($post->status === 'Published')
                                    <form method="POST" action="{{ route('unpublishPost', $post->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Unpublish</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if( $post->status === 'Published')
                                    <form method="POST" action="{{ route('archivePost', $post->id) }}" style="display: inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-info">Archive</button>
                                    </form>
                                @elseif ($post->status === 'Archive' ||$post->status === 'Draft' )
                                    <a class="btn btn-info" href="{{route('viewPost', $post->id)}}">View</a>
                                @endif
                            </td>
                            <td>
                                @if($post->status === 'Published')
                                    <a class="btn btn-info" href="{{route('viewPost', $post->id)}}">View</a>
                                @elseif($post->status === 'Draft')
                                <a href="{{ route('editPost', $post->id) }}" class="btn btn-primary">Edit</a>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('deletePost', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
