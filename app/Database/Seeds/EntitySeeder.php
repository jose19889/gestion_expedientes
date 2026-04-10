<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EntitySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'entity_type_id' => 1,
                'name'      => 'Entidad Alpha',
                'desc'      => 'Descripción de la Entidad Alpha',
            ],
            [
                'entity_type_id' => 2,
                'name'      => 'Entidad Beta',
                'desc'      => 'Descripción de la Entidad Beta',
            ],
            [
                'entity_type_id' => 3,
                'name'      => 'Entidad Gamma',
                'desc'      => 'Descripción de la Entidad Gamma',
            ],
        ];

        // Insertar en la base de datos
        $this->db->table('entities')->insertBatch($data);
    }
}
