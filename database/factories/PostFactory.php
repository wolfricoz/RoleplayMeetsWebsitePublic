<?php

namespace Database\Factories;

use App\Models\Genres;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::get()->random()->id,
            'genre_id' => Genres::get()->random()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,

        ];
    }
}
