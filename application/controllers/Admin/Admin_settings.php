<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');
    }

    public function index()
	{
        

        $this->load->view('admin/settings/index');
    }

}
