<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Notifications\DatabaseNotification;
use Faker\Generator as Faker;

$factory->define(DatabaseNotification::class, function (Faker $faker) {
    return [
    	'id' => Str::uuid()->toString(),
    	'type' => 'App\Notifications\ThreadWasUpdated',
    	'notifiable_id' => function() {
    		return auth()->id() ?: factory('App\User')->create()->id;
    	},
    	'notifiable_type' => 'App\User',
    	'data' => ['foo' => 'bar']
    ];
});
