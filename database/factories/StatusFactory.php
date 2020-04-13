<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

//States

$factory->state(Status::class, 'new', function () {
    return [
        'name' => 'new',
    ];
});
$factory->state(Status::class, 'processing', function () {
    return [
        'name' => 'processing',
    ];
});
$factory->state(Status::class, 'testing', function () {
    return [
        'name' => 'testing',
    ];
});
$factory->state(Status::class, 'completed', function () {
    return [
        'name' => 'completed',
    ];
});
