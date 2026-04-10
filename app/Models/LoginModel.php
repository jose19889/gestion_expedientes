<?php

namespace App\Models;
use CodeIgniter\Model;


class LoginModel extends Model{


  public function __construc(){
    $this->load->database();

    $db      = \Config\Database::connect();
$builder = $db->table('users');
  } 
  function validate($email,$password){
    $this->db->where('email',$email);
    $this->db->where('password',$password);
    $result = $this->db->get('users',1);
    return $result;
  }


public function userRoles(){

$this->db->select('*, users.id as user_id, roles.id_role as roles_id');
$this->db->from('users');
//$this->db->where('id');
//$this->db->where('id_role');

$this->db->join('roles', 'users.role_id= roles.id_role');
return $this->db->get()->result_array();

}


}