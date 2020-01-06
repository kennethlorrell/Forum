<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageRepliesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_not_leave_a_reply()
    {
        $thread = factory('App\Thread')->create();

        $this->post($thread->path() . '/replies')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_leave_a_reply()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create();

        $attributes = factory('App\Reply')->raw();

        $this->post($thread->path() . '/replies', $attributes);

        $this->assertDatabaseHas('replies', ['body' => $attributes['body']]);
        $this->assertEquals(1, $thread->fresh()->replies_count);
    }

    /** @test */
    public function an_unauthorized_user_can_not_delete_a_reply()
    {
        $reply = factory('App\Reply')->create();

        $this->delete("replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->delete("replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_can_delete_a_reply()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create(['owner_id' => auth()->user()]);

        $this->delete("/replies/{$reply->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    /** @test */
    public function an_unauthorized_user_can_not_update_a_reply()
    {
        $reply = factory('App\Reply')->create();

        $this->patch("replies/{$reply->id}")
            ->assertRedirect('login');

        $this->signIn();

        $this->patch("replies/{$reply->id}")
            ->assertStatus(403);
    }

    /** @test */
    public function an_authorized_user_can_update_a_reply()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create(['owner_id' => auth()->user()]);
        $attributes = 'Brand New Body';

        $this->patch("/replies/{$reply->id}", ['body' => $attributes]);

        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $attributes]);
    }
}
