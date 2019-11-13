<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model  {
    
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
    }

    public function add($amount)
    {
        $insert = $this->db->insert('transactions', array(
            'amount' => $amount,
            'result' => 0
        ));
        if($insert)
            return $this->db->insert_id();
        else
            return 0;
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('transactions', $data);
    }

    public function generateCRC($id)
    {
        return substr(base64_encode($id), 0, 128);
    }


}
