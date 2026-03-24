<?php

namespace App\Controllers;
use App\Models\ReportModel;
use CodeIgniter\Database\ConnectionInterface;
use App\Models\EmailsModel;
use App\Models\NewsModel;
use App\Models\EntityModel;
use App\Models\EntityTypeModel;
use App\Models\TipoDenunciaModel;
class Home extends BaseController
{
    public function index(): string{

    $wpModel = new EmailsModel();

    // Get the statistics for tipo_denuncia
    $statistics = $wpModel->getDenunciaStatistics();

    // Prepare the data for the chart
    $labels = [];
    $data = [];

    foreach ($statistics as $stat) {
        $labels[] = $stat['tipo_denuncia'];
        $data[] = $stat['count'];
    }

    // Pass the labels and data to the view
    $data['labels'] = json_encode($labels); // Convert to JSON for use in JS
    $data['data'] = json_encode($data);     // Convert to JSON for use in JS

    if (!session()->has('id')){
        return view('welcome_message',$data);
    }

    
    }

    public function portal(){
         $newsModel = new NewsModel();
        $data['posts'] = $newsModel->getRecentPosts(4);
         return view('portal/index',$data);
    }


   /* public function report_page(){
    
        $entityTypeModel = new EntityTypeModel();
        $tipodenuncias=  new DenunciaModel();
        $entity_types = $entityTypeModel->findAll(); // Fetch entity types for dropdown

        return view('portal/report-form', ['entity_types' => $entity_types]);
    }*/

  public function report_page()
{
    // Load models
    $entityTypeModel    = new EntityTypeModel();
    $tipoDenunciaModel  = new TipoDenunciaModel();
    $entityTypesModel        = new EntityTypeModel();

    // Prepare data from models
    $data = [
        'entity_types'   => $entityTypeModel->findAll(),
        'tipo_denuncias' => $tipoDenunciaModel->findAll(),
        //'entity_types'        => $reportModel->findAll(),
    ];

    // Load view with all data
    return view('portal/report-form', $data);
}


 public function getEntitiesByType($typeId)
    {
        $model = new EntityModel();
        $entities = $model->where('entity_type_id', $typeId)->findAll();

        return $this->response->setJSON($entities);
    }

public function saveDenuncia()
{
    helper(['form', 'url']);

    $otrosId = 4;

    $rules = [
        'institucion'       => 'required',
        'direccion_seccion' => 'required',
        'tipo_denuncia_id'  => 'required',
        'titulo'            => 'required|min_length[5]|max_length[255]',
        'mensaje'           => 'required|min_length[10]',
    ];

    if ($this->request->getPost('applicant_info_visible') == '1') {
        $rules['name']             = 'required|min_length[3]|max_length[100]';
        $rules['surname']          = 'required|min_length[3]|max_length[100]';
        $rules['tipo_documento']   = 'required';
        $rules['numero_documento'] = 'required';
        $rules['tipo_contacto']    = 'required';
        $rules['contacto']         = 'required';
    }

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    //$data['tipo_documento'] = $this->request->getPost('tipo_documento') ?? '';
    $data = [
        'name'              => $this->request->getPost('name'),
        'surname'           => $this->request->getPost('surname'),
        'tipo_documento'    => $this->request->getPost('tipo_documento') ?? '',
        'numero_documento'  => $this->request->getPost('numero_documento'),
        'tipo_contacto'     => $this->request->getPost('tipo_contacto') ?? '',
        'contacto'          => $this->request->getPost('contacto'),
        'entity_type_id'    => $this->request->getPost('institucion'),
        'entity_id'         => $this->request->getPost('direccion_seccion'),
        'otro_nombre'       => $this->request->getPost('otro_nombre'),
        'titulo_denuncia'   => $this->request->getPost('titulo'),
        'tipo_denuncia_id'  => $this->request->getPost('tipo_denuncia_id'),
        'descripcion_denuncia' => $this->request->getPost('mensaje'),
    ];

    if ($data['entity_type_id'] == $otrosId && empty($data['otro_nombre'])) {
        return redirect()->back()->withInput()->with('error', 'Debe especificar el nombre de la institución en "Otros".');
    }

    $file = $this->request->getFile('archivo');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/files', $newName);
        $data['archivo_path'] = 'uploads/files/' . $newName;
    } else {
        $data['archivo_path'] = null;
    }

    $reports = new ReportModel();
    if ($reports->insert($data)) {
       //return redirect()->to('report-page')->with('message', 'Denuncia enviada correctamente.');
         $session = session();
        echo $session->setFlashdata('success', '<p class="text-success">Denuncia enviada con exito -codigo seguieinto "" !<p/>');
                return $this->response->redirect(site_url('report-page'));
    } else {
        return redirect()->back()->withInput()->with('error', 'Error al guardar la denuncia.');
    }
}


}
