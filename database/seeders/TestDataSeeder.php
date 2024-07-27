<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // ユーザーの挿入
        DB::table('users')->insert([
            [
                'name' => 'User1',
                'email' => 'user1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@example.com',
                'password' => Hash::make('password'),
            ],
        ]);

        // 猫の挿入
        DB::table('cats')->insert([
            [
                'name' => 'Cat1',
                'sex' => '0',
                'breed' => '雑種',
                'self_introduction' => 'Cat1です。よろしくお願いします。',
                'img_name' => 'cat001.jpg',
                'email' => 'cat1@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Cat2',
                'sex' => '1',
                'breed' => '三毛猫',
                'self_introduction' => 'Cat2です。お世話になります。',
                'img_name' => 'cat002.jpg',
                'email' => 'cat2@example.com',
                'password' => Hash::make('password'),
            ],
        ]);

        // リアクションの挿入
        DB::table('reactions')->insert([
            [
                'cat_id' => 1,
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'cat_id' => 2,
                'user_id' => 1,
                'status' => 1,
            ],
            [
                'cat_id' => 1,
                'user_id' => 2,
                'status' => 1,
            ],
            [
                'cat_id' => 2,
                'user_id' => 2,
                'status' => 1,
            ],
        ]);
    }
}
