<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_hours extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('open_hours_model');
    }

    public function index()
	{
        

        $this->load->view('admin/hours/index');
    }
    
    public function getOpenHoursDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->open_hours_model->getOpenHoursDataTable(1, false, false, false, false, false)));
    }

}
