<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    public function getReservationsByDate($company_ref, $date, $confirmed = true)
    {
        $whr = '';
        if($confirmed)
            $whr = ' AND `confirmed` = 1';

        return $this->db->query("SELECT * FROM reservations WHERE company_ref = '$company_ref' AND `date` = '$date'".$whr)->result();
    }

}
