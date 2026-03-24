<?php

namespace App\Models;

use CodeIgniter\Model;

class DossierMovementModel extends Model
{
     protected $table = 'movimientos_expediente';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // También puede ser 'object' si lo prefieres
    protected $useSoftDeletes   = false;


 

    protected $allowedFields = [
        'expediente_id',
        'departamento_origen',
        'departamento_destino',
        'usuario_id',
        'comentario',
        'fecha'
    ];

    protected $useTimestamps = false;



}
