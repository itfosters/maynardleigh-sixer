<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blocks extends ITF_Model
{
	protected $name = "blocks";

	public function __construct()
	{
		parent::__construct();
	}
	
		
	
	public function addBlock($data = array())
	{
		$this->db->save($this->name, $data);
	}


	public function updateBlock($data = array() , $where = array())
	{
		unset($data["id"]);
		$this->db->save($this->name, $data , $where);
	}
		
	public function getBlockById($pageid = "0")
	{ 
			$this->db->where("id",$pageid);
			$this->db->from($this->name);
                        $query = $this->db->get()->row();
			return $query;
	}
	
	public function statusupdate($ids = array(), $status = '1') {
        $this->db->where_in("id", $ids);
        $data["status"] = $status;
        $this->db->update($this->name, $data);
    }
    
	
	public function getBlockByName($blockname = "")
	{ 
			$this->db->where("name",$blockname);
			$this->db->from($this->name);
            $query = $this->db->get()->row_array();
			return $query;
	}
	
	public function getBlocks($perpage,$pg, $conditions=array())
	{ 
                    if(count($conditions)>0)
                        $this->db->or_like($conditions);
			$this->db->limit($perpage,$pg);
			$this->db->from($this->name);
                        $query = $this->db->get()->result();
			return $query;
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

	public function totalBlocks($conditions=array())
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
        public function statuchange($id="0")
        {
            //$res= $this->getPageById($id);
            $res = $this->db->select("id,status")->from($this->name)->where("id",$id)->get()->row();
            $status= "1";
            if(isset($res->status))
                $status = ($res->status=="1")?"0":"1"; 
            
            $data["status"] = $status;
            $this->db->save($this->name, $data , array("id"=>$id));
            return $status;
        }
}
