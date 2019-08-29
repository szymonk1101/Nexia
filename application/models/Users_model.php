<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model  {
    
    private static $select = 'users.id, users.email, users.telephone, users.token_expdate, users.active, users.created, users.lastlogin, users.type, users.rank, users.avatar';

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getUserByEmail($email)
    {
        return $this->db->select(self::$select)->where('email', $email, TRUE)->get('users')->row();
    }

    public function getUserData($userid)
    {
        return $this->db->select(self::$select)->where('id', $userid, TRUE)->get('users')->row();
    }
}
