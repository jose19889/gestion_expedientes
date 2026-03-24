<?php 
namespace App\Models;
use CodeIgniter\Model;
class ReportsModel extends Model
{
    protected $table = 'denuncias';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'descp'];
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