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

}
