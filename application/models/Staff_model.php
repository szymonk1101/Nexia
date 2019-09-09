<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function isCompanyHaveUser($company_ref, $userid)
    {
        $cnt = $this->db->query("SELECT COUNT(*) AS cnt FROM staff WHERE user_ref = ".$this->db->escape($userid)." AND company_ref = ".$this->db->escape($company_ref))->row()->cnt;
        return ($cnt>0) ? true : false;
    }

    public function getCompanyStaff($company_ref)
    {
        return $this->db->query("SELECT staff.id, users.email FROM staff INNER JOIN users ON staff.user_ref=users.id WHERE staff.company_ref = ".$this->db->escape($company_ref))->result();
    }

    public function getUserIdByStaffId($staff_id)
    {
        $query = $this->db->where('id', $staff_id, TRUE)->get('staff')->row();
        return (!empty($query)) ? $query->user_ref : false;
    }

    public function getStaffIdByUserId($company_ref, $userid)
    {
        $query = $this->db->where('company_ref', $company_ref, TRUE)->where('user_ref', $userid, TRUE)->get('staff')->row();
        return (!empty($query)) ? $query->id : false;
    }

    public function getStaffIdByUserEmailOrTelephone($search)
    {
        $staff = $this->db->select('staff.id')->join('users', 'staff.user_ref=users.id')->where('users.email', $search, TRUE)->or_where('users.telephone like \'%'.$this->db->escape_str($search).'\'')->get('staff')->row();
        return ($staff) ? $staff->id : 0;
    }

    public function getStaffDataTable($company_ref)
    {
        $return = new stdClass();
        $this->db->where('company_ref', $company_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('staff');

        $this->db->select('staff.id, users.email, users.lastlogin, users.rank');
        $this->db->join('users', 'staff.user_ref=users.id');
        $this->db->where('company_ref', $company_ref, TRUE);

        $return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->get('staff')->result();

        return $return;
    }

}
