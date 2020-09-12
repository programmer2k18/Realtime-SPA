<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'body'=>$faker->text,
        'user_id'=>rand(1,100),
        'question_id'=>rand(1,100),
    ];
});
