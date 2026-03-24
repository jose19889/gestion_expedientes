<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nombre',
        'apellido',   // ✔ corregido
        'email',
        'role_id',
        'contacto',
        'password',
        'profile_image',
        'departamento_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /*
    |---------------------------------------
    | Obtener todos los usuarios con rol
    |---------------------------------------
    */
    public function getUserInfo()
    {
        return $this->select([
                    'usuarios.id',
                    'usuarios.nombre',
                    'usuarios.apellido',
                    'usuarios.email',
                    'roles.role_name AS role',
                    'departamentos.nombre AS departamento',
                    'usuarios.profile_image'
                ])
                ->join('roles', 'usuarios.role_id = roles.id', 'left')
                ->join('departamentos', 'usuarios.departamento_id = departamentos.id', 'left')
                ->orderBy('usuarios.id', 'ASC')
                ->findAll();
    }

    /*
    |---------------------------------------
    | Obtener usuario por email (login)
    |---------------------------------------
    */
   /* public function getUserByEmail(string $email)
    {
        return $this->select('usuarios.*, roles.role_name')
                ->join('roles', 'usuarios.role_id = roles.id', 'left')
                ->where('usuarios.email', $email)
                ->first();
    }*/

    public function getUserByEmail(string $email)
{
    return $this->select('usuarios.*, roles.role_name, departamentos.id as departamento_actual')
                ->join('roles', 'usuarios.role_id = roles.id', 'left')
                ->join('departamentos', 'usuarios.departamento_id = departamentos.id', 'left')
                ->where('usuarios.email', $email)
                ->first();
}

    /*
    |---------------------------------------
    | Actualizar usuario
    |---------------------------------------
    */
    public function editUser(array $data, int $id)
    {
        return $this->update($id, $data);
    }

    /*
    |---------------------------------------
    | Obtener usuario por ID
    |---------------------------------------
    */
    public function getUserById(int $id)
    {
        return $this->where('id', $id)->first();
    }

    public function getUserFull($id)
{
    return $this->select('usuarios.*, roles.role_name, departamentos.nombre as departamento')
            ->join('roles', 'usuarios.role_id = roles.id','left')
            ->join('departamentos', 'usuarios.departamento_id = departamentos.id','left')
            ->where('usuarios.id',$id)
            ->first();
}

}