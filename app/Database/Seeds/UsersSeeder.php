<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Los usuarios a crear
        $data = [
            [
                'nombre'        => 'José',
                'apellido'      => 'Martín',
                'email'         => 'admin@gmail.com',
                'password'      => password_hash('1234', PASSWORD_DEFAULT), // contraseña en claro: 1234
                'role_id'       => 1, // rol de admin
              
                'estado'        => 'activo',
                'profile_image' => 'default.png',
            ],
            [
                'nombre'        => 'Ana',
                'apellido'      => 'Gómez',
                'email'         => 'admin2@ademy.com',
                'password'      => password_hash('1234', PASSWORD_DEFAULT), // contraseña en claro: 1234
                'role_id'       => 2, // rol de usuario normal
                'role_name'     => 'user',
                'estado'        => 'activo',
                'profile_image' => 'default.png',
            ],
            [
                'nombre'        => 'Edu',
                'apellido'      => 'López',
                'email'         => 'user1@ademy.com',
                'password'      => password_hash('1234', PASSWORD_DEFAULT), // contraseña en claro: 1234
                'role_id'       => 2,
               
                'estado'        => 'activo',
                'profile_image' => 'default.png',
            ],

             [
                'nombre'        => 'Edus',
                'apellido'      => 'López',
                'email'         => 'admin@ademy.com',
                'password'      => password_hash('1234', PASSWORD_DEFAULT), // contraseña en claro: 1234
                'role_id'       => 2,
              
                'estado'        => 'activo',
                'profile_image' => 'default.png',
            ],
        ];

        // Insertar en la tabla 'usuarios'
        $this->db->table('usuarios')->insertBatch($data);
    }
}