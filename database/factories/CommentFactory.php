<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'the_comment' => $this->faker->sentence(),
            'post_id' => Post::all()->random(1)->first()->id,
            'user_id' => User::all()->random(1)->first()->id,
        ];
    }
}
