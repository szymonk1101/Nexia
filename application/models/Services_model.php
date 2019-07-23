<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getCompanyAllServices($company_ref)
    {
        return $this->db->where('company_ref', $company_ref)->get('services')->result();
    }

}
