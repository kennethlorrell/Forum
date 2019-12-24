<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }
    
    /** @test */
    public function a_guest_can_view_all_threads()
    {
        $this->withExceptionHandling();

        $this->get('/threads')->assertStatus(200);

        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
    public function a_guest_can_view_the_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
    public function a_guest_can_view_thread_associated_replies()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function only_auth_user_can_create_a_thread()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $attributes = factory('App\Thread')->raw();

        $this->followingRedirects()
            ->post('/threads', $attributes)
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description']);
    }
}