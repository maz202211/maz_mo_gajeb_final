<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class comment_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 70; $i++) {
            DB::table('comments')->insert([
                'content' => Str::random(150),

                'user_id' => $i, 'post_id' => $i,
            ]);
        }
    }
}
