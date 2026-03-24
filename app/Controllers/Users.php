<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\DeptsModel;
use CodeIgniter\Controller;

class Users extends Controller
{

      public function __construct() {
         // Load the helper here
       // helper('role'); // Replace 'your_helper_name' with the actual name of the helper
        // Connect to WordPress database
       }

    public function index()
    {

        // Load the helper explicitly if not autoloaded
         //$isAdmin = hasRole('admin'); // Pass the role you want to check
        $UserModel= new UserModel();
        $RoleModel= new RoleModel();
        $DeptsModel= new DeptsModel();

        

      $data['query'] = $UserModel->getuserinfo();
       ///var_dump($data);
       return view('users/index', $data);
   
    }

    public function create()
    {

        $UserModel= new UserModel();
        $RoleModel= new RoleModel();
        $DeptsModel= new DeptsModel();

        $data=[
            'users'=>$UserModel->orderBy('id', 'DESC')->findAll(),
            'roles'=>$RoleModel->orderBy('id', 'DESC')->findAll(),
            'departamentos'=>$DeptsModel->orderBy('id', 'DESC')->findAll(),
        ];
        //$data['usersroles'] = $UserModel->orderBy('id', 'DESC')->findAll();
        return view('users/create', $data);

    }
public function insert()
{
    helper(['form', 'url']);
    
    if ($this->request->getMethod() == "post") {
        $validation = \Config\Services::validation();

        $rules = [
            "nombre"          => "required",
            "apellido"        => "required",
            "email"           => "required|valid_email|is_unique[usuarios.email]",
            "role_id"         => "required",
            "departamento_id" => "required",
            "contacto"        => "required",
            "password"        => "required|min_length[6]|max_length[15]"
        ];

        if ($this->validate($rules)) {

            $user = new UserModel();

            $profileImageName = null;
            $file = $this->request->getFile('profile_image');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $profileImageName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/profiles/', $profileImageName);
            }

            $userdata = [
                "nombre"          => $this->request->getVar("nombre"),
                "apellido"        => $this->request->getVar("apellido"),
                "email"           => $this->request->getVar("email"),
                "role_id"         => $this->request->getVar("role_id"),
                "departamento_id" => $this->request->getVar("departamento_id"),
                "contacto"        => $this->request->getVar("contacto"),
                "password"        => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                "profile_image"   => $profileImageName
            ];

            $user->save($userdata);

            session()->setFlashdata('success', 'Usuario creado con éxito!');
            return redirect()->to(site_url('/users-list'));

        } else {
            session()->setFlashdata('danger', 'Error: revisa los datos ingresados.');
            return redirect()->to(site_url('/users-create'))->withInput();
        }
    }
}

    public function edit($id = null){
        $userModel = new UserModel();
        $roleModel = new RoleModel();
          $DeptsModel= new DeptsModel();
        $data['user_obj'] = $userModel->where('id', $id)->first();
        $data['query'] = $userModel->getuserinfo();
        $data['roles'] = $roleModel->getroles();
        $data['departamentos'] = $DeptsModel->getdepts();
     return view('users/edit', $data); 
    }
 

     // update user data
     
  public function update()
{
    helper(['form', 'url']);
    $session = session();
    $model = new UserModel();
    $id = $this->request->getVar('id');

    // Recolectamos los datos del formulario
    $data = [
        'nombre'        => $this->request->getVar('nombre'),
        'apellido'      => $this->request->getVar('apellido'),
        'email'         => $this->request->getVar('email'),
        'contacto'      => $this->request->getVar('contacto'),
        'role_id'       => $this->request->getVar('role_id'),
        'departamento_id' => $this->request->getVar('departamento_id'),
    ];

    // Manejo de subida de imagen (opcional)
    $profileImage = $this->request->getFile('profile_image');
    if ($profileImage && $profileImage->isValid() && !$profileImage->hasMoved()) {
        $newName = $profileImage->getRandomName();
        $profileImage->move(WRITEPATH . 'uploads/profiles', $newName);
        $data['profile_image'] = $newName;

        // Opcional: eliminar la imagen anterior si existe
        $oldUser = $model->find($id);
        if (!empty($oldUser['profile_image']) && file_exists(WRITEPATH . 'uploads/profiles/' . $oldUser['profile_image'])) {
            unlink(WRITEPATH . 'uploads/profiles/' . $oldUser['profile_image']);
        }
    }

    // Actualizamos el usuario
    $model->update($id, $data);

    $session->setFlashdata('success', '<p class="text-success">Usuario actualizado con éxito!</p>');
    return redirect()->to(site_url('/users-list'));
}

    public function delete($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);
        $session = \Config\Services::session();
        echo $session->setFlashdata('danger', '<p class="text-danger">Cuidado el registro fue borrado !</>');
        return $this->response->redirect(site_url('/users-list'));
    }    



public function changePass()
{
    $session = session();

    // Check if the user is logged in (assuming user_id is stored in the session after login)
    if (!$session->get('id')) {
        return redirect()->to('/login');  // Redirect to login page if not logged in
    }

    // Continue with password change process
    $validation = \Config\Services::validation();
    $userModel = new UserModel();
    $userId = $session->get('id');  // Get the logged-in user's ID

    if ($this->request->getMethod() === 'post') {
        // Validate the form inputs
        $validation->setRules([
            'old_password' => 'required',
            'new_password' => 'required|min_length[8]',
            'confirm_password' => 'required|matches[new_password]'
        ]);

        // Run the validation
        if ($validation->withRequest($this->request)->run() === FALSE) {
            // If validation fails, show error
            return redirect()->back()->withInput()->with('error', 'Validation failed, please check your inputs.');
        }

        // Get old password, new password, and confirm password from the form
        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        // Fetch the user's current data from the database
        $user = $userModel->find($userId);

        // Check if the old password is correct
        if (!password_verify($oldPassword, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Old password is incorrect');
        }

        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the user's password in the database
        $userModel->update($userId, ['password' => $hashedNewPassword]);

        // Set success flashdata message
        $session->setFlashdata('success', '<p class="text-success" >Clave Modificada con exito.</p>');

       return $this->response->redirect(site_url('/home'));
    }

    // If the method is GET, show the change password form
    return view('auth/change-pass');
}





public function upload_userImage(){


    return view('users/profile'); 
}
    

    public function update_photo(){
        $session = session();

        // Get the logged-in user's ID (you may store this in the session after the user logs in)
        $userId = $session->get('id');

        // Validate the uploaded image
        if (!$this->validate([
            'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|max_size[profile_image,2048]|mime_in[profile_image,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Invalid image file. Please upload a valid image (jpg, jpeg, png).');
        }

        // Process the uploaded image
        $file = $this->request->getFile('profile_image');

        // Generate a unique name for the image to avoid conflicts
        $newName = $file->getRandomName();

        // Move the image to the public/uploads directory
        if ($file->move(ROOTPATH . 'uploads/profiles', $newName)) {
            // Store the new file name in the database for the user
            $userModel = new UserModel();
            $userModel->update($userId, [
                'profile_image' => $newName // Update the user's profile image in the database
            ]);

            // Set success message and redirect
            $session->setFlashdata('success', 'Profile image updated successfully!');
            return redirect()->to('/home'); // Redirect to profile page
        } else {
            return redirect()->back()->with('error', 'There was an error uploading the image.');
        }


}


 public function reset_password()
    {
        // Retrieve the user ID from the POST request
        $userId = $this->request->getVar('user_id');

        // Validate that the user ID is provided
        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid user ID']);
        }

        // Load UserModel
        $userModel = new UserModel();

        // Generate a random password (you can customize this logic)
       $newPassword = '123456789';

        // Find the user by ID
        $user = $userModel->find($userId);
        
        if ($user) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $userModel->update($userId, ['password' => $hashedPassword]);

            // Optionally, return the new password (for demonstration purposes)
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Password reset successful',
                'new_password' => $newPassword // Optional: Send the new password back to frontend for display or logging
            ]);
        }

        // If user is not found
        return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
    }


}
