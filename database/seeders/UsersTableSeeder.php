<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'meme_es@hotmail.com',
            'nickname' => 'Meme',
            'role' => 0,
            'password' => Hash::make('Admin*123'),
            'sex' => 0
        ]);
    }
}
