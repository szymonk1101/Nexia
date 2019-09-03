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

    public function create()
    {
        $this->load->model('staff_model');
        $this->load->model('services_model');
        $view_data = array();

        $this->form_validation->set_rules(array(
            array(
                'field' => 'service_ref',
                'label' => 'Usługa',
                'rules' => 'integer|required'
            ),
            array(
                'field' => 'date',
                'label' => 'Data',
                'rules' => 'required'
            ),
            array(
                'field' => 'time',
                'label' => 'Godzina',
                'rules' => 'required'
            ),
            array(
                'field' => 'duration',
                'label' => 'Czas trwania',
                'rules' => 'integer|required'
            ),
            array(
                'field' => 'user_ref',
                'label' => 'Klient',
                'rules' => 'required'
            )
        ));

        if($this->form_validation->run() !== FALSE) {
        


        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $view_data['staff'] = $this->staff_model->getCompanyStaff($this->user->data->companyid);
        $view_data['services'] = $this->services_model->getCompanyAllServices($this->user->data->companyid);
        $this->load->view('admin/reservations/create', $view_data);
    }
    
    public function getReservationsDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->reservations_model->getReservationsDataTable(1, false, false, false, false, false)));
    }

}
