<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Thread;

class ValidateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function createThread($attributes = [])
    {
        $this->signIn();

        $thread = factory('App\Thread')->raw($attributes);

        return $this->post('/threads', $thread);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->createThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->createThread(['description' => null])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_thread_requires_a_valid_category()
    {
        $this->createThread(['category_id' => null])
            ->assertSessionHasErrors('category_id');

        $this->createThread(['category_id' => 999])
            ->assertSessionHasErrors('category_id');
    }
}
