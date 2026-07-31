<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->date('enrollment_date');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30);
            $table->string('bilhete_identidade', 14);
            $table->string('course', 100);
            $table->foreignId('class_id')->nullable()->constrained('classes')->nullOnDelete();
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
        Schema::dropIfExists('enrollments');
    }
}
