<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getReservationsByDate($date, $company_ref, $staff_ref = false, $service_ref = false, $confirmed = true)
    {
        $whr = "";
        /*if($staff_ref)
            $whr .= " AND `staff_ref` = '$staff_ref'";
        
        if($service_ref)
            $whr .= " AND `service_ref` = '$service_ref'";*/

        if($confirmed)
            $whr .= " AND `confirmed` = 1";

        return $this->db->query("SELECT * FROM reservations WHERE company_ref = '$company_ref' AND `date` = '$date'".$whr)->result();
    }

    public function getStaffReservationsByDate($date, $staff_ref)
    {
        return $this->db->query("SELECT * FROM reservations WHERE staff_ref = '$staff_ref' AND `date` = '$date'")->result();
    }

}
