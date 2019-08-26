<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function getCompanyStaff($company_ref)
    {
        return $this->db->query("SELECT staff.id, users.email FROM staff INNER JOIN users ON staff.user_ref=users.id WHERE staff.company_ref = ".$this->db->escape($company_ref))->result();
    }

}
