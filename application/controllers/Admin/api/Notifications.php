<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

    public function __construct()
	{
        parent::__construct();
        $this->load->model('notifications_model');
    }
    
    public function getActiveUserNotificationsForNow()
    {
        $this->checkIsLoggedIn('admin/login', true);

        $notifications = $this->notifications_model->getAllUserNotifications($this->getUserId());

        //foreach($notifications as $key => $notify)
        //{
        //}

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($notifications));
    }

    public function setDisplayed()
    {
        $notify_id = $this->input->post('uid');
        $userid = $this->input->post('userid');

        $this->notifications_model->addUserDisplayer($notify_id, $userid);
        $this->output
            ->set_content_type('application/json');
            //->set_output(json_encode(true));
    }

}
