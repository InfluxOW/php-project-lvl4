<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(10),
        'name' => $faker->words(3, true),
    ];
});

$factory->afterMaking(App\Task::class, function ($task) {
    $task->status()->associate(App\TaskStatus::all()->random());
    $task->creator()->associate(App\User::all()->random());
});

$factory->afterCreating(App\Task::class, function ($task) {
    $assegneesAmount = random_int(1, App\User::all()->count() / 4);
    $assignees = App\User::inRandomOrder()->take($assegneesAmount)->get();
    $task->assignees()->sync($assignees);

    $labelsAmount = random_int(1, App\Label::all()->count() - 2);
    $labels = App\Label::inRandomOrder()->take($labelsAmount)->get();
    $task->labels()->sync($labels);
});
