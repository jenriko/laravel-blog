<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Http\Request;
use PDO;

class PostController extends Controller
{
    public function index()
    {
       
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(10)
            ]);
    }

    public function show(Post $post)
    {

        return view('blog-post', ['post' => $post]);
    }

    public function  create()
    {
        return view('admin.posts.create');
    }
    public function store()
    {
        $inputs = request()->validate([
            'title' => 'required|min:4',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-create-message', 'Post was created');
        return redirect()->route('post.index');
    }
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            'title' => 'required|min:4',
            'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            \Storage::delete($post->post_image);
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
        $post->update();

        session()->flash('post-update-message', 'Post was update');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('message', 'Post was delete');
        return back();
    }
}
