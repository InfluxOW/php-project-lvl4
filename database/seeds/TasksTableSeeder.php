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

        factory(App\Task::class, 20)->make()->each(function ($task) use ($statuses, $users) {
            $task->status()->associate($statuses->random());
            $task->creator()->associate($users->random());
            $task->save();
            $task->assignees()->attach($users->random());
            $task->save();
        });
    }
}
