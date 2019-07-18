<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	protected $isLoggedIn;
	public $user;

	public function __construct()
	{
		parent::__construct();

		// LOGIN SESSION
		$this->isLoggedIn = FALSE;

		$this->loginStatus = $this->auth_model->is_logged();

		if($this->loginStatus)
		{
			$this->isLoggedIn = TRUE;

			$this->user = new stdClass();
			//$this->user->data = new stdClass();
			$this->user->id = $this->auth_model->getUserId();
			$this->user->data = $this->auth_model->getUserHeaderData();
			//$this->user->data = $this->ion_auth_model->getUserHeaderData();
		}
		// END LOGIN SESSION
	}

	public function checkIsLoggedIn($redirect, $json = false)
    {
        if(!$this->isLoggedIn) {
            if($json || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {
                //ajax request
                $response = new stdClass();
                $response->status = 0;
                $response->message = lang('YouMustLoggedIn');
                $response->data = array();

                echo json_encode($response, JSON_NUMERIC_CHECK);
                die();

            } else {
                $this->session->set_userdata('last_page', uri_string());
                redirect(($redirect ? $redirect : ''));
            }
        }
        return true;
	}
	
	public function getUserId()
	{
		if(!empty($this->user) && !empty($this->user->id))
			return $this->user->id;
	}
}
