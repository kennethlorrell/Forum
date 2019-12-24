<?php

namespace Tests\Unit;

use Tests\TestCase;

class ThreadTest extends TestCase
{

	public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function it_has_a_path()
    {
    	$this->assertEquals("/threads/{$this->thread->id}", $this->thread->path());
    }

    /** @test */
    public function it_has_a_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */ 
    public function it_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }
}
