<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Activity;
use Illuminate\Support\Carbon;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

	/** @test */
    public function it_records_threads_activity()
    {
    	$this->signIn();

        $thread = factory('App\Thread')->create();

        $this->assertDatabaseHas('activities', [
        	'user_id' => auth()->id(),
        	'type' => 'created_thread',
        	'activable_id' => $thread->id,
        	'activable_type' => get_class($thread),
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->activable->id, $thread->id);
    }

    /** @test */
    public function it_records_replies_activity()
    {
    	$this->signIn();

        factory('App\Reply')->create();

        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function it_fetches_users_feed()
    {
        $this->signIn();

        factory('App\Thread', 2)->create(['owner_id' => auth()->id()]);

        auth()->user()->activities()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format('Y-m-d')
        ));

        $feed = Activity::feed(auth()->user());
        
        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format('Y-m-d')
        ));
    }
}