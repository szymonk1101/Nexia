<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('users_model');
	}

	public function index()
	{
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('open_hours_model');

        /* print_r($this->open_hours_model->getCompanyOpenHours($this->input->get('company')));

        print_r($this->open_hours_model->getCompanyOpenHoursByDate($this->input->get('company'), '2019-07-03'));

        echo '<br /><br />';

        print_r($this->open_hours_model->getFreeHoursForDate($this->input->get('company'), '2019-07-04'));

        echo '<br /><br />';

        var_dump($this->open_hours_model->isTermFree($this->input->get('company'), '2019-07-04', '12:00:00', '13:00:00')); */

        $data = array();
        $data['free'] = $this->open_hours_model->getFreeHoursForDate('2019-07-04', 1, 1, false);

        $this->load->view('admin/index', $data);
    }
    
    public function login()
    {
        $view_data = array();
        $this->load->library('form_validation');



        if($this->input->method() == 'post')
        {
            $login = $this->auth_model->login($this->input->post('identity'), $this->input->post('password'), FALSE);

            if($login->status == 1) {
                $this->session->set_flashdata('alert-success', lang('LoginSuccessful'));
                if(isset($_SESSION['last_page'])) {
                    unset($_SESSION['last_page']);
                    redirect($last_page);
                } else {
                    redirect('admin');
                }
            } else {
                $view_data['alert_danger'] = $login->message;
            }
        }

        $this->load->view('admin/login', $view_data);
    }

    public function logout()
    {
        if($this->auth_model->logout()) {
            $this->session->set_flashdata('alert-success', lang('LogoutSuccessful'));
            redirect('admin/login');
        }
    }

    public function test()
    {
        if($this->input->method() == 'get')
        {
            $this->load->model('notifications_model');
            $this->notifications_model->addNotification($this->input->get('type'), $this->input->get('content'), $data = null, $this->input->get('recipient'), $created = false, $displayed = null);
            echo 'poszło';
        }
    }
}
