<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\tbl_comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\tbl_tag;

use Illuminate\Http\Request;

class adminController extends Controller
{
    //Показывает посты текущего авторизованного админа
    public function showUserPosts()
    {
        $user = Auth::user(); // Получите текущего авторизованного пользователя
        if (Auth::check() && Auth::user()->role === 'admin') {

            $posts = Post::where('author_id', $user->id)->orderBy('created_at', 'desc')->get();
            return view('yourPosts', ['posts' => $posts]);
        } else {
            return redirect('home');
        }
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('editPost', ['post' => $post]);
    }
//Функция редактирования поста
    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->tag = $request->input('tag');
        $post->content = $request->input('content');

        // Проверяем, было ли выбрано удаление изображения
        if ($request->input('deleteImage')) {
            // Удаляем изображение из диска
            if ($post->image !== 'default.jpg') {
                File::delete(public_path($post->image));
            }
            $post->image = 'default.jpg'; // Заменяем на дефолтное изображение
        }

        // Проверяем, было ли выбрано новое изображение
        if ($request->hasFile('newImage')) {
            $newImage = $request->file('newImage');
            $newImageName = time() . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path('images'), $newImageName);

            // Удаляем старое изображение из диска
            if ($post->image !== 'default.jpg') {
                File::delete(public_path($post->image));
            }
            $post->image = $newImageName; // Заменяем на новое изображение
        }


        $post->save();
        return redirect()->route('yourPosts')->with('success', 'Пост успешно обновлен.');
    }
//функция удаления поста
    public function deletePost($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('yourPosts')->with('error', 'Пост не найден или не может быть удален.');
        }
        if ($post) {
            $post->delete();
            $tag = tbl_tag::where('name', $post->tag)->first();
            $this->TagFrequency($tag);
            return redirect()->route('yourPosts')->with('success', 'Пост успешно удален.');
        } else {
            return redirect()->route('yourPosts')->with('error', 'Пост не найден или не может быть удален.');
        }
    }
//функция публикации поста
    public function publishPost($id)
    {
        $post = Post::find($id);
        $post->status = 'Published';
        $post->created_at = Carbon::now();
        $post->save();

        $tag = tbl_tag::firstOrNew(['name' => $post->tag]);

        if (!$tag->exists) {
            $tag->frequency = 1;
            $tag->save();
        } else {
            $tag->frequency++;
            $tag->touch();
            $tag->save();
        }
        return redirect()->route('yourPosts')->with('success', 'Post published successfully');
    }
//Функция депубликации поста
    public function unpublishPost($id) {
        $post = Post::find($id);

        if (!$post) {
            return redirect('yourPosts')->with('error', 'Post not found.');
        }
        $post->status = 'Draft';
        $post->save();

        $tag = tbl_tag::where('name', $post->tag)->first();
        $this->TagFrequency($tag);
        return redirect('yourPosts')->with('success', 'Post unpublished successfully.');
    }
//Функция архивации поста
    public function archivePost($id) {
        // Находим пост по его идентификатору
        $post = Post::find($id);

        // Проверяем, существует ли пост
        if (!$post) {
            return redirect('yourPosts')->with('error', 'Post not found.');
        }

        $post->status = 'Archive';
        $post->save();

        $tag = tbl_tag::where('name', $post->tag)->first();
        $this->TagFrequency($tag);
        return redirect('yourPosts')->with('success', 'Post archived successfully.');
    }
    //Функция корректного хранения тэгов в бд
    public function TagFrequency($tag)
    {
        if ($tag) {
            if ($tag->frequency > 1) {
                $tag->decrement('frequency');
            } else {
                $tag->delete();
            }
        }
    }

    public function indexComments()
    {
        $comments = tbl_comment::with('post')
            ->orderBy('status', 'desc')
            ->get();
        return view('comments', compact('comments'));
    }

    public function publishComment($id)
    {
        $comment = tbl_comment::find($id);
        $comment->status = $comment->status == 'published' ? 'unpublish' : 'published';
        $comment->save();

        return redirect()->route('comments');
    }

    public function deleteComment($id)
    {
        $comment = tbl_comment::find($id);
        $comment->delete();

        return redirect()->route('comments');
    }
}

