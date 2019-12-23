<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create()->each(function ($user) {
            factory(\App\Thread::class, ['user_id' => $user->id])->create()->each(function ($thread) {
                factory(\App\Reply::class, ['thread_id' => $thread->id])->create();
            });
        });
    }
}
