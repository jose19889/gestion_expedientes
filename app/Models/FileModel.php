<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table            = 'archivos_adjuntos';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'expediente_id',
        'nombre_original',
        'ruta_archivo',
        'tipo',
        'subido_por'
    ];

    // Dejamos que MySQL maneje la fecha con DEFAULT CURRENT_TIMESTAMP
    protected $useTimestamps = false;

/*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
   
    public function getByExpediente($expediente_id)
{
    return $this->where('expediente_id', $expediente_id)
                ->orderBy('id', 'DESC')
                ->findAll();
}
}

