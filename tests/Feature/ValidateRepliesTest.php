<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidateRepliesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_reply_require_valid_body()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->raw([
            'thread_id' => $thread->id,
            'body' => null
        ]);

        $this->post($thread->path() . '/replies', $reply)
            ->assertSessionHasErrors('body');
    }
}
