<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'expediente_logs';
    protected $primaryKey = 'id';

    
    protected $allowedFields = [
        'expediente_id',
        'usuario_id',
        'accion',
        'comentario',
        'created_at'
    ];
}