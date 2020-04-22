<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TaskStatus;
use Faker\Generator as Faker;

$factory->define(TaskStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->words(2, true),
    ];
});

//States

$factory->state(TaskStatus::class, 'new', function () {
    return [
        'name' => 'new',
    ];
});
$factory->state(TaskStatus::class, 'processing', function () {
    return [
        'name' => 'processing',
    ];
});
$factory->state(TaskStatus::class, 'testing', function () {
    return [
        'name' => 'testing',
    ];
});
$factory->state(TaskStatus::class, 'completed', function () {
    return [
        'name' => 'completed',
    ];
});
