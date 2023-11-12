@extends('layouts.app')

@section('title-block')
    Edit post
@endsection

@section('content')
    <h1>Edit post</h1>
    <form method="POST" action="{{ route('updatePost', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="container d-flex flex-column">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" required>

            <label for="tag">Tag</label>
            <input type="text" name="tag" value="{{ $post->tag }}">

            <label for="content">Content</label>
            <textarea name="content" required>{{ $post->content }}</textarea>

            <label for="image">Image</label>
            <input type="file" name="newImage">

            <div class="d-flex align-items-center">
                <input type="checkbox" name="deleteImage" id="deleteImage" value="1" {{ old('deleteImage', false) ? 'checked' : '' }}>
                <label class="ml-0 m-3" for="deleteImage">Удалить изображение</label>
            </div>
            <button type="submit" class="btn btn-success">Update Post</button>
        </div>
    </form>
@endsection
