<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'title'=>$title,
        'slug'=>\Illuminate\Support\Str::slug($title),
        'body'=>$faker->text,
        'user_id'=>rand(1,100),
        'category_id'=>rand(1,100),
    ];
});
