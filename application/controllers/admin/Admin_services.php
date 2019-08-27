<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_services extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('services_model');
    }

    public function index()
	{

        $this->load->view('admin/services/index');
    }
    
    public function getServicesDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->services_model->getServicesDataTable(1, false, false, false, false, false)));
    }

}
