<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Thread;
use App\Models\Channel;
use \App\Models\User;

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
        $title = fake()->sentence;
        return [
            'title' => $title,
            'body' => fake()->paragraph(2),
            'slug' => \Illuminate\Support\Str::slug($title),
            'channel_id' => Channel::factory(),
            'user_id' => User::factory(),
//            'channel_id' => function (array $attributes) {
//                //return \App\Models\Channel::factory()->create();
//                return Channel::find($attributes['channel_id'])->type;
//            },
//            'user_id' => function (array $attributes) {
//                //return \App\Models\User::factory()->create();
//                return User::find($attributes['user_id'])->type;
//            },

        ];
    }

}
