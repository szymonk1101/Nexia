<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Open_hours_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('hours_model');
    }

    protected function getNextOpenHoursId()
    {
        $q = $this->db->query("SELECT MAX(id) AS max FROM open_hours")->row();
        return ($q->max) ? $q->max+1 : 1;
    }

    public function add($data)
    {
        $this->db->trans_start();
        $valid_from = $this->db->escape($data['valid_from']);
        $company_ref = $this->db->escape($data['company_ref']);

        $oh_id = $this->getNextOpenHoursId();
        
        if(isset($data['staff_ref'])) {
            foreach($data['staff_ref'] as $staff_ref) {
                $this->db->query("UPDATE open_hours, oh_refs SET valid_to = $valid_from WHERE oh_refs.oh_ref=open_hours.id AND oh_refs.staff_ref = ".$this->db->escape($staff_ref)." AND open_hours.company_ref = $company_ref AND (valid_to is null OR valid_to > $valid_from)");
                $this->db->insert('oh_refs', array(
                    'oh_ref' => $oh_id,
                    'staff_ref' => $staff_ref
                ), TRUE);
            }
        }

        if(isset($data['service_ref'])) {
            foreach($data['service_ref'] as $service_ref) {
                $this->db->query("UPDATE open_hours, oh_refs SET valid_to = $valid_from WHERE oh_refs.oh_ref=open_hours.id AND oh_refs.service_ref = ".$this->db->escape($service_ref)." AND open_hours.company_ref = $company_ref AND (valid_to is null OR valid_to > $valid_from)");
                $this->db->insert('oh_refs', array(
                    'oh_ref' => $oh_id,
                    'service_ref' => $service_ref
                ), TRUE);
            }
        }

        if((!isset($data['staff_ref']) || empty($data['staff_ref'])) && (!isset($data['service_ref']) || empty($data['service_ref']))) {
            $this->db->query("UPDATE open_hours, oh_refs SET valid_to = $valid_from WHERE oh_refs.oh_ref=open_hours.id AND oh_refs.company_ref = $company_ref AND open_hours.company_ref = $company_ref AND (valid_to is null OR valid_to > $valid_from)");
            $this->db->insert('oh_refs', array(
                'oh_ref' => $oh_id,
                'company_ref' => $data['company_ref']
            ), TRUE);
        }

        $this->db->insert('open_hours', array(
            'id' => $oh_id,
            'name' => $data['name'],
            'mon_from' => setNullValue($data['mon_from']),
            'mon_to' => setNullValue($data['mon_to']),
            'tue_from' => setNullValue($data['tue_from']),
            'tue_to' => setNullValue($data['tue_to']),
            'wed_from' => setNullValue($data['wed_from']),
            'wed_to' => setNullValue($data['wed_to']),
            'thu_from' => setNullValue($data['thu_from']),
            'thu_to' => setNullValue($data['thu_to']),
            'fri_from' => setNullValue($data['fri_from']),
            'fri_to' => setNullValue($data['fri_to']),
            'sat_from' => setNullValue($data['sat_from']),
            'sat_to' => setNullValue($data['sat_to']),
            'sun_from' => setNullValue($data['sun_from']),
            'sun_to' => setNullValue($data['sun_to']),
            'valid_from' => $data['valid_from'],
            'valid_to' => setNullValue($data['valid_to']),
            'company_ref' => $data['company_ref']
        ), TRUE);

        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE) {
            return false;
        }
        return $oh_id;
    }

    // POWINNO DZIAŁAĆ
    public function getOpenHoursByDate($date, $company_ref, $staff_ref = false, $service_ref = false)
    {
        $result = new stdClass();
        $result->time_from = false;
        $result->time_to = false;

        $exceptions = $this->db->query("SELECT * FROM open_hours_exceptions WHERE `company_ref` = '$company_ref' AND `date` = '$date'")->row();

        if(empty($exceptions) && $staff_ref) {
            $exceptions = $this->db->query("SELECT * FROM open_hours_exceptions WHERE `staff_ref` = '$staff_ref' AND `date` = '$date'")->row();
        }

        if(empty($exceptions) && $service_ref) {
            $exceptions = $this->db->query("SELECT * FROM open_hours_exceptions WHERE `service_ref` = '$service_ref' AND `date` = '$date'")->row();
        }

        if(!empty($exceptions)) {
            if($exceptions->fullday == 0) {
                $result->time_from = $exceptions->time_from;
                $result->time_to = $exceptions->time_to;
            }
            // jeśli fullday to dalej time_from i time_to = false
        }
        else {
            $dayname = $this->getColumnDayNameByInteger(date('N', strtotime($date)));
            $open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours INNER JOIN oh_refs ON open_hours.id=oh_refs.oh_ref WHERE oh_refs.company_ref = '$company_ref' AND valid_from <= '$date' AND (valid_to is null OR valid_to > '$date')")->row();
            if(!empty($open_hours)) {
                $result->time_from = $open_hours->{$dayname.'_from'};
                $result->time_to = $open_hours->{$dayname.'_to'};
            }

            if($staff_ref) {
                $staff_open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours INNER JOIN oh_refs ON open_hours.id=oh_refs.oh_ref WHERE oh_refs.staff_ref = '$staff_ref' AND valid_from <= '$date' AND (valid_to is null OR valid_to > '$date')")->row();
                if(!empty($staff_open_hours)) {
                    $hours2 = new stdClass();
                    $hours2->time_from = $staff_open_hours->{$dayname."_from"};
                    $hours2->time_to = $staff_open_hours->{$dayname."_to"};
                    $result = $this->hours_model->minimumHours($result, $hours2);
                }
            }

            if($service_ref) {
                $service_open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours INNER JOIN oh_refs ON open_hours.id=oh_refs.oh_ref WHERE oh_refs.service_ref = '$service_ref' AND valid_from <= '$date' AND (valid_to is null OR valid_to > '$date')")->row();
                if(!empty($service_open_hours)) {
                    $hours2 = new stdClass();
                    $hours2->time_from = $service_open_hours->{$dayname."_from"};
                    $hours2->time_to = $service_open_hours->{$dayname."_to"};
                    $result = $this->hours_model->minimumHours($result, $hours2);
                }
            }
        }

        return $result;
    }

    public function getStaffOpenHoursByDate($date, $company_ref, $service_ref = false)
    {
        
    }

    /**
     * Parameters:
     * - date [YYYY-MM-DD]
     * - company_ref
     * - service_ref
     * - (staff_ref)
     */
    public function getFreeHoursForDate($date, $company_ref, $service_ref, $staff_ref = false)
    {
        $this->load->model('staff_model');
        $this->load->model('reservations_model');

        //$company_oh = $this->getOpenHoursByDate($date, $company_ref);
        $service_oh = $this->getOpenHoursByDate($date, $company_ref, false, $service_ref);

        $free_blocks = array();

        // jeśli staff nie został wybrany to bierzemy wszystkich
        if(!$staff_ref) {
            $staff = $this->staff_model->getCompanyStaff($company_ref);
            $staff_oh = array();
            foreach($staff as $s)
            {
                $s_oh = $this->getOpenHoursByDate($date, $company_ref, $s->id, $service_ref);
                if($s_oh->time_from != false && $s_oh->time_to != false) {
                    $s_oh->id = $s->id;
                    array_push($staff_oh, $s_oh);
                }
            }

            $staff_free_blocks = array();
            foreach($staff_oh as $s_oh) {
                $f_b = array();
                array_push($f_b, [$s_oh->time_from, $s_oh->time_to]);

                $reservations = $this->reservations_model->getStaffReservationsByDate($date, $s_oh->id);
                $f_b = $this->hours_model->excludeHoursArrays($f_b, $reservations);

                $staff_free_blocks = $this->hours_model->mergeHours($staff_free_blocks, $f_b);
            }

            return $staff_free_blocks;

        }
        else
        {
            $staff_oh = $this->getOpenHoursByDate($date, $company_ref, $staff_ref, $service_ref);
            if($staff_oh->time_from == false || $staff_oh->time_to == false) {
                return array();
            }

            $reservations = $this->reservations_model->getStaffReservationsByDate($date, $staff_ref);

            array_push($free_blocks, [$staff_oh->time_from, $staff_oh->time_to]);

            $free_blocks = $this->hours_model->excludeHoursArrays($free_blocks, $reservations);
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

        $open_hours = $this->db->query("SELECT * FROM open_hours INNER JOIN oh_refs ON open_hours.id=oh_refs.oh_ref WHERE oh_refs.company_ref = '$company_ref' AND ".$valid_whr)->result();
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
            if($exceptions->fullday == 0) {
                $result->time_from = $exceptions->time_from;
                $result->time_to = $exceptions->time_to;
            }
        }
        else {
            $dayname = $this->getColumnDayNameByInteger(date('N', strtotime($date)));
            $open_hours = $this->db->query("SELECT ".$dayname."_from, ".$dayname."_to FROM open_hours INNER JOIN oh_refs ON open_hours.id=oh_refs.oh_ref WHERE oh_refs.company_ref = '$company_ref' AND valid_from <= '$date' AND (valid_to is null OR valid_to > '$date')")->row();
            if(!empty($open_hours)) {
                $result->time_from = $open_hours->{$dayname.'_from'};
                $result->time_to = $open_hours->{$dayname.'_to'};
            }
        }
        
        return $result;
    }

    public function getOpenHoursDataTable($company_ref, $start=0, $length=10, $search, $order, $columns)
    {
        $return = new stdClass();
        $this->db->where('company_ref', $company_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('open_hours');

		/*if(isset($search['value']) && !empty($search['value'])) {
			$s = trim($seach['value']);
			$this->db->or_like(array(
				'id' => $s,
				'name' => $s,
				'valid_from' => $s,
				'valid_to' => $s
			));
		}
		
		if(!empty($order)) {
			foreach($order as $o) {
				if(isset($columns[$o['column']])) {
					$this->db->order_by($columns[$o['column']]['data'], $o['dir']);
				}
			}
		}
		
		if(!empty($columns))
		{
			foreach($columns as $c)
			{
				if(isset($c['search']['value']) && $c['search']['value'] != '')
				{
					$this->db->where($c['data'], $c['search']['value'], TRUE);
				}
			}
        }
		
		$this->db->limit($length, $start);*/

        $this->db->where('company_ref', $company_ref, TRUE);
        
        $return->recordsFiltered =  $return->recordsTotal;
        $return->data = $this->db->get('open_hours')->result();

        return $return;
    }

    public function getExceptionsDataTable($company_ref, $start=0, $length=10, $search, $order, $columns)
    {
        $return = new stdClass();
        $this->db->where('company_ref', $company_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('open_hours_exceptions');

        $this->db->where('company_ref', $company_ref, TRUE);
        $return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->get('open_hours_exceptions')->result();

        return $return;
    }

    public function getStaffOpenHoursDataTable($staff_ref, $start=0, $length=10, $search, $order, $columns)
    {
        $return = new stdClass();
        $this->db->join('oh_refs', 'open_hours.id=oh_refs.oh_ref');
        $this->db->where('oh_refs.staff_ref', $staff_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('open_hours', TRUE);

        $this->db->join('oh_refs', 'open_hours.id=oh_refs.oh_ref');
        $this->db->where('oh_refs.staff_ref', $staff_ref, TRUE);

        $return->recordsFiltered =  $return->recordsTotal;
        $return->data = $this->db->get('open_hours')->result();

        return $return;
    }

    public function getStaffExceptionsDataTable($staff_ref, $start=0, $length=10, $search, $order, $columns)
    {
        $return = new stdClass();
        $this->db->where('staff_ref', $staff_ref, TRUE);
        $return->recordsTotal = $this->db->count_all_results('open_hours_exceptions');

        $this->db->where('staff_ref', $staff_ref, TRUE);

        $return->recordsFiltered = $return->recordsTotal;
        $return->data = $this->db->get('open_hours_exceptions')->result();

        return $return;
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
