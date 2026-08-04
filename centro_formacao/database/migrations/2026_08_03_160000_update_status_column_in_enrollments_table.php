<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateStatusColumnInEnrollmentsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE enrollments MODIFY status VARCHAR(50) NOT NULL DEFAULT 'Em análise'");
        DB::statement("UPDATE enrollments SET status = 'Confirmada' WHERE status = '1'");
        DB::statement("UPDATE enrollments SET status = 'Em análise' WHERE status = '0'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE enrollments MODIFY status TINYINT(1) NOT NULL DEFAULT 1");
    }
}
