<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_Detail extends ITF_Model {

    protected $name = "contact_detail";
    
    public function __construct() {
        parent::__construct();
    }

   public function save($data = array())
	{
		$this->db->save($this->name, $data);
	}


	public function update($data = array() , $where = array())
	{
		unset($data["id"]);
		$this->db->save($this->name, $data , $where);
	}
	
		
	public function findById($pageid = "0")
	{ 
		$this->db->where("id",$pageid);
		$this->db->from($this->name);
		$query = $this->db->get()->row();
		return $query;
	}
	
	
	
	public function find($perpage,$pg,$conditions=array())
    { 
		if(count($conditions)>0)
		$this->db->or_like($conditions);

		$this->db->limit($perpage,$pg);
		$this->db->from($this->name);
		$query = $this->db->get()->result();
		return $query;
	}
	
	
	public function delete($data = array())
	{
		if(count($data)>0) {
			$this->db->delete($this->name,$data);
			return true;
		} else {
			return false;
		}
	}
       
    	  
}