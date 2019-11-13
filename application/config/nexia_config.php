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

$config['avatars_path'] = 'uploads/avatars/';

// Tpay
$config['tpay_merchant_id'] = 1010;
$config['tpay_api_key'] = '75f86137a6635df826e3efe2e66f7c9a946fdde1';
$config['tpay_merchant_api_password'] = 'p@$$w0rd#@!';
$config['tpay_security_code'] = '';
