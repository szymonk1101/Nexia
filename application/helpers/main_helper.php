<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('cutTimeToMinutes')) {
    function cutTimeToMinutes($value) {
        return substr($value, 0, 5);
    }
}