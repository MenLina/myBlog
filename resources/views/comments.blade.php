@extends('layouts.app')

@section('title-block')
    Your posts
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

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endif
@endsection
