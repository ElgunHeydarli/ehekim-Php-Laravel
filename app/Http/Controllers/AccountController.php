<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use App\Http\Requests\RegisterRequest;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->only(['email', 'password']);
        $authAttempt = Auth::attempt($data);
        if ($authAttempt) {
            toastr('Giriş etdiniz');
            return redirect()->route('home');
        }

        toastr('Giriş məlumatları yanlışdır', 'warning');
        return redirect()->back();
    }

    public function register($role, RegisterRequest $request)
    {
        $data = $request->all();
        $user_exist = User::where('email', $data['email'])->first();
        if ($user_exist) {
            toastr('Bu istifadəçi mövcuddur', 'warning');
            return redirect()->back();
        }
        if ($request->has('image')) {
            $data['image'] = FileManager::fileUpload($request->file('image'), '');
        }
        if ($request->has('cv')) {
            $data['cv'] = FileManager::fileUpload($request->file('cv'), '');
        }
        if (array_key_exists('lastname', $data)) {
            $data['fullname'] = $data['name'] . ' ' . $data['lastname'];
            $count = count(User::where('fullname', $data['fullname'])->get());
            if ($count) {
                $data['slug'] = Str::slug($data['fullname'] . ' ' . ($count + 1));
            }
        }
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $user->syncRoles($data['role']);
        if (array_key_exists('profession_id', $data)) {
            $user->professions()->sync($data['profession_id']);
        }

        toastr('İstifadəçi qeydiyyatdan keçirildi');
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = auth()->user();
        $professions = Profession::orderBy('name')->get();
        return view('front.pages.profile', compact('user', 'professions'));
    }

    public function update_profile(Request $request)
    {
        $data = $request->all();
        $user = auth()->user();
        $data['image'] = $user->image;
        if (array_key_exists('profession_id', $data)) {
            $user->professions()->sync($data['profession_id']);
        }
        if ($request->hasFile('image')) {
            FileManager::fileDelete('', $user->image);
            $data['image'] = FileManager::fileUpload($request->file('image'), '');
        }

        if (array_key_exists('lastname', $data)) {
            $data['fullname'] = $data['name'] . ' ' . $data['lastname'];
            $data['slug'] = Str::slug($data['fullname']);
            $count = User::wher('id', '!=', auth()->id())->where('fullname', $data['fullname']);
            if ($count) {
                $data['slug'] = Str::slug($data['fullname'] . '-' . ($count + 1));
            }
        }

        if (!is_null($data['old_password'])) {
            if (!Hash::check($data['old_password'], $user->password)) {
                toastr('Cari parol düzgün daxil edilməmişdir', 'error');
                return redirect()->back();
            }

            if ($data['new_password'] != $data['confirm_password']) {
                toastr('Yeni parolu təsdiqləməniz tələb olunur', 'warning');
                return redirect()->back();
            }

            if (!is_null($data['new_password'])) {
                $user->update([
                    'password' => Hash::make($data['new_password']),
                ]);
            }
        }

        $data['password'] = $user->password;
        $user->update($data);

        toastr('Profil məlumatları yenilənmişdir');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
