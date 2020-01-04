<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Activity;

class ActivityTest extends TestCase
{
	use refreshDatabase;

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
}