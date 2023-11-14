@extends('layouts.app')

@section('title-block')
    New post
@endsection

@section('content')
    <h1>new post</h1>
    @if (Auth::check() && Auth::user()->role === 'Admin')
    <form action="{{route('postForm')}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <label for="title">title</label>
            <input type="text" name="title" placeholder="Enter title of post" id="titlePost" class="form-control" required>

            <label for="tag">tag</label>
            <input type="text" name="tag" placeholder="Enter tag of post" id="tagPost" class="form-control">

            <label for="content">content</label>
            <textarea type="text" name="content" placeholder="Enter post text" id="postText" class="form-control " required></textarea>

            <input class="mb-3 mt-3" type="file" name="filePost">

            <div>
                <button class="btn btn-success" type="submit" name="action" value="newPost">New post</button>
                <button class="btn btn-info" type="submit" name="action" value="save">Save</button>
                <button class="btn btn-danger" type="submit" name="action" value="exit">Exit</button>
            </div>
        </div>
    </form>
    @endif
@endsection

