<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRepliesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthorized_user_can_not_leave_replies()
    {
        $thread = factory('App\Thread')->create();

        $this->post($thread->path() . '/replies')
            ->assertRedirect('home');
    }

    /** @test */
    public function authorized_user_can_leave_replies()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = factory('App\Thread')->create();

        $attributes = factory('App\Reply')->raw();

        $this->followingRedirects()
            ->post($thread->path() . '/replies', $attributes)
            ->assertSee($attributes['body']);
    }
}
