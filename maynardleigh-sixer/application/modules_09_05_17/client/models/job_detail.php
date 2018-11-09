<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Job_Detail extends ITF_Model {

    protected $name = "jobs";
    protected $users = "users";
    protected $job_types = "job_types";
    protected $job_category = "job_category";
    protected $location = "location";
    
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

	function getUsersJobById($userid="")
	{
		
		$this->db->select("U.*,J.id as job_id,J.job_type_id,J.job_category_id,J.join_date,J.location_id,J.contract_start_date,J.contract_end_date,
		J.contract_detail,J.salary,J.emp_status,JT.name as job_title,JC.name as job_category,L.city,L.state,L.pincode,L.phone as company_phone,
		L.address");
		$this->db->from($this->users." U");
		$this->db->join($this->name." J","U.id=J.user_id","LEFT");
		$this->db->join($this->job_types." JT","J.job_type_id=JT.id","LEFT");
		$this->db->join($this->job_category." JC","J.job_category_id=JC.id","LEFT");
		$this->db->join($this->location." L","J.location_id=L.id","LEFT");
		$this->db->where("U.id", $userid);
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