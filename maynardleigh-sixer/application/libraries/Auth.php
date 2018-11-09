<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth {

    public $authorize = "users";
    public $username = "username";
    public $password = "password";
    public $usertype = "user_type";
    public $fields = array();
    public $scope = array();
    public $userid = "id";
    public $loginurl = "";
    public $logouturl = "";
    private $ITF;
    protected $usertable = "users";

    /**
     * Constructor
     */
    public function __construct() {
        $this->ITF = & get_instance();
    }

    // --------------------------------------------------------------------------

    public function login() {

        $this->ITF->db->select('id', false);
        $username = $this->ITF->input->post($this->username);
        $password = $this->ITF->input->post($this->password);

        if (empty($username) or empty($password))
            return false;
        //echo "@@@<pre>";print_r($this->ITF->input->post($this->username)."ranu".$this->ITF->input->post($this->password));die;
        $this->ITF->db->where($this->username, $this->ITF->input->post($this->username));
        $this->ITF->db->where($this->password, md5($this->ITF->input->post($this->password)));
//echo "@@@<pre>";print_r($username."ranu".$password);die;
        foreach ($this->scope as $keys => $itfdt) {
            $this->ITF->db->where($keys, $itfdt);
        }

        foreach ($this->fields as $itfdt) {
            $this->ITF->db->where($itfdt, $this->ITF->input->post($itfdt));
        }
//echo "@@@222<pre>";print_r($this->ITF->db->get($this->authorize));die;

        $userdata = $this->ITF->db->get($this->authorize)->row();
        //echo "@@@222<pre>";print_r($this->ITF->db->last_query());die;
        //echo "@@@!!<pre>";print_r($userdata);die;

        if (count($userdata) > 0) {
            $userinfo = array("userid" => $userdata->id, "username" => $this->ITF->input->post($this->username));
            //echo "<pre>";print_r($userinfo);die;
            $this->ITF->session->set_userdata($userinfo);
            return true;
        } else {
            return false;
        }
    }

    //change password start here
    public function changePassword($userid, $Oldpassword, $Newpassword) {

        $this->ITF->db->where($this->userid, $userid);
        $this->ITF->db->where($this->password, md5($Oldpassword));
        $userdata = $this->ITF->db->get($this->authorize)->row();

        if (count($userdata) > 0) {
            //update password
            $data = array('password' => md5($Newpassword));
            $this->ITF->db->save($this->usertable, $data, array("id" => $userid));
            return true;
        } else {
            return false;
        }
    }

    //change password end here
    // --------------------------------------------------------------------------

    public function logout() {
        //$userinfo = array("userid" => "", "username" => "");
        $userinfo = array("userid" => "", "username" => "","resouceurl"=>"");
        $this->ITF->session->unset_userdata($userinfo);
        return true;
    }

    // --------------------------------------------------------------------------

    public function getUserId() {
        return ($this->ITF->session->userdata('userid')) ? $this->ITF->session->userdata('userid') : "0";
    }

    public function getLastUrl() {
        return ($this->ITF->session->userdata('LastUrl')) ? $this->ITF->session->userdata('LastUrl') : "";
    }

    // --------------------------------------------------------------------------

    public function isLoggedIn() {
        if ($this->ITF->session->userdata('userid')) {
            return true;
        } else {
            $this->ITF->session->set_userdata(array('LastUrl' => uri_string()));
            return false;
        };
    }

    public function getUserType() {

        if ($this->ITF->session->userdata('userid')) {
            $this->ITF->db->select($this->usertype, false);
            $this->ITF->db->where("id", $this->ITF->session->userdata('userid'));
            $userdata = $this->ITF->db->get($this->authorize)->row();
            return isset($userdata->user_type) ? $userdata->user_type : "";
        } else {
            return "";
        }
    }

    // --------------------------------------------------------------------------

    public function loginRedirect() {
        return !empty($this->loginurl) ? $this->loginurl : array();
    }

    public function logoutRedirect() {
        return !empty($this->logouturl) ? $this->logouturl : array();
    }

}
