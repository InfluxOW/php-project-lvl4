<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_label', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('label_id');
            $table->timestamps();

            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
            $table->foreign('label_id')->references('id')->on('labels')->cascadeOnDelete();
            $table->unique(['task_id', 'label_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_task');
    }
}
