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
        factory('App\User', 10)->create()->each(function ($user) {
            factory('App\Thread', ['owner_id' => $user->id])->create()->each(function ($thread) {
                factory('App\Reply', ['thread_id' => $thread->id])->create();
            });
        });
    }
}
