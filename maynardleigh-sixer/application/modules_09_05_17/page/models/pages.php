<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends ITF_Model
{
	protected $name = "pages";

	public function __construct()
	{
		parent::__construct();
	}



	public function findByUrl($data = "")
	{
		$this->db->where('name', $data);
		$query = $this->db->get($this->name);
		if ($query->num_rows() == 1) 
			return $query->row();
		else
			return NULL;
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

	public function find($conditions,$perpage,$pg)
	{ 
		if(count($conditions)>0)
			$this->db->like($conditions);

		$this->db->limit($perpage,$pg);
		$this->db->from($this->name);
		$query = $this->db->get()->result();
		return $query;
	}

	public function totalData($conditions)
	{	
		if(count($conditions)>0)
			$this->db->like($conditions);

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

	public function statuchange($id="0")
	{
		$res = $this->db->select("id,status")->from($this->name)->where("id",$id)->get()->row();
		$status= "1";
		if(isset($res->status))
			$status = ($res->status=="1")?"0":"1"; 

		$data["status"] = $status;
		$this->db->save($this->name, $data , array("id"=>$id));
		return $status;
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

}
