<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table("memberships")->insert([
            [
                "type" => "A",
                "article_limit" => 3,
                "video_limit" => 3,
            ],
            [
                "type" => "B",
                "article_limit" => 10,
                "video_limit" => 10,
            ],
            [
                "type" => "C",
                "article_limit" => null,
                "video_limit" => null,
            ],
        ]);

        DB::table("socials")->insert([
            [
                "type" => "Google",
            ],
            [
                "type" => "Facebook",
            ],
        ]);

        for ($i = 0; $i < 12; $i++) {
            DB::table("articles")->insert([
                [
                    "title" => fake()->sentence(5),
                    "content" => fake()->sentence(1000),
                    "writer" => fake()->name(),
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ]
            ]);

            DB::table("videos")->insert([
                [
                    "title" => fake()->sentence(2),
                    "link" => "https://www.youtube.com/embed/N775KsWQVkw",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ]
            ]);
        }
    }
}
