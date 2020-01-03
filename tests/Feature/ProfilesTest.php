<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    /** @test */
    public function a_user_can_have_a_profile()
    {
        $user = factory('App\User')->create();

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    public function a_user_profile_can_contain_threads_created_by_this_user()
    {
        $user = factory('App\User')->create();

        $thread = factory('App\Thread')->create(['owner_id' => $user->id]);

        $this->get("profiles/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->description);
    }
}
