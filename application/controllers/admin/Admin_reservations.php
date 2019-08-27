<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_reservations extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('reservations_model');
    }

    public function index()
	{
        

        $this->load->view('admin/reservations/index');
    }
    
    public function getReservationsDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->reservations_model->getReservationsDataTable(1, false, false, false, false, false)));
    }

}
