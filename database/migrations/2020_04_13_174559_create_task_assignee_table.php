<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAssigneeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_assignee', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('task_id')->index();
            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();

            $table->unsignedInteger('assignee_id')->index();
            $table->foreign('assignee_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unique(['task_id', 'assignee_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_assignee');
    }
}
