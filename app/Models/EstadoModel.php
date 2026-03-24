<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table      = 'estados';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'color',
        'orden',
        'es_final'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; // Opcional, si agregas updated_at
    protected $useSoftDeletes = false;


    /**
     * Obtener todos los estados
     */
    public function getEstados()
    {
        return $this->orderBy('orden', 'ASC')->findAll();
    }


    /**
     * Obtener un estado por ID
     */
    public function getEstado($id)
    {
        return $this->where('id', $id)->first();
    }


    /**
     * Verifica si un estado existe por nombre
     */
    public function existsByName($nombre)
    {
        return $this->where('nombre', $nombre)->countAllResults() > 0;
    }
}