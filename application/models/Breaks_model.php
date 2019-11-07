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

}
