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

        $this->load->model('openhours_model');

        print_r($this->openhours_model->getCompanyOpenHours($this->input->get('company')));

        print_r($this->openhours_model->getCompanyOpenHoursByDate($this->input->get('company'), '2019-07-03'));

        echo '<br /><br />';

        print_r($this->openhours_model->getFreeHoursForDate($this->input->get('company'), '2019-07-04'));

        echo '<br /><br />';

        var_dump($this->openhours_model->isTermFree($this->input->get('company'), '2019-07-04', '12:00:00', '13:00:00'));

    }
    
    public function login()
    {
        $this->load->library('form_validation');



        if($this->input->method() == 'post')
        {
            $login = $this->auth_model->login($this->input->post('identity'), $this->input->post('password'), FALSE);

            if($login->status == 1) {
                echo 'Zalogowano pomyślnie';
                if($last_page = $_SESSION['last_page']) {
                    unset($_SESSION['last_page']);
                    redirect($last_page);
                }
            } else {
                echo $login->message;
            }
        }

        $this->load->view('admin/login');
    }

    public function logout()
    {
        $this->auth_model->logout();
    }

    public function test()
    {
        
    }
}
