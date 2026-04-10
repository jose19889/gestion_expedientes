<?php 
namespace App\Models;
use CodeIgniter\Model;


class CatsModel extends Model
{
    protected $table = 'tipo_denuncia';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'descp'];

    public function __construc(){

        $db      = \Config\Database::connect();
        $builder = $db->table('tipo_denuncia');
      }



}