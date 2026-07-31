<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudents1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students1', function (Blueprint $table) {
            $table->id();
            $table->boolean('exam')->default(true);
            $table->foreignId('enrollment_id')->constrained('enrollments')->onDelete('cascade');
           $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
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
        Schema::dropIfExists('students1');
    }
}
