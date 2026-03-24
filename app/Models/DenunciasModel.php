<?php

namespace App\Models;

use CodeIgniter\Model;

class DenunciasModel extends Model
{
    protected $table      = 'reports';          // Nombre de la tabla
    protected $primaryKey = 'id';                  // Llave primaria

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';         // Devuelve resultados como array
    protected $useSoftDeletes   = false;

    // Campos que se pueden insertar o actualizar
    protected $allowedFields = [
        'name',
        'email',
        'tipo_documento',
        'numero_documento',
        'tipo_contacto',
        'contacto',
        'entity_type_id',
        'entity_id',
        'otro_nombre',
        'titulo_denuncia',
        'descripcion_denuncia',
        'archivo_path',
        'created_at',
        'updated_at'
    ];

    // Opcional: usar timestamps automáticos si tus columnas existen en la tabla
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validación simple (puedes ampliar)
    protected $validationRules = [
        'name'             => 'required|min_length[3]|max_length[100]',
        'email'            => 'required|valid_email',
        'tipo_documento'   => 'required',
        'numero_documento' => 'required',
        'tipo_contacto'    => 'required',
        'contacto'         => 'required',
        'entity_type_id'   => 'required|integer',
        'entity_id'        => 'required|integer',
        'titulo_denuncia'  => 'required|min_length[5]|max_length[255]',
        'descripcion_denuncia' => 'required|min_length[10]',
    ];

    protected $validationMessages = [
        'email' => [
            'valid_email' => 'Por favor ingresa un email válido.',
        ],
        // Agrega mensajes personalizados si quieres
    ];

    protected $skipValidation = false;
}
