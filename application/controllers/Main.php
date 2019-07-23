<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index()
	{
		$this->load->model('services_model');

		$this->load->view('reservation', array(
			'services' => $this->services_model->getCompanyAllServices(1)
		));
	}
}
