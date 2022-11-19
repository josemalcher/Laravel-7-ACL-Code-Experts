<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Thread;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = Thread::class;
    public function definition()
    {
        return [
            'title' => fake()->sentence,
            'body' => fake()->paragraph(2),
            'slug' => fake()->slug

        ];
    }

}
