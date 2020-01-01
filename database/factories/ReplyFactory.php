<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'owner_id' => fn() => factory('App\User')->create()->id,
        'thread_id' => fn() => factory('App\Thread')->create()->id,
        'body' => $faker->sentence(3),
    ];
});
