<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Status::class)->states('testing')->create();
        factory(App\Status::class)->states('processing')->create();
        factory(App\Status::class)->states('new')->create();
        factory(App\Status::class)->states('completed')->create();
    }
}
