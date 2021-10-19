<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TaskStatus as Status;
use Faker\Generator as Faker;

$factory->define(Status::class, function (Faker $faker): array {
    return [
        'name' => $faker->words(2, true),
    ];
});

foreach (Status::DEFAULT_STATUSES as $status) {
    $factory->state(Status::class, $status, function () use ($status): array {
        return [
            'name' => $status,
        ];
    });
}
