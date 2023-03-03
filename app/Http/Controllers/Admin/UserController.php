<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileManager;
use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->role;
        if (!is_null($role)) {
            $users = User::whereHas('roles', function ($q) use ($role) {
                return $q->where('name', $role);
            })->get();
        } else {
            $users = User::get();
        }
        return view('admin.users.index', compact('users', 'role'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $professions = Profession::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'professions'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $user = User::find($id);
        if (!is_null($data['password'])) {
            $data['password'] = \Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        if ($request->has('image')) {
            FileManager::fileDelete('', $user->image);
            $data['image'] = FileManager::fileUpload($request->file('image'), '');
        }
        if ($request->has('cv')) {
            FileManager::fileDelete('', $user->cv);
            $data['cv'] = FileManager::fileUpload($request->file('cv'), '');
        }
        if (array_key_exists('lastname', $data)) {
            $data['fullname'] = $data['name'] . ' ' . $data['lastname'];
            $data['slug'] = Str::slug($data['fullname']);
            $count = count(User::where('id', '!=', $id)->where('slug', $data['slug'])->get());
            if ($count) {
                $data['slug'] = Str::slug($data['fullname'] . '-' . now());
            }
        }
        if (array_key_exists('profession_id', $data)) {
            $user->professions()->sync($data['profession_id']);
        }
        $user->update($data);
        $redirectUrl = '/admin/users?role=user';
        if ($user->hasRole('doctor')) {
            $redirectUrl = '/admin/users?role=doctor';
        }

        toastr('İstifadəçi məlumatları yeniləndi');
        return redirect($redirectUrl);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        try {
            foreach ($user->posts as $post) {
                $post->update([
                    'user_id' => null,
                ]);
            }
            $user->comments()->delete();
            foreach ($user->professions as $profession) {
                $profession->pivot->delete();
            }
            $user->delete();
            return response([
                'message' => 'Istifadəçi silindi',
                'code' => 204,
            ]);
        } catch (\Exception $ex) {
            return response([
                'message' => 'Silərkən xəta baş verdi',
                'code' => 500,
            ]);
        }
    }

    public function comments($id)
    {
        $user = User::findOrFail($id);
        $comments = $user->comments;
        return view('admin.users.comment', compact('comments', 'user'));
    }

    public function posts($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts;
        return view('admin.users.post', compact('user', 'posts'));
    }
}
