<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tpay extends MY_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->load->model('transactions_model');
    }

    public function notify()
    {
        $ipTable = array('195.149.229.109', '148.251.96.163', '178.32.201.77', '46.248.167.59', '46.29.19.106', '176.119.38.175');

        if(in_array($_SERVER['REMOTE_ADDR'], $ipTable) && !empty($_POST)) {

            $sellerID = $_POST['id'];
            $transactionStatus = $_POST['tr_status'];
            $transactionID = $_POST['tr_id'];
            $transactionAmount = $_POST['tr_amount'];
            $paidAmount = $_POST['tr_paid'];
            $error = $_POST['tr_error'];
            $transactionDate = $_POST['tr_date'];
            $transactionDescription = $_POST['tr_desc'];
            $crc = $_POST['tr_crc'];
            $customerEmail = $_POST['tr_email'];
            $md5sum = $_POST['md5sum'];

            if ($transactionStatus == 'TRUE' && $error == 'none') {

                $this->load->library('Tpay');

                $this->tpay->verifyTransactionNotify($this->input->post());

                /*
                More functions:
                - Verification of md5sum
                - Identifying transaction by CRC
                - Paid amount verification
                - Verification of order status
                */
                if ($allOk) {
                    // Changing order status
                    // Response to tpay server
                    echo 'TRUE';
                } else {
                    echo 'FALSE - ...'; // describe your error
                }
    
            } else {
                // Transaction processed with error but handled by merchant system
                echo 'TRUE';
            }

        } else {
            echo 'FALSE - Invalid request';
        }
    }
}
