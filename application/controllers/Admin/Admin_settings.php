<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');
        
        $this->load->model('settings_model');
    }

    public function index()
	{
        $settings = $this->settings_model->loadAll($this->user->data->companyid);

        $this->load->view('admin/settings/index', array(
            'setting' => $settings
        ));
    }

    public function save()
    {
        $postData = $this->input->post();

        $postData = $this->settings_model->preparePostData($this->user->data->companyid, $postData);

        $saved = $this->settings_model->save($postData);
        if($save !== FALSE) {
            $this->session->set_flashdata('alert-success', 'Ustawienia zostały zapisane.');
        } else {
            $this->session->set_flashdata('alert-danger', 'Wystąpił nieoczekiwany błąd.');
        }

        redirect('admin/settings');
    }

}
