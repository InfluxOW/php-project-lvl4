<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Label;
use App\Task;
use App\TaskStatus;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker): array {
    return [
        'description' => $faker->sentence(10),
        'name' => $faker->words(3, true),
    ];
});

$factory->afterMaking(Task::class, function ($task): void {
    $task->status()->associate(TaskStatus::all()->random());
    $task->creator()->associate(User::all()->random());
});

$factory->afterCreating(Task::class, function ($task): void {
    $assigneesAmount = random_int(1, round(User::all()->count() / 4));
    $assignees = User::inRandomOrder()->take($assigneesAmount)->get();
    $task->assignees()->sync($assignees);

    $labelsAmount = random_int(1, Label::all()->count() - 2);
    $labels = Label::inRandomOrder()->take($labelsAmount)->get();
    $task->labels()->sync($labels);
});
