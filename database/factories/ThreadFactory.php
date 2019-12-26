<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'owner_id' => factory('App\User')->create()->id,
        'category_id' => factory('App\Category')->create()->id,
        'title' => $faker->sentence(),
        'description' =>$faker->paragraph()
    ];
});
