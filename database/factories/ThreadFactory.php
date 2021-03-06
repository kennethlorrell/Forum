<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'owner_id' => fn() => factory('App\User')->create()->id,
        'category_id' => fn() => factory('App\Category')->create()->id,
        'title' => $faker->sentence(),
        'description' =>$faker->paragraph()
    ];
});
