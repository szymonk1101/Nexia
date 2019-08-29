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

    public function add()
    {
        $this->load->model('staff_model');
        $this->load->model('services_model');

        $this->form_validation->set_rules('name', 'Nazwa', 'required');

        if($this->form_validation->run() !== FALSE) {

            print_r($this->input->post());

            exit();
            
        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $view_data['staff'] = $this->staff_model->getCompanyStaff($this->user->data->companyid);
        $view_data['services'] = $this->services_model->getCompanyAllServices($this->user->data->companyid);

        $this->load->view('admin/hours/add', $view_data);
    }
    
    public function exceptions()
    {
        $this->load->view('admin/hours/exceptions');   
    }

    public function getOpenHoursDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->open_hours_model->getOpenHoursDataTable(1, false, false, false, false, false, false)));
    }

    public function getExceptionsDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->open_hours_model->getExceptionsDataTable(1, false, false, false, false, false)));
    }

    public function getStaffOpenHoursDataTable()
    {
        $staff_id = intval($this->input->post('staff_id'));

        if(!$staff_id) exit();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->open_hours_model->getStaffOpenHoursDataTable($staff_id, false, false, false, false, false)));
    }

    public function getStaffExceptionsDataTable()
    {
        $staff_id = intval($this->input->post('staff_id'));

        if(!$staff_id) exit();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->open_hours_model->getStaffExceptionsDataTable($staff_id, false, false, false, false, false)));
    }


}
