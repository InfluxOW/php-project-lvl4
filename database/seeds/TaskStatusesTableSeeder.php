<?php

use Illuminate\Database\Seeder;

class TaskStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TaskStatus::class)->states('new')->create();
        factory(App\TaskStatus::class)->states('processing')->create();
        factory(App\TaskStatus::class)->states('testing')->create();
        factory(App\TaskStatus::class)->states('completed')->create();
    }
}
