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
    
    /**
     * Return status 0 - Error, 1 - Okay, 2 - To confirm
     */
    public function confirmReservation()
    {
        $this->load->model('open_hours_model');
        $this->load->model('staff_model');

        $result = new ApiResult(0, lang('Invalid_data'));

        $resid = intval($this->input->post('resid'));
        $confirm = intval($this->input->post('confirm'));

        if($resid) {

            $res = $this->reservations_model->get($resid);

            if($res) {
                $userid = ($res->staff_ref) ? $res->staff_ref : $this->staff_model->getStaffIdByUserId($res->company_ref, $this->getUserId());
                if($confirm || $this->open_hours_model->isTermFree($res->company_ref, $res->date, $res->time_from, $res->time_to, $res->service_ref, $userid)) {
                    if($this->reservations_model->confirm($resid)) {
                        $result->status = 1;
                        $result->message = lang('ReservationHasBeenConfirmed');
                    } else {
                        $result->message = lang('UnknownError');
                    }
                } else {
                    $result->status = 2;
                    $result->message = lang('YouAlreadyHaveReservationAtThisTimeConfirm');
                }
            } else {
                $result->message = lang('ReservationNotFound');
            }
        }
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_NUMERIC_CHECK));
    }

    public function setPaidReservation()
    {
        $result = new ApiResult(0, lang('Invalid_data'));

        $resid = intval($this->input->post('resid'));
        $paid = intval($this->input->post('paid'));

        if($resid) {
            $res = $this->reservations_model->get($resid);

            if($res) {

                if($res->payment_method == PAYMENT_METHOD_CASH) {
                    if($this->reservations_model->setPaid($resid, $paid)) {
                        $result->status = 1;
                        $result->message = lang('ReservationPaidStatushasChanged');
                    } else {
                        $result->message = lang('UnknownError');
                    }
                } else {
                    $result->message = lang('PaymentMethodIsNotCash');
                }
            } else {
                $result->message = lang('ReservationNotFound');
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result, JSON_NUMERIC_CHECK));
    }

}
