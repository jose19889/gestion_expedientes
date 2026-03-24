<?php namespace App\Controllers;

use App\Models\FileModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\ConnectionInterface;
use App\Models\EmailsModel;
use App\Models\StatusModel;
use App\Models\RoleModel;
class FormApiController extends BaseController {

    private $wpDb;

    public function __construct() {
         // Load the helper here
        helper('hasRole'); // Replace 'your_helper_name' with the actual name of the helper
        // Connect to WordPress database
        $this->wpDb = \Config\Database::connect('wordpress');
    }
    
    
    public function save_form()
    {
        // Get POST data
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

        // Insert into your database
        $this->load->database();
        $data = array(
            'name'    => $name,
            'email'   => $email,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('form_submissions', $data);

        echo json_encode(['status' => 'success']);
    }




    

}
