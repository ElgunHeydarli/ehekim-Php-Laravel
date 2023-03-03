<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login(LoginRequest $request){
        $data = $request->only(['email','password']);
        $authAttempt = Auth::attempt($data);
        if($authAttempt){
            return redirect()->route('dashboard');
        }

        toastr('Login məlumatları düzgün deyil','error');
        return redirect()->back();
    }

    public function profile(){
        return view('admin.account.profile');
    }

    public function update_profile(Request $request){

        toastr('Profil məlumatları yeniləndi');
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
