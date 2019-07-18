<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function addNotification($type, $content, $title = null, $data = null, $recipient = null, $level = NOTIFICATION_LVL_INFO, $created = false, $displayed = null)
    {
        if(!$created)
            $created = date('Y-m-d H:i:s');

        return $this->db->insert('notifications', array(
            'type' => $type,
            'recipient' => $recipient,
            'created' => $created,
            'title' => $title,
            'content' => $content,
            'data' => $data,
            'level' => $level,
            'displayed' => $displayed
        ), TRUE);
    }

    public function getAllUserNotifications($userid, $limit = 50)
    {
        $notifications = $this->db->query("SELECT * FROM notifications WHERE `type` = '".NOTIFICATION_ALL."' OR (`type` = '".NOTIFICATION_USER."' AND recipient = '".$userid."') OR `type` = '".NOTIFICATION_ONLINE."' ORDER BY id DESC LIMIT ".$limit)->result();

        foreach($notifications as $notify) {
            $notify->title = ($notify->title) ? lang('Notify_'.$notify->title) : NULL;
            $notify->content_uid = $notify->content;
            $notify->content = vsprintf(lang('Notify_'.$notify->content_uid), json_decode($notify->data, true));
            $notify->data = json_decode($notify->data, true);
            $notify->displayed = json_decode($notify->displayed);
        }

        return $notifications;
    }
    
    public function addUserDisplayer($notify_id, $userid)
    {
        $notify = $this->db->select('displayed')->where('id', $notify_id, TRUE)->get('notifications')->row();

        if($notify) {
            $displayed = json_decode($notify->displayed);
            if(is_array($displayed)) {
                if(!in_array($userid, $displayed)) {
                    array_push($displayed, $userid);
                }
            }
            else {
                $displayed = array($userid);
            }
                
            return $this->db->update('notifications', array('displayed' => json_encode($displayed, JSON_NUMERIC_CHECK)), 'id = '.$notify_id);
        }
        return false;
    }

}
