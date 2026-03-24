<?php

namespace App\Controllers;
use App\Models\CatsModel;

class Categories extends BaseController
{
    public function index(): string{

        $CatsModel= new CatsModel();
        $data['tipo_denuncias'] = $CatsModel->orderBy('id', 'DESC')->findAll();
        return view('reports/cats/index', $data);
    }


    public function create(): string

    {
        return view('reports/cats/create');
    }

    
    public function insert(){
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();
    
            $rules = [
                "name" => [
                    "label" => "First Name", 
                    "rules" => "required|min_length[3]|max_length[20]"
                ],
                "descp" => [
                    "label" => "Last Name", 
                    "rules" => "required|min_length[3]|max_length[20]"
                ],
         
            ];
            if ($this->validate($rules)) {
    
                $cat = new CatsModel();
                $catdata = [
                    "name" => $this->request->getVar("name"),
                    "descp" => $this->request->getVar("descp"),
                  
                ];
                $cat->save($catdata);
                $session = session();
                 echo $session->setFlashdata('success', '<p class="text-success">Tipo de denuncias creado con exito!<p/>');
                return $this->response->redirect(site_url('/cats-list'));

            } else {
                $session = session();
                $session->setFlashData("danger", '<p class="text-danger"> Cuidado los datos no se insertaron  </p>');
                return $this->response->redirect(site_url('/cats-create'));

            }
        }
       

    }

    // show single user
    public function edit($id = null)
    { $catModel = new CatsModel();
        $data['cat_obj'] = $catModel->where('id', $id)->first();
        return view('reports/cats/edit', $data);}


     // update user data
     public function update(){
       

        $rules = [
            "name" => [
                "label" => "First Name", 
                "rules" => "required|min_length[3]|max_length[20]"
            ],
            "descp" => [
                "label" => "Last Name", 
                "rules" => "required|min_length[3]|max_length[20]"
            ],
     
        ];
        

        if ($this->validate($rules)) {
            
           
                $cat_model = new catModel();
                //$cat = Cat::where('id', $request->cat_id)->first();
                $cats = $cat_model->where('id', $request->id)->first();
                $cats->name= $this->request->getVar("name");
                $cats->name= $this->request->getVar("descp");

                
                // $catdata = [
                  
                //     "name" => $this->request->getVar("name"),
                //     "descp" => $this->request->getVar("descp"),
                  
                // ];
               
                $cat->save( $catdata);
                
                
                $session = session();
                 echo $session->setFlashdata('success', '<p class="text-success">cats actualizado con exito!<p/>');
                return $this->response->redirect(site_url('/cats-list'));

            } else {
                $session = session();
                $session->setFlashData("danger", '<p class="text-success"> Cuidado los datos no se insertaron  </p>');
                return $this->response->redirect(site_url('/cats-create'));

            }
        
        
    }

    public function delete($id = null){
        $catModel = new CatsModel();
        $data['cat'] = $catModel->where('id', $id)->delete($id);
        $session = \Config\Services::session();
        echo $session->setFlashdata('danger', '<p class="text-danger">Cuidado el registro fue borrado !</>');
        return $this->response->redirect(site_url('/cats-list'));
    }    

}
