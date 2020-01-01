<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

	public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function it_has_a_string_path()
    {
    	$this->assertEquals("/threads/{$this->thread->category->slug}/{$this->thread->id}", $this->thread->path());
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

    /** @test */
    public function it_belongs_to_a_category()
    {
        $this->assertInstanceOf('App\Category', $this->thread->category);
    }
}
