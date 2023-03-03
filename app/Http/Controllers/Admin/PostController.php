<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $users = User::whereHas('roles', function ($q) {
            return $q->where('name', 'user');
        })->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'users'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $post = Post::findOrFail($id);
        $data['slug'] = Str::slug($data['title']);
        $count = count(Post::where('id', '!=', $id)->where('title', $data['title'])->get());
        if ($count) {
            $data['slug'] = Str::slug($data['title'] . ' ' . now()->timestamp);
        }
        if (array_key_exists('tag_id', $data)) {
            $post->tags()->sync($data['tag_id']);
        }
        if (array_key_exists('category_ids', $data)) {
            $post->categories()->sync($data['category_ids']);
        }
        $post->update($data);
        toastr('Post məlumatları redaktə edildi');
        return redirect()->route('posts');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        try {
            $post->delete();
            return response([
                'message' => 'Post silindi',
                'code' => 204
            ]);
        } catch (\Exception $ex) {
            return response([
                'message' => 'Xəta baş verdi',
                'code' => 500
            ]);
        }
    }
}
