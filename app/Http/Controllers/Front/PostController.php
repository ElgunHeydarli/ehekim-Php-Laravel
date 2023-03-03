<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $posts = Post::orderBy('created_at', 'desc')->get();
        $doctors = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        })->pluck('id')->toArray();
        return view('front.pages.posts.index', compact('posts','doctors','page'));
    }
}
