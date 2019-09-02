<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('setNullValue')) {
    function setNullValue($value) {
        return (empty(trim($value)) && $value !== 0) ? NULL : $value;
    }
}