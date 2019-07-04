<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenHours_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Parameters:
     * - from [YYYY-MM-DD]
     * - to [YYYY-MM-DD]
     */
    public function getCompanyOpenHours($company_ref, $from = null, $to = null)
    {
        $valid_whr = "valid_from <= now()";
        $date_whr = "`date` >= now()";

        if($from) {
            $valid_whr = "valid_from <= '$from'";
            $date_whr = "`date` >= '$from'";
        }
        if($to) {
            $valid_whr .= "AND (valid_to is null OR valid_to > '$to')";
            $date_whr .= "AND `date` <= '$to'";
        }

        $open_hours = $this->db->query("SELECT * FROM open_hours WHERE company_ref = '$company_ref' AND ".$valid_whr)->result();
        $exceptions = $this->db->query("SELECT * FROM open_hours_exceptions WHERE company_ref = '$company_ref' AND ".$date_whr)->result();

        $result = new stdClass();
        $result->open_hours = $open_hours;
        $result->exceptions = $exceptions;

        return $result;
    }

    /**
     * Parameters:
     * - date [YYYY-MM-DD]
     */
    public function getCompanyOpenHoursByDate($company_ref, $date)
    {
        $result = new stdClass();
        $result->time_from = false;
        $result->time_to = false;

        $exceptions = $this->db->query("SELECT * FROM open_hours_exceptions WHERE company_ref = '$company_ref' AND `date` = '$date'")->row();
        if(!empty($exceptions)) {
            $result->time_from = $exceptions->time_from;
            $result->time_to = $exceptions->time_to;
        }
        else {
            $dayname = $this->getColumnDayNameByInteger(date('N', strtotime($date)));
            $open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours WHERE company_ref = '$company_ref' AND valid_from <= '$date' AND valid_to is null OR valid_to > '$date'")->row();
            if(!empty($open_hours)) {
                $result->time_from = $open_hours->{$dayname.'_from'};
                $result->time_to = $open_hours->{$dayname.'_to'};
            }
        }
        
        return $result;
    }

    /**
     * Parameters:
     * - date [YYYY-MM-DD]
     */
    public function getFreeHoursForDate($company_ref, $date)
    {
        $this->load->model('reservations_model');

        $free_blocks = array();
        $exception = $this->db->query("SELECT * FROM open_hours_exceptions WHERE company_ref = '$company_ref' AND `date` = '$date'")->row();
        if(!empty($exception)) {
            array_push($free_blocks, [$exception->time_from, $exception->time_to]);
        }
        else {
            $dayname = $this->getColumnDayNameByInteger(date('N', strtotime($date)));
            $open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours WHERE company_ref = '$company_ref' AND valid_from <= '$date' AND valid_to is null OR valid_to > '$date'")->row();
            if(!empty($open_hours))
                array_push($free_blocks, [$open_hours->{$dayname.'_from'}, $open_hours->{$dayname.'_to'}]);
        }

        $reservations = $this->reservations_model->getReservationsByDate($company_ref, $date);
        
        if(empty($free_blocks))
            return $free_blocks;

        $g_from = $free_blocks[0][0];
        $g_to = $free_blocks[0][1];

        foreach($reservations as $r)
        {
            foreach($free_blocks as $k => $block)
            {
                if($block[0] <= $r->time_from && $block[1] >= $r->time_to)
                {
                    if($block[0] == $r->time_from)
                        $free_blocks[$k][0] = $r->time_to;
                    else if($block[1] == $r->time_to)
                        $free_blocks[$k][1] = $r->time_from;
                    else {
                        $end = $block[1];
                        $free_blocks[$k][1] = $r->time_from;
                        array_push($free_blocks, [$r->time_to, $end]);
                    }

                    if($free_blocks[$k][0] == $free_blocks[$k][1])
                        unset($free_blocks[$k]);
                }
            }
        }

        return $free_blocks;
    }

    /**
     * Parameters:
     * - date       [YYYY-MM-DD]
     * - time_from  [HH:MM:SS]
     * - time_to    [HH:MM:SS]
     */
    public function isTermFree($company_ref, $date, $time_from, $time_to)
    {
        $free_blocks = $this->getFreeHoursForDate($company_ref, $date);
        foreach($free_blocks as $block)
            if($block[0] <= $time_from && $block[1] >= $time_to)
                return true;

        return false;
    }


    protected function getColumnDayNameByInteger($day)
    {
        $column = '';
        switch($day)
        {
            case 1:
            $column = 'mon';
            break;
            case 2:
            $column = 'tue';
            break;
            case 3:
            $column = 'wed';
            break;
            case 4:
            $column = 'thu';
            break;
            case 5:
            $column = 'fri';
            break;
            case 6:
            $column = 'sat';
            break;
            case 7:
            $column = 'sun';
            break;
        }
        return $column;
    }
}
