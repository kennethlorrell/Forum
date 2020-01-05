<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Activity;

class ManageThreadsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_guest_can_view_all_threads()
    {
        $thread = factory('App\Thread')->create();

        $this->get('/threads')->assertStatus(200);

        $this->get($thread->path())->assertSee($thread->title);
    }

    /** @test */
    public function a_guest_can_view_the_thread()
    {
        $thread = factory('App\Thread')->create();

        $this->get($thread->path())->assertSee($thread->title);
    }

    /** @test */
    public function a_guest_can_view_thread_associated_replies()
    {
        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create(['thread_id' => $thread->id]);
        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_guest_can_not_create_a_thread()
    {
        $this->post('/threads')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_a_thread()
    {
        $this->signIn();

        $thread = factory('App\Thread')->raw();

        $this->followingRedirects()
            ->post('/threads', $thread)
            ->assertSee($thread['title'])
            ->assertSee($thread['description']);
    }

    /** @test */
    public function an_unauthorized_user_can_not_delete_a_thread()
    {
        $thread = factory('App\Thread')->create();

        $this->delete($thread->path())
            ->assertRedirect('login');

        $this->signIn();

        $this->delete($thread->path())
            ->assertStatus(403);

        $this->assertDatabaseHas('threads', ['id' => $thread->id]);
    }

    /** @test */
    public function a_thread_can_be_entirely_deleted_by_authorized_user()
    {
        $this->signIn();

        $thread = factory('App\Thread')->create(['owner_id' => auth()->id()]);
        $reply = factory('App\Reply')->create(['thread_id' => $thread->id]);

        $this->assertDatabaseHas('threads', ['id' => $thread->id]);
        $this->assertDatabaseHas('replies', ['id' => $reply->id]);
        $this->assertDatabaseHas('activities', [
            'activable_id' => $thread->id,
            'activable_type' => get_class($thread),
        ]);
        $this->assertDatabaseHas('activities', [
            'activable_id' => $reply->id,
            'activable_type' => get_class($reply),
        ]);
        
        $this->delete($thread->path());
        
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', [
            'activable_id' => $thread->id,
            'activable_type' => get_class($thread),
        ]);
        $this->assertDatabaseMissing('activities', [
            'activable_id' => $reply->id,
            'activable_type' => get_class($reply),
        ]);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn();
        
        $ourThread = factory('App\Thread')->create(['owner_id' => auth()->id()]);
        $foreignThread = factory('App\Thread')->create();

        $this->get("/threads?by={$ourThread->creator->name}")
            ->assertSee($ourThread->title)
            ->assertDontSee($foreignThread->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_replies_count()
    {
        $threadWithThreeReplies = factory('App\Thread')->create();
        factory('App\Reply', 3)->create(['thread_id' => $threadWithThreeReplies->id]);

        $threadWithOneReply = factory('App\Thread')->create();
        factory('App\Reply', 1)->create(['thread_id' => $threadWithOneReply->id]);

        $threadWithoutReplies = factory('App\Thread')->create();

        $response = $this->getJson('/threads?popular=1')->json();

        $this->assertEquals([3, 1, 0], array_column($response, 'replies_count'));
    }
}