<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('course_name')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('teacher_name')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->string('schedule')->nullable();
            $table->integer('enrolled')->default(0);
            $table->integer('capacity')->default(25);
            $table->string('status')->default('Em Curso');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
