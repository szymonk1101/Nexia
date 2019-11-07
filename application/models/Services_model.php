<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function getDetails($service_ref)
    {
        return $this->db->where('id', $service_ref, TRUE)->get('services')->result();
    }
    
    public function getCompanyAllServices($company_ref)
    {
        return $this->db->where('company_ref', $company_ref)->get('services')->result();
    }
	
	public function getServicesDataTable($company_ref)
    {
        $return = new stdClass();
        $this->db->where('company_ref', $company_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('services');

        $this->db->select('services.*, services_categories.name AS category_name');
        $this->db->join('services_categories', 'services.category_ref=services_categories.id', 'left');
        $this->db->where('company_ref', $company_ref, TRUE);

        $return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->get('services')->result();

        return $return;
    }

}
