<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->sentence;
        return [
            'name' => $name,
            'description' => fake()->sentence,
            'slug' => \Illuminate\Support\Str::slug($name)
        ];
    }
}
