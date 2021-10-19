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
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('assignee_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
            $table->foreign('assignee_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['task_id', 'assignee_id']);
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
