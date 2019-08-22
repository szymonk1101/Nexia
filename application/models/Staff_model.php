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
        return $this->db->where('company_ref', $company_ref, TRUE)->get('staff')->result();
    }

}
