<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = App\Status::all();
        $users = App\User::all();
        $labelsCount = App\Label::all()->count();

        factory(App\Task::class, 20)->make()->each(function ($task) use ($statuses, $users, $labelsCount) {
            $task->status()->associate($statuses->random());
            $task->creator()->associate($users->random());
            $task->save();

            $assegneesAmount = random_int(1, $users->count() / 4);
            $assignees = App\User::inRandomOrder()->take($assegneesAmount)->get();
            $task->assignees()->sync($assignees);

            $labelsAmount = random_int(1, $labelsCount - 2);
            $labels = App\Label::inRandomOrder()->take($labelsAmount)->get();
            $task->labels()->sync($labels);
        });
    }
}
