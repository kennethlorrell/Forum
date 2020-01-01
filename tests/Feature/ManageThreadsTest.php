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
    public function unauthorized_user_can_not_create_a_thread()
    {
        $this->post('/threads')
            ->assertRedirect('home');
    }

    /** @test */
    public function authorized_user_can_create_a_thread()
    {
        $this->signIn();

        $thread = factory('App\Thread')->raw();

        $this->followingRedirects()
            ->post('/threads', $thread)
            ->assertSee($thread['title'])
            ->assertSee($thread['description']);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->withoutExceptionHandling();

        $this->signIn();
        
        $ourUser = factory('App\Thread')->create(['owner_id' => auth()->id()]);
        $anotherUser = factory('App\Thread')->create();

        $this->get("/threads?by={$ourUser->creator->name}")
            ->assertSee($ourUser->title)
            ->assertDontSee($anotherUser->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_replies_count()
    {
        $threadWithThreeReplies = factory('App\Thread')->create();
        factory('App\Reply', 3)->create(['thread_id' => $threadWithThreeReplies->id]);

        $threadWithOneReply = factory('App\Thread')->create();
        factory('App\Reply', 1)->create(['thread_id' => $threadWithOneReply->id]);

        $threadWithoutReplies = $this->thread;

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3, 1, 0], array_column($response, 'replies_count'));
    }
}