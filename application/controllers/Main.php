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

	public function tpay()
	{
		$this->load->model('transactions_model');
		$this->load->library('Tpay');

		$t = new Transaction($this->tpay);

		$r = $t->create(3214, 150, 13.99, 'heniek1101@gmail.com', 'Henryk', 'test opis');

		print_r($r);

		echo $this->tpay->merchantId;
	}

	public function test()
	{
		$this->load->model('hours_model');

		$h1 = new stdClass();
		$h1->time_from = '10:00';
		$h1->time_to = '12:00';
		$h2 = new stdClass();
		$h2->time_from = '07:00';
		$h2->time_to = '08:00';
		$h3 = new stdClass();
		$h3->time_from = '18:00';
		$h3->time_to = '22:00';
		$h4 = new stdClass();
		$h4->time_from = '09:00';
		$h4->time_to = '11:00';
		/*$h5 = new stdClass();
		$h5->time_from = '11:00';
		$h5->time_to = '11:30'; */

		$hours = array((array)$h1);

		$add = array((array)$h2, (array)$h3, (array)$h4, /*(array)$h5 */);

		print_r($this->hours_model->mergeHours($hours, $add));
	}
}
