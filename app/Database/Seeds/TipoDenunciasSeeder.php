<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoDenunciasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Abuso sexual'],
            ['nombre' => 'Agresión'],
            ['nombre' => 'Fornicación'],
            ['nombre' => 'Extorsión'],
            ['nombre' => 'Abuso de poder'],
        ];

        $this->db->table('tipo_denuncias')->insertBatch($data);
    }
}
