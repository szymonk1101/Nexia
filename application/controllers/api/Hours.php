<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hours extends MY_Controller
{
    public function test()
    {
        $this->load->model('open_hours_model');

        $result = $this->open_hours_model->getFreeHoursForDate('2019-07-31', 1, 1, 1);

        print_r($result);
    }

    public function getOpenHoursByDate()
    {
        $this->load->model('open_hours_model');

        $date = $this->input->post('date');
        $company_ref = $this->input->post('company_ref');
        $staff_ref = $this->input->post('staff_ref');
        $service_ref = $this->input->post('service_ref');

        $hours = $this->open_hours_model->getFreeHoursForDate($date, $company_ref, $service_ref, $staff_ref);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($hours));
    }

}
