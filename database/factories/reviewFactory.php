<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\review;
use Faker\Generator as Faker;
use Illuminate\support\Str;

$factory->define(review::class, function (Faker $faker) {
    return [
        //
        'id' => Str::uuid(),
        'content' => $faker->sentences(5, true),
        'rating' => random_int(1, 5)


    ];
});
