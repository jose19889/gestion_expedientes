<?php

namespace App\Models;

use CodeIgniter\Model;

class DossierModel extends Model
{
    protected $table = 'expedientes';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
    'codigo',
    'hash_publico',
    'titulo',
    'descripcion',
    'tipo_expedientes',
    'departamento_actual',
    'asignado_a',
    'prioridad',
    'nivel_confidencialidad',
    'estado_id',
    'creado_por',
    'fecha_creacion',
    'fecha_actualizacion',
    'codigo_qr',
    'qr_path'
];


////////////////////////////////////////////////
//cargar expeidntes por filtro de usuario, roles, dpto
public function getExpedientesData($userId, $userRoleId, $userDeptId, $filtros = [])
{
    $builder = $this->table('expedientes')
        ->select('
            expedientes.*, 
            departamentos.nombre as departamento_name, 
            estados.nombre as estado_nombre, 
            estados.color as estado_color
        ')
        ->join('departamentos', 'departamentos.id = expedientes.departamento_actual', 'left')
        ->join('estados', 'estados.id = expedientes.estado_id', 'left');

    /*
    =========================
    PERMISOS POR ROL
    =========================
    */

    $userId = session()->get('user_id');
   switch($userRoleId) {
    case 1: // Director → ve todo
        break;

    case 2: // Jefe de departamento → ve todo su departamento
        $builder->where('expedientes.departamento_actual', $userDeptId);
        break;

    case 9: // Recepción → ve todos del departamento
        $builder->where('expedientes.departamento_actual', $userDeptId);
        break;

   default: // Técnico → solo asignados
        $builder->where('expedientes.asignado_a', $userId);
    break;
}
    /*
    =========================
    FILTROS OPCIONALES
    =========================
    */
/* --- FILTROS DE SERVIDOR (LO QUE FALTA) --- */

    // Filtro por Departamento (Útil para el Director)
    if (!empty($filtros['departamento'])) {
        $builder->where('expedientes.departamento_actual', $filtros['departamento']);
    }

    // Filtro por Estado
    if (!empty($filtros['estado'])) {
        $builder->where('expedientes.estado_id', $filtros['estado']);
    }

    // Filtro por Prioridad (Alta, Media, Baja)
    if (!empty($filtros['prioridad'])) {
        $builder->where('expedientes.prioridad', $filtros['prioridad']);
    }

    // 👉 Depuración: ver la consulta SQL final
    // dd($builder->getCompiledSelect());

    return $builder
        ->orderBy('expedientes.fecha_creacion', 'DESC')
        ->get()
        ->getResultObject();
}

public function getStatistics()
{
    $builder = $this->db->table('expedientes e')
        ->select('
            es.id,
            es.nombre,
            es.descripcion,
            es.color,
            es.orden,
            es.es_final,
            COUNT(e.id) as count
        ')
        ->join('estados es', 'es.id = e.estado_id', 'left')
        ->groupBy('es.id')
        ->orderBy('count', 'DESC');

    return $builder->get()->getResultArray();
}


public function generarCodigo()
{
    $builder = $this->db->table('expedientes');
    $builder->selectMax('codigo');
    $row = $builder->get()->getRowArray();

    if ($row && $row['codigo']) {
        // Extrae solo el número
        $num = (int) substr($row['codigo'], 3); // "EXP001" -> "001"
        $num++; // siguiente número
    } else {
        $num = 1;
    }

    // Formatea con ceros a la izquierda (3 dígitos)
    $codigo = 'EXP' . str_pad($num, 3, '0', STR_PAD_LEFT);

    return $codigo;
}
public function get_by_id($expediente_id)
{
    $builder = $this->db->table('movimientos_expediente m');

    $builder->select('
        m.*,
        u.nombre AS usuario_nombre,
        u.apellido AS usuario_apellido,
        d_orig.nombre AS dep_origen,
        d_dest.nombre AS dep_destino,
        e.nombre AS estado_nombre,
        e.color AS estado_color,
        e.es_final AS estado_final
    ');

    $builder->join('expedientes exp', 'exp.id = m.expediente_id', 'inner');
    $builder->join('estados e', 'e.id = exp.estado_id', 'left');
    $builder->join('usuarios u', 'u.id = m.usuario_id', 'left');
    $builder->join('departamentos d_orig', 'd_orig.id = m.departamento_origen', 'left');
    $builder->join('departamentos d_dest', 'd_dest.id = m.departamento_destino', 'left');

    $builder->where('m.expediente_id', $expediente_id);
    $builder->orderBy('m.fecha', 'DESC');

    $query = $builder->get();

    // Debug opcional
    // echo $this->db->getLastQuery();
    // die();

    return $query->getResult();
}


public function getExpedientesPorEstado()
{
    return $this->db->table('expedientes e')
        ->select('s.nombre as estado, COUNT(e.id) as total')
        ->join('estados s', 's.id = e.estado_id')
        ->groupBy('e.estado_id')
        ->orderBy('s.orden', 'ASC')
        ->get()
        ->getResultArray();
}

public function getUltimosExpedientes($limit = 10)
{
    return $this->db->table('expedientes e')
        ->select('
            e.id,
            e.titulo,
            t.nombre as tipo
        ')
        ->join('tipos_expedientes t', 't.id = e.tipo_expedientes', 'left')
        ->orderBy('e.id', 'DESC')
        ->limit($limit)
        ->get()
        ->getResultArray();
}
}