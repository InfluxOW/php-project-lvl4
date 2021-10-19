<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\AttentionLevel;
use App\Label;
use Faker\Generator as Faker;

$factory->define(Label::class, function (Faker $faker): array {
    return [
        'description' => $faker->sentence(10),
        'name' => $faker->words(3, true),
        'attention_level' => collect(AttentionLevel::getConstants())->random()
    ];
});
