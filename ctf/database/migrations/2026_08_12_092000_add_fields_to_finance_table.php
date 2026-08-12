<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('finance', function (Blueprint $table) {
            if (!Schema::hasColumn('finance', 'inscription_id')) {
                $table->unsignedBigInteger('inscription_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('finance', 'student_name')) {
                $table->string('student_name')->nullable()->after('inscription_id');
            }
            if (!Schema::hasColumn('finance', 'course')) {
                $table->string('course')->nullable()->after('student_name');
            }
            if (!Schema::hasColumn('finance', 'method')) {
                $table->string('method')->default('Multicaixa')->after('amount');
            }
            if (!Schema::hasColumn('finance', 'payment_date')) {
                $table->dateTime('payment_date')->nullable()->after('method');
            }
            if (!Schema::hasColumn('finance', 'description')) {
                $table->string('description')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('finance', function (Blueprint $table) {
            if (Schema::hasColumn('finance', 'inscription_id')) {
                $table->dropColumn('inscription_id');
            }
            if (Schema::hasColumn('finance', 'student_name')) {
                $table->dropColumn('student_name');
            }
            if (Schema::hasColumn('finance', 'course')) {
                $table->dropColumn('course');
            }
            if (Schema::hasColumn('finance', 'method')) {
                $table->dropColumn('method');
            }
            if (Schema::hasColumn('finance', 'payment_date')) {
                $table->dropColumn('payment_date');
            }
            if (Schema::hasColumn('finance', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
}
