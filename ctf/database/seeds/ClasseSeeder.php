<?php

use Illuminate\Database\Seeder;
use App\Models\ClasseModel;
use App\Models\CourseModel;
use App\Models\TeacherModel;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'code' => 'T-TIC204-A',
                'name' => 'Turma A - Redes',
                'course_name' => 'Redes e Infraestruturas de TI',
                'teacher_name' => 'João Baptista',
                'schedule' => 'Seg/Qua/Sex · 08h–12h',
                'enrolled' => 24,
                'capacity' => 25,
                'status' => 'Em Curso',
            ],
            [
                'code' => 'T-ELM118-B',
                'name' => 'Turma B - Electricidade',
                'course_name' => 'Electricidade Industrial',
                'teacher_name' => 'Manuel Sacaia',
                'schedule' => 'Ter/Qui · 14h–18h',
                'enrolled' => 18,
                'capacity' => 20,
                'status' => 'Em Curso',
            ],
            [
                'code' => 'T-MPR072-A',
                'name' => 'Turma A - Soldagem',
                'course_name' => 'Soldagem e Caldeiraria',
                'teacher_name' => 'Isabel Chindenga',
                'schedule' => 'Seg–Sex · 07h–11h',
                'enrolled' => 15,
                'capacity' => 18,
                'status' => 'A Iniciar',
            ],
            [
                'code' => 'T-ENR055-A',
                'name' => 'Turma A - Fotovoltaicos',
                'course_name' => 'Sistemas Fotovoltaicos',
                'teacher_name' => 'Carlos Muatxinene',
                'schedule' => 'Sáb · 08h–17h',
                'enrolled' => 20,
                'capacity' => 22,
                'status' => 'Em Curso',
            ],
        ];

        foreach ($classes as $data) {
            $course = CourseModel::where('name', $data['course_name'])->first();
            $teacher = TeacherModel::where('name', $data['teacher_name'])->first();

            $data['course_id'] = $course ? $course->id : null;
            $data['teacher_id'] = $teacher ? $teacher->id : null;

            ClasseModel::updateOrCreate(['code' => $data['code']], $data);
        }
    }
}
