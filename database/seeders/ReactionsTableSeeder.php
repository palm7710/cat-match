<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReactionsTableSeeder extends Seeder
{
    public function run()
    {
        // 既存のデータをクリア
        DB::table('reactions')->truncate();

        // サンプルデータの挿入
        $data = [
            ['cat_id' => 1, 'user_id' => 1, 'status' => 1], // ユーザー1が猫1に「いいね」
            ['cat_id' => 1, 'user_id' => 2, 'status' => 2], // 猫1がユーザー2に「いいね」
            ['cat_id' => 2, 'user_id' => 1, 'status' => 1], // ユーザー1が猫2に「いいね」
            ['cat_id' => 2, 'user_id' => 3, 'status' => 2], // 猫2がユーザー3に「いいね」
            ['cat_id' => 3, 'user_id' => 1, 'status' => 3], // ユーザー1と猫3の両方が「いいね」
            ['cat_id' => 3, 'user_id' => 2, 'status' => 3], // ユーザー2と猫3の両方が「いいね」
            ['cat_id' => 4, 'user_id' => 2, 'status' => 0], // ユーザー2が猫4に「ディスライク」
            ['cat_id' => 4, 'user_id' => 3, 'status' => 1], // ユーザー3が猫4に「いいね」
        ];

        // データの挿入
        foreach ($data as $item) {
            DB::table('reactions')->insert($item);
        }

        Log::info('Reactions table seeded with sample data.');
    }
}
