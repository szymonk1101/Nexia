<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiResult
{
	public $status;
	public $message;
	public $data;
	
	public function __construct($status = 0, $message = null, $data = null)
	{
		$this->status = $status;
		$this->message = ($message!==null) ? $message : lang('Invalid_data');
		$this->data = ($data!==null) ? $data : new stdClass();
	}
}