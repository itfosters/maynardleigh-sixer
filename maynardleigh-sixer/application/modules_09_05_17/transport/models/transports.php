<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transports extends ITF_Model {

    protected $name = "order_transportationname";
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	} 
	public function getTransportsName()
	{
		$this->db->select('*');
		$this->db->from($this->name);
		$this->db->where('active',1);
		return $this->db->get()->result();
	}
	
	  
}

