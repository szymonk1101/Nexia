<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hours extends MY_Controller
{
	public function __construct()
	{
        parent::__construct();
		$this->load->library('ApiResult');
        $this->load->model('services_model');
        $this->load->model('open_hours_model');
    }
	
    public function test()
    {
        $result = $this->open_hours_model->getFreeHoursForDate('2019-07-31', 1, 1, 1);

        print_r($result);
    }

    public function getOpenHoursByDate()
    {
        $date = $this->input->post('date');
        $company_ref = $this->input->post('company_ref');
        $staff_ref = $this->input->post('staff_ref');
        $service_ref = $this->input->post('service_ref');

        $hours = $this->open_hours_model->getFreeHoursForDate($date, $company_ref, $service_ref, $staff_ref);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($hours));
    }

    public function getOpenHoursByDateToWizard()
    {
        $this->output
            ->set_content_type('application/json');

        $result = array();

        $date = $this->input->post('date');
        $company_ref = $this->input->post('company_ref');
        $staff_ref = $this->input->post('staff_ref');
        $service_ref = $this->input->post('service_ref');

        if(empty($service_ref)) {
            $this->output
                ->set_output(json_encode($result));
            exit();
        }

        $hours = $this->open_hours_model->getFreeHoursForDate($date, $company_ref, $service_ref, $staff_ref);
        $service = $this->services_model->getDetails($service_ref);

        if($hours && $service) {

            foreach($hours as $h) {

                $st = strtotime($h[0]);
                $f = strtotime($h[1]);

                while($st < $f) {
                    array_push($result, array(
                        date('H:i', $st), date('H:i', $st += 60*15)
                    ));
                }
            }
        }

        $this->output
            ->set_output(json_encode($result));
    }

}
