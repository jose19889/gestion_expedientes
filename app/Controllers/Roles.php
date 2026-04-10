<?php
namespace App\Controllers;
use App\Models\RoleModel;
use CodeIgniter\Controller;


class Roles extends BaseController
{

    public function __construc(){
        $this->load->database();
        $db  = \Config\Database::connect();
        $builder = $db->table('roles');
      }
      

    public function index(): string{
        $RoleModel = new RoleModel();
       $data['roles'] = $RoleModel->orderBy('id', 'DESC')->findAll();
   
        return view('roles/index', $data);
    }

    public function create(): string{
        
        $RoleModel = new RoleModel();
        return view('roles/create');
    }

  public function insert()
{
    helper(['form', 'url']);
    $session = session();

    // Solo procesar si viene POST
    if ($this->request->getMethod() === 'post') {

        // Reglas de validación
        $rules = [
            'role_name'   => 'required|min_length[3]|max_length[50]',
            'description' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            // Si falla validación
            $session->setFlashdata('danger', 'Cuidado, los datos no se insertaron. Revise el formulario.');
            return redirect()->to(site_url('roles-create'))->withInput();
        }

        // Modelo
        $roleModel = new \App\Models\RoleModel();

        // Datos a guardar
        $roleData = [
            'role_name'   => $this->request->getPost('role_name'),
            'description' => $this->request->getPost('description'),
        ];

        // Guardar en DB
        $roleModel->save($roleData);

        // Mensaje de éxito
        $session->setFlashdata('success', 'Rol creado con éxito!');
        return redirect()->to(site_url('roles-list'));
    }

    // Si no es POST, redirigir
    return redirect()->to(site_url('roles-create'));
}

    // show single user
    public function edit($id = null){
        $roleModel = new RoleModel();
        $data['role_obj'] = $roleModel->where('id', $id)->first();
        return view('roles/edit', $data);
    }


     // update user data

    

  public function update(){
       

    helper(['form', 'url']);
    //$user_id= $model->find($id);
    
    $data = [
            'role_name' => $this->request->getVar('role_name'),
            'description' => $this->request->getVar('description'),
            
        ];

        //print_r($data); // Add this line to debug

  
    $session = session();
    $model = new RoleModel();
    $id = $this->request->getVar('id') ;

    $model ->update($id, $data);
    echo $session->setFlashdata('success', '<p class="text-success">Roles actualizados con exito!<p/>');
    return $this->response->redirect(site_url('/roles-list'));

    //var_dump($id);
    
}

    public function delete($id = null){
        $roleModel = new RoleModel();
        $data['role'] = $roleModel->where('id', $id)->delete($id);
        $session = \Config\Services::session();
        echo $session->setFlashdata('danger', '<p class="small">Cuidado el registro fue borrado !</>');
        return $this->response->redirect(site_url('/roles-list'));
    }    



    
}
