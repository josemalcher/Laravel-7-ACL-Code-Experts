<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Thread;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//        \App\Models\User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
/*
        \App\Models\User::factory(4)->create()->each(function ($user){
            $thread = \App\Models\Thread::factory(3)->make();

            $user->threads()->saveMany($thread);
        });*/
        //$this->call(ThreadsTableSeeder::class);
        Thread::factory(10)->create();
    }
}
