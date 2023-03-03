<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profession;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $posts = Post::orderBy('created_at', 'desc')->take(8)->get();
        $doctors = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        });
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'user');
        });
        $setting = Setting::first();
        return view('front.pages.index', compact('categories', 'setting', 'posts', 'doctors', 'users'));
    }

    public function posts($slug = null, Request $request)
    {
        $page = $request->page ?? 1;
        $categories = Category::orderBy('name')->get();
        $doctors = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        })->pluck('id')->toArray();
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'user');
        })->pluck('id')->toArray();
        $banner = Banner::orderBy('id', 'desc')->first();
        $tags = Tag::orderBy('name')->get();
        if (is_null($slug)) {
            $cat = null;
            $posts = Post::orderBy('created_at', 'desc')->get();
            $view = view('front.pages.posts', compact('posts', 'banner', 'users', 'categories', 'cat', 'doctors', 'slug', 'page'))->render();
        } else {
            $cat = Category::where('slug', $slug)->first();
            $tag = Tag::where('slug', $slug)->first();
            if ($cat) {
                $posts = Post::whereHas('categories', function ($q) use ($cat) {
                    return $q->where('category_id', $cat->id);
                })->get();
                $view = view('front.pages.posts', compact('posts', 'banner', 'users', 'categories', 'cat', 'doctors', 'slug', 'page'))->render();
            } elseif ($tag) {
                $posts = Post::whereHas('tags', function ($q) use ($tag) {
                    return $q->where('tag_id', $tag->id);
                })->get();
                $view = view('front.pages.tags', compact('tags', 'tag', 'categories', 'doctors', 'posts', 'slug', 'page'))->render();
            } else {
                return abort(404);
            }
        }

        return response($view);
    }

    public function tag_posts($slug=null, Request $request)
    {
        $page = $request->page ?? 1;
        $tag = Tag::where('slug', $slug)->first();
        if (!$tag) abort(404, 'Belə açar söz mövcud deyil');
        $posts = Post::whereHas('tags', function ($q) use ($tag) {
            return $q->where('tag_id', $tag->id);
        })->get();
        $tags = Tag::orderBy('name')->get();
        $doctors = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        })->pluck('id')->toArray();
        $categories = Category::orderBy('name')->get();
        return view('front.pages.tags', compact('tags', 'tag', 'categories', 'doctors', 'posts', 'slug', 'page'));
    }

    public function doctors($slug = null, Request $request)
    {
        $page = $request->page ?? 1;
        $doctors = User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        });

        $professions = Profession::orderBy('name')->get();
        $profession = Profession::first();
        if (!is_null($slug)) {
            $profession = Profession::where('slug', $slug)->first();
            $doctors = $doctors->whereHas('professions', function ($q) use ($slug) {
                return $q->where('slug', $slug);
            });
        }
        $doctors = $doctors->get();

        return view('front.pages.doctors', compact('doctors', 'slug', 'profession', 'professions', 'page'));
    }

    public function post($slug, Request $request)
    {
        $page = $request->page ?? 1;
        $post = Post::where('slug', $slug)->first();
        $cat = Category::where('slug', $slug)->first();
        $tag = Tag::where('slug', $slug)->first();
        $profession = Profession::where('slug',$slug)->first();
        if ($post) {
            $posts = Post::where('category_id', '!=', null)->get();
            $post->update([
                'views' => $post->views + 1,
            ]);

            $view = view('front.pages.post-single', compact('post', 'posts'))->render();
        } elseif ($cat) {
            $categories = Category::orderBy('name')->get();
            $doctors = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('name', 'doctor');
            })->pluck('id')->toArray();
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('name', 'user');
            })->pluck('id')->toArray();
            $banner = Banner::orderBy('id', 'desc')->first();
            $tags = Tag::orderBy('name')->get();
            $posts = Post::whereHas('categories', function ($q) use ($cat) {
                return $q->where('category_id', $cat->id);
            })->get();
            $view = view('front.pages.posts', compact('posts', 'banner', 'users', 'categories', 'cat', 'doctors', 'slug', 'page'))->render();
        } elseif ($tag) {
            $categories = Category::orderBy('name')->get();
            $doctors = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('name', 'doctor');
            })->pluck('id')->toArray();
            $users = \App\Models\User::whereHas('roles', function ($q) {
                return $q->where('name', 'user');
            })->pluck('id')->toArray();
            $banner = Banner::orderBy('id', 'desc')->first();
            $tags = Tag::orderBy('name')->get();
            $posts = Post::whereHas('tags', function ($q) use ($tag) {
                return $q->where('tag_id', $tag->id);
            })->get();
            $view = view('front.pages.tags', compact('tags', 'tag', 'categories', 'doctors', 'posts', 'slug', 'page'))->render();
        } elseif($profession){
                $page = $request->page ?? 1;
                $doctors = User::whereHas('roles', function ($q) {
                    return $q->where('name', 'doctor');
                });
        
                $professions = Profession::orderBy('name')->get();
                $doctors = $doctors->whereHas('professions', function ($q) use ($slug) {
                    return $q->where('slug', $slug);
                });
                $doctors = $doctors->get();
                return view('front.pages.doctors', compact('doctors', 'slug', 'profession', 'professions', 'page'));
        }
        else {
            return abort(404);
        }
        return response($view);
    }

    public function doctor_detail($profession = null, $slug = null)
    {
        
        $user = User::whereHas('professions', function ($q) use ($profession) {
            return $q->where('slug', $profession);
        })->where('slug', $slug)->first();
        if (!$user) return abort(404);
        return view('front.pages.doctor-detail', compact('user'));
    }

    public function thank_you()
    {
        return view('front.pages.thank-you');
    }

    public function add_post(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|max:60',
        ]);
        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ]);
        }
        $data['slug'] = Str::slug($data['title']);
        $count = count(Post::where('title', $data['title'])->get());
        if ($count) {
            $data['slug'] = Str::slug($data['title'] . ' ' . ($count + 1));
        }
        $data['views'] = 0;
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }
        $post = Post::create($data);

        toastr('Sualınız qeydə alınmışdır');
        if (auth()->check()) {
            return redirect()->back();
        } else {
            return redirect()->route('thank-you');
        }
    }

    public function send_comment($id, Request $request)
    {
        $data = $request->all();
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $id,
            'text' => $data['text']
        ]);

        toastr('Rəyiniz əlavə olundu');
        return redirect()->back();
    }

    public function edit_comment($id, Request $request)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());

        toastr('Yazdığınız rəy yeniləndi');
        return redirect()->back();
    }

    public function like_comment($id)
    {
        $comment = Comment::find($id);

        if (auth()->id()) {
            if ($comment->likes->where('user_id', auth()->id())->first()) {
                $message = 'Bəyənmə geri götürüldü';
                $comment->likes->where('user_id', auth()->id())->first()->delete();
            } else {
                $message = 'Rəy bəyənildi';
                Like::create([
                    'user_id' => auth()->id(),
                    'comment_id' => $id,
                ]);
            }
        } else {
            $likes = Session::get('likes', []);
            if (isset($likes[$id])) {
                unset($likes[$id]);

                Session::put('likes', $likes);
                $message = 'Bəyənmə geri götürüldü';
                Like::where(['comment_id' => $id, 'user_id' => null])->orderBy('id', 'desc')->first()->delete();
            } else {
                $likes[$id] = [
                    'comment_id' => $id,
                    'user_id' => 'anonym',
                ];
                Like::create([
                    'comment_id' => $id,
                    'user_id' => null,
                ]);

                Session::put('likes', $likes);
                $message = 'Rəy bəyənildi';
            }
        }

        return response([
            'message' => $message,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $posts = Post::query();
        $doctors = User::whereHas('roles', function ($q) {
            return $q->where('name', 'doctor');
        });
        $categories = Category::orderBy('name');
        $tags = Tag::orderBy('name');
        $professions = Profession::orderBy('name');
        $data = [
            'posts' => collect([]),
            'doctors' => collect([]),
            'categories' => collect([]),
            'tags' => collect([]),
            'professions' => collect([]),
        ];
        if ($search) {
            $posts = $posts->where(function ($query) use ($search) {
                return $query->whereHas('tags', function ($q) use ($search) {
                    return $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('text', 'like', '%' . $search . $search);
            });
            $doctors = $doctors->where('fullname', 'like', '%' . $search . '%');
            $categories = $categories->where('name', 'like', '%' . $search . '%');
            $tags = $tags->where('name', 'like', '%' . $search . '%');
            $professions = $professions->where('name', 'like', '%' . $search . '%');
        }

        foreach ($posts->get() as $post) {
            $data['posts']->push($post);
        }

        foreach ($doctors->get() as $doctor) {
            $data['doctors']->push($doctor);
        }

        foreach ($categories->get() as $category) {
            $data['categories']->push($category);
        }

        foreach ($tags->get() as $tag) {
            $data['tags']->push($tag);
        }

        foreach ($professions->get() as $profession) {
            $data['professions']->push($profession);
        }
        $view = view('front.includes.search', compact('data'))->render();

        return response($view);
    }
}
