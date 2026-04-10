<?php 
namespace App\Models;
use CodeIgniter\Model;


class UserModel extends Model
{

  public function __construc(){
    $this->load->database();

    $db      = \Config\Database::connect();
$builder = $db->table('users');
  }
    protected $table = 'users';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['name', 'username', 'email','role_id', 'contacto', 'password', 'profile_image'];


      public function getuserinfo(){
        $db      = \Config\Database::connect();
        $query   = $db->query('SELECT  u.id, u.username as uname , u.email,  r.role_name , u.profile_image FROM users u JOIN roles r ON u.role_id = r.id ');
        $results = $query->getResultArray();
        return $results;
      }

      // UserModel.php
public function getUserByEmail($email)
{
    return $this->select('users.*, roles.role_name') // Adjust as per your actual table and field names
        ->join('roles', 'users.role_id = roles.id')
        ->where('email', $email)
        ->first();
}



      public function role()
    {
        return $this->hasOne('name', 'App\Models\RoleModel');
        // $this->hasOne('propertyName', 'model', 'foreign_key', 'local_key');
    }

    function edit_User($data,$id){

      
   if($this->db->update('users', $data, 'id = '.$id))
   {
     return true;
   }
   else
   {
     return false;
   }
 }

 function getUsersid($user_id){
  $q= $this->db->get_where('users', array('id'=>$user_id));
  return $q;
}



}