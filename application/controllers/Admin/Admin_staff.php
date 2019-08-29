<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_staff extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('staff_model');
        $this->load->model('users_model');
    }

    public function index()
	{
        $this->load->view('admin/staff/index');
    }

    public function details($staff_id)
    {
        $staff_id = intval($staff_id);

        $userid = $this->staff_model->getUserIdByStaffId($staff_id);
        if($userid) {
            $user = $this->users_model->getUserData($userid);    

            
            $this->load->view('admin/staff/details', array(
                'staff_id' => $staff_id,
                'user' => $user
            ));
            return;
        }

        redirect('admin/staff');
    }

    public function add()
    {
        $view_data = array();

        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

        if($this->form_validation->run() !== FALSE) {

            print_r($this->input->post());

            exit();
            
        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $this->load->view('admin/staff/add', $view_data);
    }
    

    public function getStaffDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->staff_model->getStaffDataTable(1, false, false, false, false, false)));
    }

}
