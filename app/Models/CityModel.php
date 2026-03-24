<?php 
namespace App\Models;
use CodeIgniter\Model;
class CityModel extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'province_id'];
    protected $useAutoIncrement = true;
    

    public function __construc(){
        $this->load->database();
      
        $db      = \Config\Database::connect();
        $builder = $db->table('Cities');
      }





}