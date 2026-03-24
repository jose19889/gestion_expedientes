<?php 
namespace App\Models;
use CodeIgniter\Model;
class ProvinceModel extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'abrev'];
    protected $useAutoIncrement = true;
    

    public function __construc(){
        $this->load->database();
      
        $db      = \Config\Database::connect();
        $builder = $db->table('Provinces');
      }





}