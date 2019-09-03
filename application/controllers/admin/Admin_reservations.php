<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_reservations extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('reservations_model');
    }

    public function index()
	{
        $this->load->view('admin/reservations/index');
    }

    public function create()
    {
        $this->load->model('staff_model');
        $this->load->model('services_model');
        $view_data = array();

        $this->form_validation->set_rules(array(
            array(
                'field' => 'service_ref',
                'label' => 'Usługa',
                'rules' => 'integer|required'
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
                'field' => 'duration',
                'label' => 'Czas trwania',
                'rules' => 'integer|required|greater_than[0]'
            ),
            array(
                'field' => 'user_ref',
                'label' => 'Klient',
                'rules' => 'required'
            )
        ));

        if($this->form_validation->run() !== FALSE) {
            $data = $this->input->post();
            $data['time'] .= ':00'; // FOR SUCCESS VALIDATION
            $data['time_to'] = date('H:i:s', strtotime('+'.intval($data['duration']).' minutes', strtotime($data['time'])));

            $data['staff_ref'] = FALSE; // !!!!!!!!!!!!!!!!!!!!!!!

            $this->load->model('open_hours_model');
            if(!$this->open_hours_model->isTermFree($this->user->data->companyid, $data['date'], $data['time'], $data['time_to'], $data['service_ref'], $data['staff_ref'])) {
                $view_data['term_not_free'] = 'Wybrany przez Ciebie termin nie jest dostępny. Czy mimo to chcesz utworzyć rezerwacje?';
            } else {

                $this->load->model('users_model');
                $user = $this->users_model->getUserByEmailOrTelephone($data['user_ref']);

                if(empty($user)) {

                } else {

                    $data['user_ref'] = $user->id;

                    $saveData = array(
                        'user_ref' => $data['user_ref'],
                        'company_ref' => $this->user->data->companyid,
                        'service_ref' => $data['service_ref'],
                        'staff_ref' => isset($data['staff_ref']) ? setNullValue($data['staff_ref']) : NULL,
                        'date' => $data['date'],
                        'time_from' => $data['time'],
                        'time_to' => $data['time_to'],
                        'status' => RESERVATION_NEW,
                        'confirmed' => intval($data['confirmed']),
                        'paid' => intval($data['paid']),
                        'created' => date('Y-m-d H:i:s')
                    );
    
                    if($this->reservations_model->add($saveData)) {
                        $this->session->set_flashdata('alert-success', 'Rezerwacja została utworzona pomyślnie.');
                        redirect('admin/reservations/');
                    } else {
                        $view_data['alert_danger'] = 'Wystąpił nieoczekiwany błąd.';
                    }
                }
            }

        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $view_data['staff'] = $this->staff_model->getCompanyStaff($this->user->data->companyid);
        $view_data['services'] = $this->services_model->getCompanyAllServices($this->user->data->companyid);
        $this->load->view('admin/reservations/create', $view_data);
    }
    
    public function getReservationsDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->reservations_model->getReservationsDataTable(1, false, false, false, false, false)));
    }

}
