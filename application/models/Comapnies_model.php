<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getCompanyById($company_id)
    {
        return $this->db->where('id', $company_id, TRUE)->get('companies')->row();
    }

    public function addCompany($data)
    {
        return $this->db->insert('companies', array(
            'name' => $data['name'],
            'shortname' => $data['shortname'],
            'owner_ref' => $data['owner_ref'],
            'active' => COMPANY_ACTIVE
        ));
    }

    public function getCompanyOwner($company_id)
    {
        $query = $this->db->select('owner_ref')->where('id', $company_id, TRUE)->get('companies')->row();
        if(!empty($query))
            return $query->owner_ref;

        return false;
    }

}
