@extends('layouts.app')

@section('title-block')
    Home
@endsection

@section('content')
    <h1>Home</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto beatae distinctio doloremque ex ipsa iure magnam quaerat quas voluptate voluptatum. Aliquid consequuntur doloremque nemo odit, officiis omnis quae quos soluta.
    </p>
@endsection

@section('aside')
    @parent
    <p>additional text</p>
@endsection
