<?php

namespace App\Helpers\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function add_user(array $data,string $role){
        $role = Role::all()->firstWhere('name', $role);
        $user = User::create([
            'name' => $data['name'] . '_' . $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make('Adnsu123'),
            'role_id' => $role->id,
        ]);

        return $user;
    }

    public function is_user_exists(string $email){
        $user_exists = User::all()->contains('email',$email);
        return $user_exists;
    }
}