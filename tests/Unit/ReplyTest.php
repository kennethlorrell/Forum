<?php

namespace Tests\Unit;

use Tests\TestCase;

class ReplyTest extends TestCase
{
	public function setUp(): void
	{
		parent::setUp();

		$this->reply = factory('App\Reply')->create();
	}

    /** @test */
    public function it_has_an_owner() 
    {
    	$this->assertInstanceOf('App\User', $this->reply->owner);
    }

    /** @test */
    public function it_is_associated_with_a_thread()
    {
    	$this->assertInstanceOf('App\User', $this->reply->owner);
    }
}
