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
        factory('App\User', 4)->create()->each(function ($user) {
            factory('App\Thread', 2)->create(['owner_id' => $user->id])->each(function ($thread) {
                factory('App\Reply', 5)->create(['thread_id' => $thread->id]);
            });
        });
    }
}
