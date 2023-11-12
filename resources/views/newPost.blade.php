@extends('layouts.app')

@section('title-block')
    New post
@endsection

@section('content')
    <h1>new post</h1>
    @if (Auth::check() && Auth::user()->role === 'admin')
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

            <p>
                <label for="is_temporary">Temporary Post:</label>
                <input type="checkbox" name="is_temporary" id="is_temporary">
                <div id="temp_post_options" style="display:none;">
                    <label for="expiration_time">Expiration Time:</label>
                    <input type="datetime-local" name="expiration_time" id="expiration_time">
                </div>
            <label for="post_duration">Post Duration:</label>
            <select name="post_duration" id="post_duration">
                <option value="1">1 час</option>
                <option value="3">3 часа</option>
                <option value="6">6 часов</option>
                <option value="12">12 часов</option>
                <option value="24">1 день</option>
                <option value="48">2 дня</option>
            </select>
            </p>
            <div>
                <button class="btn btn-success" type="submit" name="action" value="newPost">New post</button>
                <button class="btn btn-info" type="submit" name="action" value="save">Save</button>
                <button class="btn btn-danger" type="submit" name="action" value="exit">Exit</button>
            </div>
        </div>
    </form>
    @endif
@endsection

