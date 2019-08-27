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
	
	public function getServicesDataTable($company_ref)
    {
        $return = new stdClass();
		$this->db->select('services.*');
        $this->db->where('company_ref', $company_ref);

        $return->recordsTotal = $this->db->count_all_results('services');


        $return->recordsFiltered =  $return->recordsTotal;
        $return->data = $this->db->get('services')->result();

        return $return;
    }

}
