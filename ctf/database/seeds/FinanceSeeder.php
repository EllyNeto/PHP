<?php

use Illuminate\Database\Seeder;
use App\Models\Finance_model;
use App\Models\Inscription_model;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'student_name' => 'Domingos Kiala',
                'course' => 'Redes e Infraestruturas de TI',
                'amount' => 45000,
                'method' => 'Multicaixa',
                'payment_date' => now()->subDays(7),
                'status' => 'pago',
                'description' => 'Propina de Agosto',
            ],
            [
                'student_name' => 'Ana Paula Neto',
                'course' => 'Sistemas Fotovoltaicos',
                'amount' => 38000,
                'method' => 'Transferência',
                'payment_date' => now()->subDays(9),
                'status' => 'pago',
                'description' => 'Propina de Agosto',
            ],
            [
                'student_name' => 'Fernando Bumba',
                'course' => 'Soldagem e Caldeiraria',
                'amount' => 30000,
                'method' => 'Numerário',
                'payment_date' => now()->subDays(23),
                'status' => 'em_atraso',
                'description' => 'Propina de Julho',
            ],
            [
                'student_name' => 'Marta Cassinda',
                'course' => 'Electricidade Industrial',
                'amount' => 42000,
                'method' => 'Multicaixa',
                'payment_date' => now()->subDays(11),
                'status' => 'pago',
                'description' => 'Propina de Agosto',
            ],
        ];

        foreach ($payments as $data) {
            $inscription = Inscription_model::where('name', $data['student_name'])->first();
            if ($inscription) {
                $data['inscription_id'] = $inscription->id;
                $data['student_name'] = $inscription->name;
                $data['course'] = $inscription->course;
            }

            Finance_model::updateOrCreate(
                [
                    'student_name' => $data['student_name'],
                    'course' => $data['course']
                ],
                $data
            );
        }
    }
}
