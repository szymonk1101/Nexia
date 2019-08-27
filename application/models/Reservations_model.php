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

    public function getReservationsDataTable($company_ref)
    {
        $return = new stdClass();
        $this->db->where('company_ref', $company_ref);

        $return->recordsTotal = $this->db->count_all_results('reservations');

        $this->db->select('reservations.*, services.name AS service_name, staff_u.email AS staff_email');
        $this->db->join('services', 'reservations.service_ref=services.id', 'left');
        $this->db->join('staff', 'reservations.staff_ref=staff.id', 'left');
        $this->db->join('users AS staff_u', 'staff.user_ref=staff_u.id', 'left');

        $return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->get('reservations')->result();

        return $return;
    }

}
