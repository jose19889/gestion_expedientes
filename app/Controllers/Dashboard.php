<?php

namespace App\Controllers;
use CodeIgniter\Database\ConnectionInterface;
use App\Models\DossierModel;
use App\Models\StatusModel;
use App\Models\RoleModel;

class Dashboard extends BaseController
{
    public function index(): string{

     $wpModel = new DossierModel();

    // Get the statistics for tipo_denuncia
    $statistics = $wpModel->getStatistics();

    // Prepare the data for the chart
    $labels = [];
    $data = [];

    //count denuncias and states
   /* foreach ($statistics as $stat) {
        $labels[] = $stat['estado'];
        $data[] = $stat['count'];
    }*/

    // Pass the labels and data to the view
    $data['labels'] = json_encode($labels); // Convert to JSON for use in JS
    $data['data'] = json_encode($data);     // Convert to JSON for use in JS

    /*$data['emails'] =  $wpModel ->orderBy('id', 'DESC')->findAll();
    $data['total_denuncias']= $wpModel->countAllResults();
    $data['falsas']= $wpModel->where('status_id', '2')->countAllResults();
     $data['en_proceso']= $wpModel->where('status_id', '3')->countAllResults();
      $data['finalizado']= $wpModel->where('status_id', '4')->countAllResults();*/

    {
       
     return view('dashboard',$data);


    }

    
}
}
    


