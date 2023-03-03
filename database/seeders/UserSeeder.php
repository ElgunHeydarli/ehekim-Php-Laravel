<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Admin',
            'email'=>'dev@gmail.com',
            'password'=>Hash::make('Admin123'),
        ]);
        // $user = User::where('email','dev@gmail.com')->first();

        $user->syncRoles('admin');
    }
}
