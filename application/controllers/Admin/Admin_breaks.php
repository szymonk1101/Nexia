<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_breaks extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('breaks_model');
    }

    /* public function index()
	{
        $this->load->view('admin/staff/index');
    } */

    public function add()
    {
        $view_data = array();

        $this->form_validation->set_rules('date', 'Data', 'required');
        $this->form_validation->set_rules('time_from', 'Godzina rozpoczęcia', 'required');
        $this->form_validation->set_rules('time_to', 'Godzina zakończenia', 'required');

        if($this->form_validation->run() !== FALSE) {
            $this->load->model('staff_model');
            
            $postData = $this->input->post();

            $staff_id = $this->staff_model->getStaffIdByUserId($this->user->data->companyid, $this->user->id);

            if($staff_id) {

                if($this->breaks_model->add($staff_id, $postData)) {
                    $this->session->set_flashdata('alert-success', 'Pomyślnie utworzono przerwę.');
                    redirect('admin/breaks');
                
                } else {
                    $view_data['alert_danger'] = 'Wystąpił nieoczekiwany błąd.';
                }
            } else {
                $view_data['alert_danger'] = 'Wystąpił nieoczekiwany błąd.';
            }

        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $this->load->view('admin/breaks/add', $view_data);
    }
}
