<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'views' => fake()->numberBetween(0, 1000),
            'is_solved' => fake()->boolean(30),
            'solved_at' => fake()->boolean(30) ? now() : null,
            'is_pinned' => fake()->boolean(5),
            'is_locked' => fake()->boolean(5),
        ];
    }
}
