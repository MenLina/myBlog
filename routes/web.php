<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\postController@showPostsHome')->name('home');
Route::get('/home','App\Http\Controllers\postController@showPostsHome')->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login/submit', 'App\Http\Controllers\loginController@submit')->name('userForm');
Auth::routes();

Route::get('/newPost', function(){
    return view('newPost');
})->name('newPost');

Route::get('/postForm', 'App\Http\Controllers\postController@showForm')->name('postForm');
Route::post('/postForm', 'App\Http\Controllers\PostController@store')->name('storePost');
Route::get('/yourPosts', 'App\Http\Controllers\adminController@showUserPosts')->name('yourPosts');
Route::get('/editPost/{id}', 'App\Http\Controllers\AdminController@editPost')->name('editPost');
Route::patch('/post/{id}', 'App\Http\Controllers\AdminController@updatePost')->name('updatePost');
Route::delete('/deletePost/{id}', 'App\Http\Controllers\AdminController@deletePost')->name('deletePost');
Route::post('/publishPost/{id}', 'App\Http\Controllers\AdminController@publishPost')->name('publishPost');
Route::post('/unpublishPost/{id}', 'App\Http\Controllers\adminController@unpublishPost')->name('unpublishPost');
Route::post('/archive/{id}', 'App\Http\Controllers\adminController@archivePost')->name('archivePost');
Route::get('/viewPost/{id}','App\Http\Controllers\postController@viewPost' )->name('viewPost');
//Route::get('/viewPost/{id}','App\Http\Controllers\postController@showComments' )->name('viewPost');

Route::get('/tag/{tag}', 'App\Http\Controllers\postController@showPostsByTag')->name('tagPosts');
Route::get('/tagCloud' , 'App\Http\Controllers\postController@allTags')->name('tagCloud');

Route::post('/comments/store', 'App\Http\Controllers\postController@commentsStore')->name('commentsStore');
Route::get('/comments', 'App\Http\Controllers\adminController@indexComments')->name('comments');
Route::put('/comments/publish/{comment}', 'App\Http\Controllers\adminController@publishComment')->name('commentsPublish');
Route::delete('/comments/delete/{comment}', 'App\Http\Controllers\adminController@deleteComment')->name('admin.comments.delete');

Route::post('/toggle-theme', 'App\Http\Controllers\postController@setTheme')->name('toggle-theme');
