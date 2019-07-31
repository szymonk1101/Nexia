<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hours_model extends CI_Model  {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    /**
     * EVERY TIMES VARIABLES MUST BE IN FORMAT: HH:MM. FOR EXAMPLE 01:01
     */
    
    public function minimumHours($hours, $hours_2)
    {
        if(($hours_2->time_from && $hours->time_from < $hours_2->time_from) || !$hours->time_from)
            $hours->time_from = $hours_2->time_from;

        if(($hours_2->time_to && $hours->time_to > $hours_2->time_to) || !$hours->time_to)
            $hours->time_to = $hours_2->time_to;
        
        return $hours;
    }

    public function maximumHours($hours, $hours_2)
    {
        if(($hours_2->time_from && $hours->time_from > $hours_2->time_from) || !$hours->time_from)
            $hours->time_from = $hours_2->time_from;

        if(($hours_2->time_from && $hours->time_to < $hours_2->time_to) || !$hours->time_to)
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

    // DO PRZETESTOWANIA
    public function mergeHours($hours, $to_merge)
    {
        foreach($to_merge as $j => $r)
        {
            foreach($hours as $k => $block)
            {
                if($block['time_to'] >= $r['time_from'] && $block['time_to'] < $r['time_from'])
                {
                    $hours[$k]['time_to'] = $r['time_to'];
                }
                else if($block['time_from'] <= $r['time_to'] && $block['time_from'] > $r['time_from'])
                {
                    $hours[$k]['time_from'] = $r['time_from'];
                }
                else if($block['time_to'] < $r['time_from'] || $block['time_from'] > $r['time_to'])
                {
                    if(!in_array($r, $hours)) {
                        array_push($hours, $r);
                    }
                }

                print_r($hours);
                echo '<br />';
            }
        }

        return $hours;
    }



}
