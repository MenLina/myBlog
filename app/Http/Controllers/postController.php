<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\tbl_tag;
use App\Models\tbl_comment;
use App\Models\User;

class postController extends Controller
{
//функция отображения формы создания поста
    public function showForm()
    {
        return view('newPost');
    }

//Созранения поста в бд
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'tag' => 'max:255',
            'content' => 'required',
            'filePost' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->tag = $validatedData['tag'];

        $post->content = $validatedData['content'];
        $post->author_id = Auth::user()->id;

        if ($request->hasFile('filePost')) {
            $image = $request->file('filePost');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            // Если файл не загружен, используется дефолтное изображение
            $imageName = 'default.jpg';
        }

        $post->image = $imageName;
        if ($request->has('action')) {
            if ($request->input('action') === 'save') {
                // Пользователь нажал "Save"

                $post->status = 'Draft';

                $post->save();

                return redirect('yourPosts');
            } elseif ($request->input('action') === 'newPost') {
                $post->status = 'Published';
                $post->save();

                $tag = tbl_tag::firstOrNew(['name' => $request->input('tag')]);

                if (!$tag->exists) {
                    $tag->frequency = 1;
                    $tag->save(); // Если тег не существует, создайте новую запись.
                } else {
                    $tag->frequency++;
                    $tag->touch(); // Обновите updated_at.
                    $tag->save();
                }
                return redirect('yourPosts');
            } elseif ($request->input('action') === 'exit') {
                // Пользователь нажал "Exit", перенаправьте его на другую страницу
                return redirect('home');
            }
        }
    }

//отображение постов на странице home
    public function showPostsHome()
    {
        $posts = Post::orderBy('created_at', 'desc')->where('status', 'Published')->simplePaginate(10);

        return view('home', ['posts' => $posts]);
    }
//отображение конкретного поста и комментариев
    public function viewPost($id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'user'])->find($id);
        if (!$post) {
            // Обработайте случай, если пост не найден
            return redirect()->route('home')->with('error', 'Пост не найден');
        }

        return view('viewPost', compact('post'));
    }

//отображение всех постов с конкретным тегом
    public function showPostsByTag($tag)
    {
        // Получите все посты с указанным тегом
        $posts = Post::where('tag', $tag)->where('status', 'Published')->get();

        return view('tagsPost', compact('posts'));
    }

//отображение всех тэгов и записей с их количеством
    public function allTags()
    {
        $tags = tbl_tag::all();

        return view('tagCloud', compact('tags'));
    }

//сохранение комментариев в бд
    public function commentsStore(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer',
            'comment' => 'required|string',
        ]);


        $user_id = Auth::check() ? Auth::id() : 0;

        $defaultAuthor = Auth::check() ? Auth::user()->name : 'Guest';
        $defaultEmail = Auth::check() ? Auth::user()->email : 'guest@example.com';

        tbl_comment::create([
            'user_id' => $user_id,
            'post_id' => $request->post_id,
            'author' => $request->author ?? $defaultAuthor,
            'email' => $request->email ?? $defaultEmail,
            'content' => $request->comment,
            'status' => 'published',
        ]);

        return back()->with('success', 'Комментарий успешно добавлен.');
    }
}
