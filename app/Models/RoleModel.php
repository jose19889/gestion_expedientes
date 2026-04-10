<?php 
namespace App\Models;
use CodeIgniter\Model;
class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['role_name', 'description'];
    protected $useAutoIncrement = true;
    

    public function __construc(){
        $this->load->database();
      
        $db      = \Config\Database::connect();
        $builder = $db->table('Roles');
      }




    public function user()
    {
        return $this->belongsTo('name', 'App\Models\UserModel');
        // $this->belongsTo('propertyName', 'model', 'foreign_key', 'owner_key');
    }

    public function getroles()
    {
      //   $db      = \Config\Database::connect();
      //   $query   = $db->query('SELECT  name  FROM roles');
      //   $results = $query->getResultArray();
      // // $results = $query->getResult();
      //   return $results;

    return $this->findAll();


    }


}