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
        
        $this->load->model('openhours_model');

        print_r($this->openhours_model->getCompanyOpenHours($this->input->get('company')));

        print_r($this->openhours_model->getCompanyOpenHoursByDate($this->input->get('company'), '2019-07-03'));

        echo '<br /><br />';

        print_r($this->openhours_model->getFreeHoursForDate($this->input->get('company'), '2019-07-04'));

        echo '<br /><br />';

        var_dump($this->openhours_model->isTermFree($this->input->get('company'), '2019-07-04', '12:00:00', '13:00:00'));

    }
    
    public function test()
    {
        echo 'test';
        echo lang('Home');
    }
}
