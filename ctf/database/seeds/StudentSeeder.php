<?php

use Illuminate\Database\Seeder;
use App\Models\StudentModel;
use App\Models\Inscription_model;
use App\Models\ClasseModel;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inscriptions = Inscription_model::all();

        foreach ($inscriptions as $inscription) {
            $turma = ClasseModel::where('course_name', $inscription->course)->first();
            if ($turma) {
                StudentModel::updateOrCreate(
                    [
                        'inscription_id' => $inscription->id,
                        'classe_id' => $turma->id,
                    ],
                    [
                        'inscription_id' => $inscription->id,
                        'classe_id' => $turma->id,
                    ]
                );
            }
        }
    }
}
