<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => '佐藤太郎',
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
                'img_name' => 'sample001.jpg',
                'self_introduction' => '佐藤太郎です。猫が大好きで保護猫活動に取り組んでいます。',
                'sex' => 0,
            ],
            [
                'name' => '鈴木花子',
                'email' => 'user2@example.com',
                'password' => Hash::make('password123'),
                'img_name' => 'sample002.jpg',
                'self_introduction' => '鈴木花子です。保護猫のために日々頑張っています。',
                'sex' => 1,
            ],
            [
                'name' => '高橋一郎',
                'email' => 'user3@example.com',
                'password' => Hash::make('password123'),
                'img_name' => 'sample003.jpg',
                'self_introduction' => '高橋一郎です。保護猫の里親探しをしています。',
                'sex' => 0,
            ],
            [
                'name' => '伊藤由美子',
                'email' => 'user4@example.com',
                'password' => Hash::make('password123'),
                'img_name' => 'sample004.jpg',
                'self_introduction' => '伊藤由美子です。たくさんの猫たちと一緒に暮らしています。',
                'sex' => 1,
            ],
        ]);
    }
}
