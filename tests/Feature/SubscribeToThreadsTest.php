<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_threads()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create();

        $this->post("{$thread->path()}/subscriptions");

        $this->assertCount(1, $thread->subscriptions);
    }

    /** @test */
    public function a_user_can_unsubscribe_from_threads()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create();

        $this->assertFalse($thread->isSubscribedTo);
        
        $this->post("{$thread->path()}/subscriptions");

        $this->assertTrue($thread->isSubscribedTo);

        $this->delete("{$thread->path()}/subscriptions");

        $this->assertFalse($thread->isSubscribedTo);
    }
}
