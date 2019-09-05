<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login', true);
		$this->load->library('ApiResult');
        $this->load->model('reservations_model');
    }
    
    public function confirmReservation()
    {
        $result = new ApiResult(0, lang('Invalid_data'));

        $resid = intva($this->input->post('resid'));

        if($resid) {

            //$this->open_hours_model->isTermFree($this->user->data->companyid, $data['date'], $data['time'], $data['time_to'], $data['service_ref'], $data['staff_ref']);

        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_NUMERIC_CHECK));
    }

}
