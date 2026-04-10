<?php
namespace App\Models;

use CodeIgniter\Model;

class TipoDossierModel extends Model
{
    protected $table      = 'tipos_expedientes'; // Nombre de la tabla
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre']; // Campos que se pueden insertar/actualizar

    // Opcional: manejar timestamps automáticos
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}