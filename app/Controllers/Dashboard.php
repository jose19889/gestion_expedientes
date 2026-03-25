<?php

namespace App\Controllers;
use CodeIgniter\Database\ConnectionInterface;
use App\Models\DossierModel;
use App\Models\StatusModel;
use App\Models\RoleModel;

class Dashboard extends BaseController
{

public function index()
{
    $model = new \App\Models\DossierModel();

    // 📊 Datos gráfica
    $result = $model->getExpedientesPorEstado();

    $labels = [];
    $data = [];

    foreach ($result as $row) {
        $labels[] = $row['estado'];
        $data[] = (int)$row['total'];
    }

    // 📋 Tabla
    $expedientes = $model->getUltimosExpedientes(10);

    return view('dashboard', [
        'labels' => json_encode($labels),
        'data' => json_encode($data),
        'expedientes' => $expedientes
    ]);
}


}
    


