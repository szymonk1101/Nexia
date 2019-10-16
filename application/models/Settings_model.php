<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function save($data)
    {
        $this->db->trans_start();
        foreach($data as $r) {
            $this->db->replace('settings', $r);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function getConfigValue($company_ref, $name)
    {
        $result = $this->db->where('company_ref', $company_ref, TRUE)->where('name', $name, TRUE)->get('settings')->row();
        if($result) {
            switch($name) {
                case 'company_name':
                case 'company_shortname':
                    return $result->value_str;
                break;
                case 'company_active':
                case 'staff_multi_reservations':
                case 'staff_breaks':
                    return $result->value;
                break;
            }
        }
        return false;
    }
    
    public function loadAll($company_ref, $as_array = TRUE)
    {
        $result = $this->db->where('company_ref', $company_ref, TRUE)->get('settings')->result();
        if($as_array) {
            $settings = array();
            foreach($result as $r) {
                $settings[$r->name] = $r;
            }
            return $settings;
        }
        return $result;
    }
    
    public function preparePostData($company_ref, $postData)
    {
        $saveData = array();

        foreach($postData as $name => $v) {
            switch($name) {
                case 'company_name':
                case 'company_shortname':
                    $saveData[] = array('company_ref' => $company_ref, 'name' => $name, 'value_str' => $this->db->escape_str(trim($v)));
                break;
                case 'company_active':
                case 'staff_multi_reservations':
                case 'staff_breaks':
                    $saveData[] = array('company_ref' => $company_ref, 'name' => $name, 'value' => intval($v));
                break;
            }
        }

        return $saveData;
    }

}
