<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getUserData($userid)
    {
        return $this->db->where('id', $userid, TRUE)->get('users')->row();
    }
}
