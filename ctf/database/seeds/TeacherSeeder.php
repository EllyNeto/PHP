<?php

use Illuminate\Database\Seeder;
use App\Models\TeacherModel;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            ['name' => 'João Baptista', 'email' => 'joao.baptista@cinfotec.co.ao', 'bi' => '004819231LA041', 'phone_number' => '+244 923 100 200'],
            ['name' => 'Manuel Sacaia', 'email' => 'manuel.sacaia@cinfotec.co.ao', 'bi' => '009218342LA011', 'phone_number' => '+244 912 300 400'],
            ['name' => 'Isabel Chindenga', 'email' => 'isabel.chindenga@cinfotec.co.ao', 'bi' => '001928341LA098', 'phone_number' => '+244 934 500 600'],
            ['name' => 'Carlos Muatxinene', 'email' => 'carlos.muatxinene@cinfotec.co.ao', 'bi' => '003829102LA054', 'phone_number' => '+244 945 700 800'],
        ];

        foreach ($teachers as $data) {
            TeacherModel::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
