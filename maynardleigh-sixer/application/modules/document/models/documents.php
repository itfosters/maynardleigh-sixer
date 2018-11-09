<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Documents extends ITF_Model {

    protected $name = "order_documentname";
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	} 
	public function getDocumentsName()
	{
		$this->db->select('*');
		$this->db->from($this->name);
		//$this->db->where('active',1);
		return $this->db->get()->result();
	}
	public function getDocumentsFile($orderid)
	{
		$this->db->select('order_id,file_name');
		$this->db->from($this->name);
		$this->db->where('order_id',$orderid);
		return $this->db->get()->result();
	}
	
	  
}

