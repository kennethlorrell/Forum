<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{

	public function setUp(): void
    {
        parent::setUp();

        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function it_has_threads()
    {
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->threads);
    }

    /** @test */
    public function it_has_replies()
    {
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->replies);
    }
}