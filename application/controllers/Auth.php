<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function register()
	{

		$this->load->view('auth/register');
	}

}
