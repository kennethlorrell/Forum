<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

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
        $this->signIn();

        $thread = factory('App\Thread')->create(['owner_id' => auth()->id()]);

        $this->get('profiles/' . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->description);
    }
}
