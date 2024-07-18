<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cats')->insert([
            [
                'name' => 'タマ',
                'sex' => '0',
                'breed' => '雑種',
                'self_introduction' => 'タマです。よろしくお願いします。',
                'img_name' => 'cat001.jpg',
                'user_id' => 1,
                'email' => 'tama@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'ミケ',
                'sex' => '1',
                'breed' => '三毛猫',
                'self_introduction' => 'ミケです。お世話になります。',
                'img_name' => 'cat002.jpg',
                'user_id' => 2,
                'email' => 'mike@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'クロ',
                'sex' => '0',
                'breed' => '黒猫',
                'self_introduction' => 'クロです。よろしくお願いします。',
                'img_name' => 'cat003.jpg',
                'user_id' => 3,
                'email' => 'kuro@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'シロ',
                'sex' => '0',
                'breed' => '白猫',
                'self_introduction' => 'シロです。よろしくお願いします。',
                'img_name' => 'cat004.jpg',
                'user_id' => 4,
                'email' => 'shiro@example.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
