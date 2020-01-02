<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_can_not_make_a_reply_favorite()
    {
        $this->post('/replies/1/favorites')
            ->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_make_a_reply_favorite()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create();

        $this->post("/replies/{$reply->id}/favorites");

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function a_user_can_make_a_reply_favorite_only_once()
    {
        $this->signIn();

        $reply = factory('App\Reply')->create();

        $this->post("/replies/{$reply->id}/favorites");
        $this->post("/replies/{$reply->id}/favorites");

        $this->assertCount(1, $reply->favorites);
    }
}
