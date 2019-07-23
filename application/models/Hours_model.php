<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hours_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }


    // DO PRZETESTOWANIA
    public function minimumHours($hours, $hours_2)
    {
        if($hours->time_from < $hours_2->time_from)
            $hours->time_from = $hours_2->time_from;

        if($hours->time_to > $hours_2->time_to)
            $hours->time_to = $hours_2->time_to;
        
        return $hours;
    }

    // DO PRZETESTOWANIA
    public function maximumHours($hours, $hours_2)
    {
        if($hours->time_from > $hours_2->time_from)
            $hours->time_from = $hours_2->time_from;

        if($hours->time_to < $hours_2->time_to)
            $hours->time_to = $hours_2->time_to;
        
        return $hours;
    }

    // DO PRZETESTOWANIA
    public function excludeHoursArrays($free, $to_excluded)
    {
        foreach($to_excluded as $r)
        {
            foreach($free as $k => $block)
            {
                if($block[0] <= $r->time_from && $block[1] >= $r->time_to)
                {
                    if($block[0] == $r->time_from)
                        $free[$k][0] = $r->time_to;
                    else if($block[1] == $r->time_to)
                        $free[$k][1] = $r->time_from;
                    else {
                        $end = $block[1];
                        $free[$k][1] = $r->time_from;
                        array_push($free, [$r->time_to, $end]);
                    }

                    if($free[$k][0] == $free[$k][1])
                        unset($free[$k]);
                }
            }
        }

        return $free;
    }

    public function mergeHours($hours, $to_merge)
    {
        
    }



}
