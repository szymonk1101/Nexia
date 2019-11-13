<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tpay
{
    private $CI;
    private $apiKey;
    private $apiPassword;
    private $securityCode;
    public $notifyUrl;
    public $merchantId;

    public function __construct(Type $var = null)
    {
        $this->CI = &get_instance();
        $this->apiKey = $this->CI->config->item('tpay_api_key');
        $this->apiPassword = $this->CI->config->item('tpay_merchant_api_password');
        $this->securityCode = $this->CI->config->item('tpay_security_code');
        $this->merchantId = $this->CI->config->item('tpay_merchant_id');
        $this->notifyUrl = base_url('api/tpay/notify');
    }

    public function request($method, $body)
    {
        $body['api_password'] = $this->apiPassword;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.tpay.com/api/gw/".$this->apiKey."/".$method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        $output = curl_exec($ch);
        if(curl_errno($ch) != 0)
        {
            $return = array(
                'result' => 0,
                'errno' => curl_errno($ch),
                'error' => curl_error($ch)
            );
            curl_close($ch);
            return $return;
        }
        curl_close($ch);

        return json_decode($output, true);
    }

    public function getSecurityCode()
    {
        return $this->securityCode;
    }

}

class Transaction
{
    private $tpay;

    public function __construct(TPay $tpay) {
        $this->tpay = $tpay;    
    }
    
    public function create($crc, $bank_group, $amount, $customer_email, $customer_name, $description = "")
    {
        $body = array(
            'id' => $this->tpay->merchantId, // merchant id
            'amount' => number_format($amount, 2), // Transaction amount. Please always send the amount with two decimal places like 10.00
            'description' => $description, // Max length: 128
            'md5sum' => $this->generateMd5Sum($this->tpay->merchantId, number_format($amount, 2), $crc, $this->tpay->getSecurityCode()), // length 32
            'group' => $bank_group,
            'email' => $customer_email, // customer email
            'name' => $customer_name, // customer name,
            'crc' => $crc, // id do identyfikacji przez nas
            'result_url' => $this->tpay->notifyUrl
        );

        $output = $this->tpay->request('transaction/create', $body);

        return $output;


    }

    public function generateMd5Sum($id, $amount, $crc, $code)
    {
        return md5($id . $amount . $crc . $code);
    }


}

