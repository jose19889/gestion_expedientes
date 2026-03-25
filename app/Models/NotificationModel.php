<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'notificaciones';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'usuario_id',
        'departamento_id',
        'titulo',
        'mensaje',
        'tipo',
        'expediente_id',
        'leido',
        'created_at'
    ];

    protected $useTimestamps = false; // ya usas created_at manualmente
}