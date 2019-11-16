<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breaks_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function add($staff_id, $data)
    {
        return $this->db->insert('breaks', array(
            'staff_ref' => $staff_id,
            'date' => $data['date'],
            'time_from' => $data['time_from'],
            'time_to' => $data['time_to']
        ), TRUE);
    }


    public function getBreaksDataTable($company_ref, $start=0, $length=10, $search, $order, $columns)
    {
        $return = new stdClass();
        //$this->db->where('staff_ref', $staff_ref, TRUE);
        //$return->recordsTotal = $this->db->count_all_results('breaks');

        //$this->db->where('staff_ref', $staff_ref, TRUE);
        //$return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->query("SELECT * FROM breaks WHERE staff_ref IN ( SELECT id FROM staff WHERE company_ref = '$company_ref' )")->result();
        //$return->data = $this->db->get('breaks')->result();

        return $return;
    }
}
