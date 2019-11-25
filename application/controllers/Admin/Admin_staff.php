<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_staff extends MY_Controller
{
    protected $_PERMISSIONS = array(
        'all' => PERMISSION_STAFF_DETAILS,
        'index' => PERMISSION_STAFF_DETAILS,
        'details' => PERMISSION_STAFF_DETAILS,
        'add' => PERMISSION_STAFF_MANAGE
    );
    
    public function __construct()
	{
        parent::__construct();
        $this->checkIsLoggedIn('admin/login');

        $this->load->model('staff_model');
        $this->load->model('users_model');
    }

    public function index()
	{
        $this->load->view('admin/staff/index');
    }

    public function details($staff_id)
    {
        $staff_id = intval($staff_id);

        $userid = $this->staff_model->getUserIdByStaffId($staff_id);
        if($userid) {
            $user = $this->users_model->getUserData($userid);    

            $permissions = $this->permissions_model->getStaffPermissionsAsArray($staff_id);
            
            $this->load->view('admin/staff/details', array(
                'staff_id' => $staff_id,
                'user' => $user,
                'permissions' => $permissions,
                'can_show_permissions' => $this->permissions_model->isUserHavePermission($this->user->id, $this->user->data->companyid, array(PERMISSION_STAFF_MANAGE, PERMISSION_STAFF_MANAGE_PERMISSIONS))
            ));
            return;
        }

        redirect('admin/staff');
    }

    public function add()
    {
        $view_data = array();

        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

        if($this->form_validation->run() !== FALSE) {

            $email = $this->input->post('email');
            $user = $this->users_model->getUserByEmail($email);

            if($user) {

                if(!$this->staff_model->isCompanyHaveUser($this->user->data->companyid, $user->id)) {

                    if($this->staff_model->addUserToCompany($this->user->data->companyid, $user->id)) {
                        $this->session->set_flashdata('alert-success', 'Użytkownik został dodany.');
                        redirect('admin/staff');
                    } else {
                        $view_data['alert_danger'] = 'Wystąpił nieoczekiwany błąd.';
                    }

                } else {
                    $view_data['alert_danger'] = 'Ten użytkownik jest już w tej firmie.';
                }             

            } else {
                $view_data['alert_danger'] = 'Nie odnaleziono użytkownika o podanym adresie e-mail.';
            }
            
        } else {
            if(!empty($this->form_validation->error_string()))
                $view_data['alert_danger'] = $this->form_validation->error_string(false, '<br/>');
        }

        $this->load->view('admin/staff/add', $view_data);
    }

    public function edit($staff_id)
    {
        $staff_id = intval($staff_id);

        $userid = $this->staff_model->getUserIdByStaffId($staff_id);
        if($userid) {
            $user = $this->users_model->getUserData($userid);    

            $permissions = $this->permissions_model->getStaffPermissionsAsArray($staff_id);
            
            $this->load->view('admin/staff/edit', array(
                'staff_id' => $staff_id,
                'user' => $user,
                'permissions' => $permissions,
                'can_edit_permissions' => $this->permissions_model->isUserHavePermission($this->user->id, $this->user->data->companyid, PERMISSION_STAFF_MANAGE_PERMISSIONS)
            ));
            return;
        }

        redirect('admin/staff');
    }
    

    public function getStaffDataTable()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->staff_model->getStaffDataTable(1, false, false, false, false, false)));
    }

}
