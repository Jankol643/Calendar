<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {
    public function up() {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->boolean('recurr');
            $table->integer('freq_no');
            $table->integer('freq_dur');
            $table->dateTime('last_exec');
            $table->dateTime('due_date');
            $table->string('task_cat');
            $table->string('task_name');
            $table->string('task_descr');
            $table->integer('task_dur');
            $table->integer('prio');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tasks');
    }
}
