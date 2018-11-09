<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Economics extends ITF_Model {

    protected $name = "order_economic";
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	}
	public function getEconomic()
	{
		$this->db->select('location,contact_No,email_Id');
		$this->db->from($this->name);
		return $this->db->get()->result();
	} 
	
	  
}

