<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class post_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('posts')->insert([
                'title' => Str::random(10),
                'content' => Str::random(150),

                'vote_up' => $i, 'vote_down' => $i,
                'user_id' => $i, 'category_id' => $i,
            ]);
        }
    }
}
