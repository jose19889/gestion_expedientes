<?php namespace App\Models;

use CodeIgniter\Model;

class EmailsModel extends Model {
    protected $table = 'denuncias';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cfdb7_status', 'your_name', 'apellidos', 'menu_documentos', 
        'text_592', 'menu_contacto', 'contacto_mail_tel', 'menu_instituciones', 
        'direccion_seccion', 'menu_paises', 'your_subject', 'mensaje', 
        'upload_file_112',  'id_estado', 'comentario','evidence_id'
    ];
public function GetemailData($tipo_denuncia = null, $institucion = null, $estado = null, $userRole = null)
{
    $builder = $this->db->table('denuncias d')
        ->select('d.id, d.nombre, d.apellidos, d.menu_instituciones, d.numero, d.direccion_seccion, d.ciudades, d.tipo_denuncia, d.your_subject,  d.id_estado, d.mensaje, e.name as estado , r.role_name as roles')
        ->join('statuses e', 'd.id_estado = e.id', 'left') // Using left join
          ->join('roles r', 'd.assigned_role_id = r.id', 'left'); // Using left join

    // Apply filters if present
    if ($tipo_denuncia) {
        $builder->where('d.tipo_denuncia', $tipo_denuncia);
    }

    if ($institucion) {
        $builder->where('d.menu_instituciones', $institucion);
    }

    if ($estado) {
        $builder->where('d.id_estado', $estado);
    }

    // If it's a non-admin user, filter by assigned_role_id
    if ($userRole !== null) {
        $builder->where('d.assigned_role_id', $userRole);
    }

    return $builder->get()->getResultArray();
}


//logic for display denucnias assigned to users
public function Get_assigned($tipo_denuncia = null, $institucion = null, $estado = null, $userRole = null)
{
    $builder = $this->db->table('denuncias d')
        ->select('d.id, d.nombre, d.apellidos, d.menu_instituciones, d.numero, d.direccion_seccion, d.ciudades, d.tipo_denuncia, d.id_estado, d.mensaje, e.name as estado , r.role_name as roles')
        ->join('statuses e', 'd.id_estado = e.id', 'left') // Using left join
        ->join('roles r', 'd.assigned_role_id = r.id', 'left'); // Using left join

    // Apply filters if present
    if ($tipo_denuncia) {
        $builder->where('d.tipo_denuncia', $tipo_denuncia);
    }

    if ($institucion) {
        $builder->where('d.menu_instituciones', $institucion);
    }

    if ($estado) {
        $builder->where('d.id_estado', $estado);
    }

    // **Exclude `assigned_role_id = 1` for both admin and non-admin users**
    $builder->where('d.assigned_role_id !=', 1);


    return $builder->get()->getResultArray();
}

//get stats
public function getDenunciaStatistics()
{
    // Create the query to group by 'tipo_denuncia' and count each occurrence
    $builder = $this->db->table('denuncias')
        ->select('tipo_denuncia, COUNT(*) as count')
        ->groupBy('tipo_denuncia')
        ->orderBy('count', 'DESC'); // You can order by count if you want

    // Execute the query and get the result
    return $builder->get()->getResultArray();
}


      public function status()
      {
          return $this->hasOne('name', 'App\Models\StatusModel');
          // $this->hasOne('propertyName', 'model', 'foreign_key', 'local_key');
      }


      //for dashboard
      public function get_reports()
    {
      //   $db      = \Config\Database::connect();
      //   $query   = $db->query('SELECT  name  FROM roles');
      //   $results = $query->getResultArray();
      // // $results = $query->getResult();
      //   return $results;

    return $this->findAll();


    }
}
