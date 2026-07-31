<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEnrollmentsForRegistrationForm extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE enrollments DROP FOREIGN KEY enrollments_class_id_foreign');
        DB::statement('ALTER TABLE enrollments MODIFY class_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE enrollments ADD course VARCHAR(100) NOT NULL AFTER bilhete_identidade');
        DB::statement('ALTER TABLE enrollments MODIFY phone VARCHAR(30) NOT NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE enrollments DROP COLUMN course');
        DB::statement('ALTER TABLE enrollments MODIFY phone INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE enrollments MODIFY class_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE enrollments ADD CONSTRAINT enrollments_class_id_foreign FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE');
    }
}
