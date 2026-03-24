<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class DenunciasController extends ResourceController
{
    protected $modelName = 'App\Models\DenunciasModel';
    
    protected $format    = 'json';

    // GET /api/v1/denuncias
    public function index()
    {
        $data = $this->model
            ->orderBy('id', 'titulo_denuncia')
            ->findAll();

        return $this->respond($data);
    }

    // GET /api/v1/denuncias/{id}
    public function show($id = null)
    {
        $denuncia = $this->model->find($id);

        if (!$denuncia) {
            return $this->failNotFound("La denuncia con ID $id no existe");
        }

        return $this->respond($denuncia);
    }

    // POST /api/v1/denuncias
    public function create()
    {
        $rules = [
            'your_name'        => 'required',
            'apellidos'        => 'required',
            'menu_documentos'  => 'required',
            'menu_contacto'    => 'required',
            'mensaje'          => 'required',
            'id_estado'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Recibir todos los datos POST
        $data = [
            'cfdb7_status'        => $this->request->getPost('cfdb7_status'),
            'your_name'           => $this->request->getPost('your_name'),
            'apellidos'           => $this->request->getPost('apellidos'),
            'menu_documentos'     => $this->request->getPost('menu_documentos'),
            'text_592'            => $this->request->getPost('text_592'),
            'menu_contacto'       => $this->request->getPost('menu_contacto'),
            'contacto_mail_tel'   => $this->request->getPost('contacto_mail_tel'),
            'menu_instituciones'  => $this->request->getPost('menu_instituciones'),
            'direccion_seccion'   => $this->request->getPost('direccion_seccion'),
            'menu_paises'         => $this->request->getPost('menu_paises'),
            'your_subject'        => $this->request->getPost('your_subject'),
            'mensaje'             => $this->request->getPost('mensaje'),
            'id_estado'           => $this->request->getPost('id_estado'),
            'comentario'          => $this->request->getPost('comentario'),
            'evidence_id'         => $this->request->getPost('evidence_id'),
        ];

        // Manejar archivo PDF del campo upload_file_112
        $file = $this->request->getFile('upload_file_112');
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/denuncias', $newName);

            $data['upload_file_112'] = $newName;
        }

        $id = $this->model->insert($data);

        return $this->respondCreated([
            "mensaje" => "Denuncia registrada correctamente",
            "id" => $id
        ]);
    }

    // PUT /api/v1/denuncias/{id}
    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound("La denuncia no existe");
        }

        $data = $this->request->getJSON(true);

        $this->model->update($id, $data);

        return $this->respond([
            "mensaje" => "Denuncia actualizada"
        ]);
    }

    // DELETE /api/v1/denuncias/{id}
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound("No existe esa denuncia");
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            "mensaje" => "Denuncia eliminada"
        ]);
    }
}
