<?php

namespace App\Models;

use CodeIgniter\Model;

class DeptsModel extends Model
{
    protected $table            = 'departamentos';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'descripcion'
    ];

    protected $useTimestamps = false;



    /*
    |--------------------------------------------------------------------------
    | Obtener todos los departamentos (para selects)
    |--------------------------------------------------------------------------
    */
    public function getDepartamentos()
    {
        return $this->select('id, nombre')
                    ->orderBy('nombre', 'ASC')
                    ->findAll();
    }



    /*
    |--------------------------------------------------------------------------
    | Obtener un departamento por ID
    |--------------------------------------------------------------------------
    */
    public function getDepartamento($id)
    {
        return $this->where('id', $id)->first();
    }


public function getdepts(){
     //   $db      = \Config\Database::connect();
      //   $query   = $db->query('SELECT  name  FROM roles');
      //   $results = $query->getResultArray();
      // // $results = $query->getResult();
      //   return $results;

    return $this->findAll();
}
    /*
    |--------------------------------------------------------------------------
    | Verificar si existe un departamento por nombre
    |--------------------------------------------------------------------------
    */
    public function existsByName($nombre)
    {
        return $this->where('nombre', $nombre)->countAllResults() > 0;
    }
}