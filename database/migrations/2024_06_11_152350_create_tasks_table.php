<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {
    public function up() {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->dateTime('due_date');
            $table->integer('duration');
            $table->integer('priority');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tasks');
    }
}
