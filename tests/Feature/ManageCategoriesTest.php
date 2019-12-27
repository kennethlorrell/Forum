<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_may_see_threads_according_to_their_category()
    {
        $this->withoutExceptionHandling();

        $category = factory('App\Category')->create();

        $firstThread = factory('App\Thread')->create(['category_id' => $category->id]);
        $secondThread = factory('App\Thread')->create();

        $this->get($category->path())
            ->assertSee($firstThread->title)
            ->assertDontSee($secondThread->title);
    }
}
