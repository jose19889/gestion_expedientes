<?php

namespace App\Controllers;
use App\Models\LoginModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\DeptsModel;

class Login extends BaseController
{

    public function sign_in(): string
    {
        helper(['form']);
        return view('auth/login');
    }


public function auth()
{
    $session = session();
    $model = new \App\Models\UserModel();

    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    // Buscar usuario por email
    $user = $model->getUserByEmail($email);

    if ($user) {

        // Verificar que el usuario esté activo
        if ($user['estado'] !== 'activo') {
            $session->setFlashdata('danger', '<p class="text-danger">Usuario inactivo o bloqueado</p>');
            return redirect()->to('/sign-in');
        }

        // Verificar contraseña
        if (password_verify($password, $user['password'])) {

            // Preparar datos de sesión
            $ses_data = [
                 'user_id'       => $user['id'], // ahora sí coincide
                'nombre'        => $user['nombre'],
                'apellido'      => $user['apellido'],
                'email'         => $user['email'],
                'role_id'       => $user['role_id'],               // id del rol
                'role_name'     => $user['role_name'],             // nombre del rol
                'departamento_id'=> $user['departamento_actual'], // ⚡ acceder como array
                'profile_image' => !empty($user['profile_image']) ? $user['profile_image'] : 'default.png',
                'logged_in'     => true
            ];

            $session->set($ses_data);

            // Redirigir al dashboard con mensaje
            $session->setFlashdata('success', '<p class="text-success">¡Bienvenido al dashboard!</p>');
            return redirect()->to('/home');

        } else {
            // Contraseña incorrecta
            $session->setFlashdata('danger', '<p class="text-danger">Contraseña incorrecta</p>');
            return redirect()->to('/sign-in');
        }

    } else {
        // Email no encontrado
        $session->setFlashdata('danger', '<p class="text-danger">Email no encontrado</p>');
        return redirect()->to('/sign-in');
    }
}
     public function logout()
{
    $session = session();
    $session->destroy();
    return redirect()->to('/sign-in');
}

/**
 * **** SECURE RESTORE MDOEULE
 * @var array
 */
public $globals = [
    'before' => [
        'auth' => ['except' => ['login/*', 'register/*', '/']], // Ejemplo
        // Asegúrate de que 'migration/*' esté protegido aquí
    ],
];


}
