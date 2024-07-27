<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReactionsTableSeeder extends Seeder
{
    public function run()
    {
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
