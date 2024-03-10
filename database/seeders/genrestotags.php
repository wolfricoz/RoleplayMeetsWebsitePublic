<?php

namespace Database\Seeders;


use App\Models\Genres;
use App\Models\Post;
use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class genrestotags extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Post::all() as $post) {
          Tags::create([
            'name' => Genres::find($post->genre_id)->name,
            'post_id' => $post->id,
            'genre_id' => $post->genre_id
          ]);

        }
    }
}
