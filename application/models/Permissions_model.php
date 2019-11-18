<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function isUserHavePermission($user_ref, $company_ref, $permission)
    {
        $sql = "SELECT COUNT(*) AS cnt FROM permissions_staff WHERE staff_ref = (SELECT id FROM staff WHERE user_ref = ".$this->db->escape($user_ref)." AND company_ref = ".$this->db->escape($company_ref)." LIMIT 1)";
        if(is_array($permission)) {
            $sql .= " AND permission IN (".implode(",", $permission).")";
        } else {
            $sql .= " AND permission = ".$this->db->escape($permission);
        }
        
        return ($this->db->query($sql)->row()->cnt > 0) ? true : false;
    }

    public function isStaffHavePermission($staff_ref, $permission)
    {
        $sql = "SELECT COUNT(*) AS cnt FROM permissions_staff WHERE staff_ref = ".$this->db->escape($staff_ref);
        if(is_array($permission)) {
            $sql .= " AND permission IN (".implode(",", $permission).")";
        } else {
            $sql .= " AND permission = ".$this->db->escape($permission);
        }
        
        return ($this->db->query($sql)->row()->cnt > 0) ? true : false;
    }

    public function getStaffPermissions($staff_ref)
    {
        return $this->db->query("SELECT permission FROM permissions_staff WHERE staff_ref = '$staff_ref'")->result();
    }

    public function getStaffPermissionsAsArray($staff_ref)
    {
        $query = $this->db->query("SELECT permission FROM permissions_staff WHERE staff_ref = '$staff_ref'")->result();
        $result = array();
        foreach($query as $r) {
            array_push($result, $r->permission);
        }
        return $result;
    }

}
