<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Thread::factory(5)->create()->each(function ($user){
//            $thread = User::factory(3)->make();
//            $user->threads()->saveMany($thread);
//        });
        // Thread::factory(10)->count(1)->hasUsers(1)->create();
        // \App\Models\User::factory(10)->create();User::factory(4)->create();
    }
}
