<?php

use Illuminate\Database\Seeder;
use App\Models\Inscription_model;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inscriptions = [
            [
                'name' => 'Domingos Kiala',
                'email' => 'domingos.kiala@gmail.com',
                'phone' => '+244 923 111 222',
                'bi' => '004819231LA042',
                'course' => 'Redes e Infraestruturas de TI',
                'status' => 'pendente',
                'pagamento_info' => '⏳ Pendente nas Finanças — Aguardando Pagamento',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'name' => 'Ana Paula Neto',
                'email' => 'ana.neto@hotmail.com',
                'phone' => '+244 912 333 444',
                'bi' => '009218342LA012',
                'course' => 'Sistemas Fotovoltaicos',
                'status' => 'aprovado',
                'pagamento_info' => '✅ Confirmado pelas Finanças — Pago',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'name' => 'Fernando Bumba',
                'email' => 'fernando.bumba@outlook.com',
                'phone' => '+244 934 555 666',
                'bi' => '001928341LA099',
                'course' => 'Soldagem e Caldeiraria',
                'status' => 'pendente',
                'pagamento_info' => '⏳ Pendente nas Finanças — Aguardando Pagamento',
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(9),
            ],
            [
                'name' => 'Marta Cassinda',
                'email' => 'marta.cassinda@gmail.com',
                'phone' => '+244 945 777 888',
                'bi' => '003829102LA055',
                'course' => 'Electricidade Industrial',
                'status' => 'aprovado',
                'pagamento_info' => '✅ Confirmado pelas Finanças — Pago',
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
        ];

        foreach ($inscriptions as $data) {
            Inscription_model::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
