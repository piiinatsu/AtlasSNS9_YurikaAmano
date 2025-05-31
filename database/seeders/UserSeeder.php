<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'username' => 'atlas' . $i,
                'email' => 'atlas' . $i . '@mail.com',
                'password' => Hash::make('atlas' . $i . 'atlas' . $i),
                'bio' => '自己紹介文です',
                'icon_image' => 'icon1.png', // デフォルト画像
            ]);
        }
    }
}
