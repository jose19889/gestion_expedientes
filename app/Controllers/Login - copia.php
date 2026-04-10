<?php

namespace App\Controllers;
use App\Models\LoginModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
class Login extends BaseController
{


 

    public function index(): string
    {
        helper(['form']);
        return view('auth/login');
    }


    
  
    public function auth()
    {
       $session = session();
$model = new UserModel();
$email = $this->request->getVar('email');
$password = $this->request->getVar('password');

// Fetch user data based on the email
//$data = $model->where('email', $email)->first();
 $data = $model->getUserByEmail($email); // Use the modified method

if ($data) {
    // If user exists, verify the password
    $pass = $data['password'];
    $verify_pass = password_verify($password, $pass);

    if ($verify_pass) {
        // If password is correct, set session data
        $ses_data = [
            'id'       => $data['id'],
            'username'     => $data['username'],
            'email'   => $data['email'],
            'role_id'=>$data['role_id'],
             'role_name'=>$data['role_name'],
            'logged_in'=> TRUE
        ];

        $session->set($ses_data);

        // Set flashdata for success and redirect
        $session->setFlashdata('success', '<p class="text-success">Welcome to the dashboard!</p>');
        return redirect()->to('home');
    } else {
        // If password is incorrect
        $session->setFlashdata('danger', '<p class="text-danger">Wrong Password</p>');
        return redirect()->to('/login');
    }
} else {
    // If user with the given email does not exist
    $session->setFlashdata('danger', '<p class="text-danger">Email not found</p>');
    return redirect()->to('/login');
}

       
    }
    
      function logout(){
          $this->session->sess_destroy();
          redirect('login');
      }


}
