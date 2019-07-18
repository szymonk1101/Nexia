<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model  {
    
    protected $identity_column;
    protected $remember_life_time;
    protected $token_life_time;
    protected $token_cookie_name;
    protected $token_header_name;
    protected $remember_cookie_name;
    protected $cookie_domain;
    protected $cookie_secure;
    protected $cookie_httponly;

	public function __construct()
	{
        parent::__construct();
        $this->load->database();

        $this->identity_column = $this->config->item('identity_column');
        $this->remember_life_time = $this->config->item('remember_life_time');
        $this->token_life_time = $this->config->item('token_life_time');
        $this->token_cookie_name = $this->config->item('token_cookie_name');
        $this->token_header_name = $this->config->item('token_header_name');
        $this->remember_cookie_name = $this->config->item('remember_cookie_name');
        $this->cookie_domain = $this->config->item('cookie_domain');
        $this->cookie_secure = $this->config->item('cookie_secure');
        $this->cookie_httponly = $this->config->item('cookie_httponly');
    }

    public function login($identity, $password, $remember = FALSE)
    {
        $result = new stdClass();
        $result->status = 0;
        $result->message = '';
        $result->data = new stdClass();

        $now = time();

        if(empty($identity) || empty($password)) {
            $result->message = lang('Invalid_data');;
            return $result;
        }

        $user = $this->db->select($this->identity_column . ', id, password, active, lastlogin')
            ->where($this->identity_column, $identity, TRUE)
            ->get('users', 1)->row();

        //check password
        $passOk = false;
        if(!empty($user) && isset($user->password))
            $passOk = password_verify($password, $user->password);

        if($passOk) 
        {
            //password okay
            if($user->active != USER_ACTIVE) {
                //user noactive
                $result->status = 0;
                $result->message = lang('YouAccountIsInactive');
                return $result;
            }

            //remember
            $remember_code = uniqid();
            $remember_expdate = $now;
            if($remember) {
                $remember_code = $this->getRememberCode();
                $remember_expdate = $now + $this->remember_life_time;

                $result->data->remember_code = $remember_code;
            }

            //new token
            $token = $this->generateToken($user->{ $this->identity_column });
            $expdate = $now + $this->token_life_time;

            //mysql update
            $this->db->where($this->identity_column, $identity, TRUE)
                ->update('users', array(
                    'token' => $token,
                    'token_expdate' => $expdate,
                    'remember_code' => $remember_code,
                    'lastlogin' => date('Y-m-d H:i:s', $now),
                    'ip_address' => (string)$this->input->ip_address(),
                    //'modifiedby' => $user->id,
                    //'datemodified' => date('Y-m-d H:i:s'),
                    'login_attempts' => 0,
                    'last_login_attempt' => $now,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT']
                )
            );

            if($this->db->affected_rows() > 0) {

                //setcookie
                setcookie($this->token_cookie_name, $token, $expdate, '/', $this->cookie_domain, $this->cookie_secure, $this->cookie_httponly);
                setcookie($this->remember_cookie_name, $remember_code, $remember_expdate, '/', $this->cookie_domain, $this->cookie_secure, $this->cookie_httponly);

                $result->status = 1;
                $result->message = lang('LoginSuccessful');
                $result->data->token = $token;
                return $result;
            }

        } else {
            //wrong password
            if(!empty($user)) {
    
                self::$db->where('id', $user->id, TRUE)
                ->update('users', array(
                    'token' => uniqid(),
                    'token_expdate' => $now,
                    'login_attempts' => $user->login_attempts+1,
                    'last_login_attempt' => $now,
                    'ip_address' => (string)$this->input->ip_address(),
                    //'modifiedby' => 0,
                    //'datemodified' => date('Y-m-d H:i:s')
                    'user_agent' => $_SERVER['HTTP_USER_AGENT']
                ));
            }

            $result->status = 0;
            $result->message = lang('InvalidLoginData');
            return $result;
        }
    }

    public function is_logged($refresh_token = TRUE)
    {
        $token = $this->getToken();

        if(!$token) {

            //check remember
            $remember_code = isset($_COOKIE[$this->remember_cookie_name]) ? $_COOKIE[$this->remember_cookie_name] : FALSE;

            if($remember_code) {
            
                $query = $this->db->select($this->identity_column.', token, user_agent')
                    ->where('remember_code', $remember_code, TRUE)
                    ->get('users')->row();
                
                if(!empty($query) && isset($query->token) && !empty($query->token)) 
                {

                    //check user agent
                    if($query->user_agent && $query->user_agent !=  $_SERVER['HTTP_USER_AGENT']) {
                        $this->logout();
                    }
                    
                    if($refresh_token)
                        $this->update_token_lifetime($query->token); //refresh token expiration
                    
                    return true;
                }
            }
            return false;

        } else {
            //check token
            $query = $this->db->select('token, token_expdate, user_agent')
                ->where('token', $token, TRUE)
                ->get('users')->row();

            if(!empty($query) && isset($query->token) && !empty($query->token)) 
            {

                //check user agent
                if($query->user_agent && $query->user_agent !=  $_SERVER['HTTP_USER_AGENT']) {
                    $this->logout();
                }

                //check token expiration
                $now = time();
                if($query->token_expdate > $now) {
                    if($refresh_token)
                        $this->update_token_lifetime($token); //refresh token expiration
                    
                    return true;
                }
            }
        }

        return false;
    }

    public function logout()
    {
        $token = $this->getToken();
        
        unset($_COOKIE[$this->token_cookie_name]);
        unset($_COOKIE[$this->remember_cookie_name]);

        if($token) {
            
            $user = $this->db->select('id')
                ->where('token', $token, TRUE)
                ->get('users', 1)->row();

            $this->db->update('users', 
                array(
                    'token_expdate' => time(),
                    'token' => uniqid(),
                    //'datemodified' => $now,
                    //'modifiedby' => (isset($user->id)) ? $user->id : 0),
                ),
                'token=\''.$token.'\''
            );
        }

        return true;
    }

    public function register($identity, $password, $additional_data = array())
    {
        $result = new stdClass();
        $result->status = 0;
        $result->message = lang('Invalid_data');;
        
        if($this->identity_check($identity)) 
        {
            $result->message = lang('?????');
            return $result;
        }
        
        // IP Address
        $ip_address = (string)$this->input->ip_address();
        $password = $this->hash_password($password);
        
        // Users table.
        $data = array(
            'firstname' => '',
            'lastname' => '',
            'phone' => '',
        );
        $additional_data = array_merge($data, $additional_data);
        
        //email activation code
        if(!isset($additional_data['activation_code']) || empty($additional_data['activation_code'])) {
            $additional_data['activation_code'] = $this->generate_activation_code();
        }
        
        $now = time();

        $this->db->trans_start();
        
        $this->db->insert('users', array(
            $this->identity_column => $identity,
            'ip_address' => $ip_address,
            'password' => $password,
            'created' => date('Y-m-d H:i:s', $now),
            'active' => USER_INACTIVE,
            'activation_code' => $additional_data['activation_code']
        ));
        
        $this->db->trans_complete();
        
        $result->status = 1;
        $result->message = lang('AccountCreatedSuccessful');
        $result->data = new stdClass();
        $result->data->activation_code = $additional_data['activation_code'];
        return $result;
    }

    
    public function getToken()
    {
        //COOKIES
        $token = isset($_COOKIE[$this->token_cookie_name]) ? $_COOKIE[$this->token_cookie_name] : FALSE;
        //HEADERS
        if(!$token) {
            $headers = getallheaders();
            $token = isset($headers[$this->token_header_name]) ? $headers[$this->token_header_name] : FALSE;
        }
        //POST
        if(!$token) {
            $token = isset($_POST[$this->token_cookie_name]) ? $_POST[$this->token_cookie_name] : FALSE;
        }
        return $token;
    }

    public function getUserId()
    {
        $token = $this->getToken();
        if($token) {
            $query = $this->db->select('id')->where('token', $token, TRUE)->get('users')->row();
            if(!empty($query)) {
                return $query->id;
            }
        }
        return -1;
    }

    public function getUserIdentity()
    {
        $token = $this->getToken();
        if($token) {
            $query = $this->db->select($this->identity_column)->where('token', $token, TRUE)->get('users')->row();
            if(!empty($query)) {
                return $query->{$this->identity_column};
            }
        }
        return false;
    }

    public function getUserHeaderData()
    {
        $token = $this->getToken();
        if($token) {
            $query = $this->db->select($this->identity_column.', rank, avatar')->where('token', $token, TRUE)->get('users')->row();
            return $query;
        }
        return false;
    }

    public function update_token_lifetime($token)
    {
        if($token != '')
        {
            $expdate = time() + $this->token_life_time;

            setcookie($this->token_cookie_name, $token, $expdate, '/', $this->cookie_domain, $this->cookie_secure, $this->cookie_httponly);

            return $this->db->update('users', array(
                    'token_expdate' => $expdate,
                    //'datemodified' => date('Y-m-d H:i:s'),
                    //'modifiedby' => $this->getUserId()
                ), 'token = \''.$token.'\'');
        }
        else
            return false;
    }

    public function generateToken($identity)
    {
        $this->load->helper('string');
        return random_string('alnum', 128).md5($identity.time());
    }

    public function getRememberCode()
    {
        return substr(uniqid(md5('remember').time()), 0, 40);
    }

    protected function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function identity_check($identity)
    {
        return $this->db->where($this->identity_column, $identity)->count_all_results('users') > 0;
    }

    public function generate_activation_code()
    {
        $this->load->helper('string');
        return random_string('alnum', 40);
    }
    
}
