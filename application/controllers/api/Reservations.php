<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends MY_Controller
{
	public function __construct()
	{
        parent::__construct();
		$this->load->library('ApiResult');
        $this->load->model('services_model');
        $this->load->model('open_hours_model');
    }
	
    public function createReservation()
    {
        $result = new ApiResult(0, lang('Invalid_data'));

        if($this->input->method() != 'post')
            return $result->print();

        $rules = array(
            array(
                'field' => 'company_ref',
                'label' => 'Lokal',
                'rules' => 'required|is_natural'
            ),
            array(
                'field' => 'service_ref',
                'label' => 'Usługa',
                'rules' => 'required|is_natural'
            ),
            array(
                'field' => 'staff_ref',
                'label' => 'Pracownik',
                'rules' => 'is_natural'
            ),
            array(
                'field' => 'date',
                'label' => 'Data',
                'rules' => 'required'
            ),
            array(
                'field' => 'time',
                'label' => 'Godzina',
                'rules' => 'required'
            ),
            array(
                'field' => 'telephone',
                'label' => 'Numer telefonu',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'firstname',
                'label' => 'Imię',
                'rules' => 'required'
            ),
            array(
                'field' => 'lastname',
                'label' => 'Nazwisko',
                'rules' => 'required'
            ),
            array(
                'field' => 'paymentmethod',
                'label' => 'Metoda płatności',
                'rules' => 'required|is_natural'
            )
        );

        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == FALSE)
        {
            $result->message = $this->form_validation->error_string();
        }
        else
        {
            $result->status = 1;
            $result->message = 'Rezerwacja została pomyślnie utworzona.';
        }

        $result->print();
    }

}
