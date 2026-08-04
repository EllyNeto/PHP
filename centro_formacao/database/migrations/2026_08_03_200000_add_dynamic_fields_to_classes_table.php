<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDynamicFieldsToClassesTable extends Migration
{
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->string('course_name', 100)->nullable()->after('curse_id');
            $table->string('teacher_name', 255)->nullable()->after('teacher_id');
            $table->unsignedInteger('capacity')->default(0)->after('room');
            $table->string('status', 20)->default('Planeada')->after('capacity');
        });

        DB::statement('ALTER TABLE classes MODIFY teacher_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE classes MODIFY curse_id BIGINT UNSIGNED NULL');
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn(['course_name', 'teacher_name', 'capacity', 'status']);
        });
    }
}
