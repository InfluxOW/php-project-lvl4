<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Label;
use Faker\Generator as Faker;

$factory->define(Label::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(10),
        'name' => $faker->words(2, true),
        'attention_level' => collect(array_keys(Label::ATTENTION_LEVEL))->random()
    ];
});
