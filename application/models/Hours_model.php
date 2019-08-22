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
    
    /**
     * Wybiera minimalny zakres time_from - time_to z dwóch zakresów. Jeżeli który zakres false, zwraca pusty zakres false-false.
     */
    public function minimumHours($hours, $hours_2)
    {
        if(!$hours->time_from || !$hours->time_to || !$hours_2->time_from || !$hours_2->time_to) {
            $hours->time_from = false;
            $hours->time_to = false;
            return $hours;
        }

        if($hours->time_from < $hours_2->time_from)
            $hours->time_from = $hours_2->time_from;

        if($hours->time_to > $hours_2->time_to)
            $hours->time_to = $hours_2->time_to;
        
        return $hours;
    }

    /**
     * Wybiera maksymalny zakres time_from - time_to z dwóch zakresów. False zastępuje nie pustym.
     */
    public function maximumHours($hours, $hours_2)
    {
        if(($hours->time_from && $hours_2->time_from && $hours->time_from > $hours_2->time_from) || !$hours->time_from)
            $hours->time_from = $hours_2->time_from;

        if(($hours->time_to && $hours_2->time_from && $hours->time_to < $hours_2->time_to) || !$hours->time_to)
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

    // DO PRZETESTOWANIA, PRAWDOPODOBNIE DZIAŁA
    public function mergeHours($hours, $to_merge)
    {
        foreach($to_merge as $j => $r)
        {
            $to_push = true;
            foreach($hours as $k => $block)
            {
                $unset = false;
                if($unset) continue;

                if($block[0] <= $r[0] && $block[1] >= $r[1]) {
                    unset($to_merge[$j]);
                    $unset = true;
                    $to_push = false;
                }
                else if($r[0] >= $block[0] && $r[0] <= $block[1] && $r[1] > $block[1]) {
                    $hours[$k][1] = $r[1];
                    $to_push = false;
                }
                else if($r[1] >= $block[0] && $r[1] <= $block[1] && $r[0] < $block[0]) {
                    $hours[$k][0] = $r[0];
                    $to_push = false;
                }
                else if($r[0] <= $block[0] && $r[1] >= $block[1]) {
                    $hours[$k][1] = $r[1];
                    $hours[$k][0] = $r[0];
                    $to_push = false;
                }

            }

            if($to_push && !in_array($r, $hours)) {
                array_push($hours, $r);
            }

            unset($to_merge[$j]);
        }

        $hours = array_merge($hours);
        $return = $hours;
        // merge hours
        for($j=0; $j < count($hours); $j++)
        {
            $r = $hours[$j];
            for($k=$j+1; $k < count($hours); $k++)
            {
                $unset = false;
                if(!isset($hours[$k]) || $unset || $j == $k) continue;

                $block = $hours[$k];

                if($block[0] <= $r[0] && $block[1] >= $r[1]) {
                    unset($return[$j]);
                    $unset = true;
                }
                else if($r[0] >= $block[0] && $r[0] <= $block[1] && $r[1] > $block[1]) {
                    $return[$j][0] = $block[0];
                    unset($return[$k]);
                }
                else if($r[1] >= $block[0] && $r[1] <= $block[1] && $r[0] < $block[0]) {
                    $return[$j][1] = $block[1];
                    unset($return[$k]);
                }
                else if($r[0] <= $block[0] && $r[1] >= $block[1]) {
                    unset($return[$k]);
                }
            }
        }

        uasort($return, 'mul_sort');
        return array_merge($return);
    }

}

// do sortowania tablicy po wartości tablicy wewnętrznej
function mul_sort($a,$b)
{
    if($a[0] > $b[0])
        return 1; 

    if($a[0] < $b[0])
        return -1;

    if($a[0] == $b[0])
        return 0;
}