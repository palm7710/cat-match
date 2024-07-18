<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => '佐藤太郎',
                'email' => 'user1@example.com',
                'sex' => '0',
                'self_introduction' => '佐藤太郎です。猫が大好きで保護猫活動に取り組んでいます。',
                'img_name' => 'sample001.jpg',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '鈴木花子',
                'email' => 'user2@example.com',
                'sex' => '1',
                'self_introduction' => '鈴木花子です。保護猫のために日々頑張っています。',
                'img_name' => 'sample002.jpg',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '高橋一郎',
                'email' => 'user3@example.com',
                'sex' => '0',
                'self_introduction' => '高橋一郎です。保護猫の里親探しをしています。',
                'img_name' => 'sample003.jpg',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => '伊藤由美子',
                'email' => 'user4@example.com',
                'sex' => '1',
                'self_introduction' => '伊藤由美子です。たくさんの猫たちと一緒に暮らしています。',
                'img_name' => 'sample004.jpg',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
