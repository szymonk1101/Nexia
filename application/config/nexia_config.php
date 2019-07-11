<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['service_name'] = 'Nexia';

// AUTH
$config['identity_column'] = 'email';
$config['remember_life_time'] = 1000*60*60*24;
$config['token_life_time'] = 1000*60*60;
$config['token_cookie_name'] = 'token';
$config['token_header_name'] = 'token';
$config['remember_cookie_name'] = 'remember_token';