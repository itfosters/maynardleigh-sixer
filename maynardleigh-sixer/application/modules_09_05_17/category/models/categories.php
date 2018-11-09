<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends ITF_Model
{
	protected $name = "category";

	public function __construct()
	{
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
	
	public function findByMultiId($pageid = "0")
	{ 
			if(!is_array($pageid)) {
				$pageid = explode(",",$pageid);
			}
			
			$this->db->select(array("id","name"));
			$this->db->where_in("id",$pageid);
			$this->db->from($this->name);
                        $query = $this->db->get()->result_array();			
			return $query;
	}
	
	public function findByName($blockname = "")
	{ 
			$this->db->select(array("id","name"));
			$this->db->like("name",$blockname);
			$this->db->from($this->name);
                        $query = $this->db->get()->result();
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
	
	
	
	
	public function findAll($limits ="0")
	{ 
			if($limits>0)
			$this->db->limit($limits);
			
			$this->db->where("status","1");
			$this->db->order_by("orders","asc");
			$this->db->from($this->name);
                        $query = $this->db->get()->result();
			return $query;
	}
	
	public function totalData($conditions=array())
	{           
            if(count($conditions)>0)
                 $this->db->or_like($conditions);
		
            $this->db->from($this->name);
			return $this->db->get()->num_rows;
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
       
		
    public function deleteMulti($data = array(),$condition="id")
	{
		if(count($data)>0) {				
			$this->db->where_in($condition,$data);
			$this->db->delete($this->name);
			return true;
		} else {
			return false;
		}
	}

	public function statusupdate($ids=array(),$status='1')
	{
		 $this->db->where_in("id",$ids);
		 $data["status"]= $status;
		 $this->db->update($this->name, $data); 			 
	}
}
