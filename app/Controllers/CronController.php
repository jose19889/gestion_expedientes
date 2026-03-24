<?php

namespace App\Controllers;
use App\Models\EmailsModel;
use CodeIgniter\Controller;

class CronController extends Controller
{
    public function transferDataAutomatically()
    {
        // Load the model or helper that contains your transferData function
        $this->load->model('EmailModel');
        $this->EmailModel->transferData();

        echo "Data transfer completed.";
    }
}
