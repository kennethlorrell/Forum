<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_notification_appears_when_a_subscribed_thread_receives_a_new_reply_by_another_user()
    {
        $thread = factory('App\Thread')->create();

        $thread->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        factory('App\Reply')->create(['thread_id' => $thread->id, 'owner_id' => auth()->id()]);

        $this->assertCount(0, auth()->user()->notifications);

        factory('App\Reply')->create(['thread_id' => $thread->id]);

        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_his_unread_notifications()
    {
        factory('Illuminate\Notifications\DatabaseNotification')->create();

        $response = $this->getJson("/profiles/" . auth()->user()->name . "/notifications")->json();

        $this->assertCount(1, $response);

    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read()
    {
        factory('Illuminate\Notifications\DatabaseNotification')->create();

        tap(auth()->user(), function ($user) {

            $this->assertCount(1, $user->unreadNotifications);

            $notificationId = $user->unreadNotifications->first()->id;

            $this->delete("/profiles/{$user->name}/notifications/{$notificationId}");

            $this->assertCount(0, $user->fresh()->unreadNotifications);
        });
    }
}
