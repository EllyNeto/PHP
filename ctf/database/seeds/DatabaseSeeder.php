<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InscriptionSeeder::class);
        $this->call(FinanceSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(ClasseSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
