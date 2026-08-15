<?php

use Illuminate\Database\Seeder;
use App\Models\CourseModel;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Redes e Infraestruturas de TI',
                'type' => 'Técnico',
                'description' => 'Tecnologias de Informação',
                'duration' => 9,
            ],
            [
                'name' => 'Electricidade Industrial',
                'type' => 'Técnico',
                'description' => 'Electricidade e Mecatrónica',
                'duration' => 6,
            ],
            [
                'name' => 'Soldagem e Caldeiraria',
                'type' => 'Qualificação',
                'description' => 'Mecânica e Produção',
                'duration' => 4,
            ],
            [
                'name' => 'Metrologia Dimensional',
                'type' => 'Aperfeiçoamento',
                'description' => 'Metrologia',
                'duration' => 3,
            ],
            [
                'name' => 'Sistemas Fotovoltaicos',
                'type' => 'Técnico',
                'description' => 'Energias Renováveis',
                'duration' => 6,
            ],
        ];

        foreach ($courses as $data) {
            CourseModel::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
