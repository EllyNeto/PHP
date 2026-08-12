<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        if (Schema::hasTable('inscriptions')) {
            Schema::table('inscriptions', function (Blueprint $table) {
                if (!Schema::hasColumn('inscriptions', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }

        if (Schema::hasTable('finance')) {
            Schema::table('finance', function (Blueprint $table) {
                if (!Schema::hasColumn('finance', 'deleted_at')) {
                    $table->softDeletes();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }

        if (Schema::hasTable('inscriptions')) {
            Schema::table('inscriptions', function (Blueprint $table) {
                if (Schema::hasColumn('inscriptions', 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }

        if (Schema::hasTable('finance')) {
            Schema::table('finance', function (Blueprint $table) {
                if (Schema::hasColumn('finance', 'deleted_at')) {
                    $table->dropSoftDeletes();
                }
            });
        }
    }
}
