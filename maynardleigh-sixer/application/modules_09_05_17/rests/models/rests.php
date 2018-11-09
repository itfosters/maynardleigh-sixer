<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Restss extends ITF_Model {
protected $name = "clients";
    
   
    public function __construct() {

        parent::__construct();
    }
    public function adddata()
    {
    	$s= "hgsydhsudh";
    	return $s;
    }
    public function showAll()
    {
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->where('active',1);
        return $this->db->get()->result();
    }

}
