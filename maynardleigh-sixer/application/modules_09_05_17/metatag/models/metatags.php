<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Metatags extends ITF_Model
{
	protected $name = "metatags";

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Hashes the password to be stored in the database.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function register($data = array())
	{
		$this->db->save($this->name, $data);
		return $this->db->insert_id();
	}

	public function updateMetatag($data = array() , $where = array())
	{
            return $this->db->save($this->name, $data , $where);
	}
		
	public function getMetatagsById($metatagid = "0")
	{ 
			$this->db->where("id",$metatagid);
			$this->db->from($this->name);
	                $query = $this->db->get()->row();
			return $query;
	}
	
	public function getMetatags($conditions = array(),$perpage=0,$pg=0)
	{ 
			if(count($conditions)>0)
				$this->db->or_like($conditions);

			if($pg>0)
				$this->db->limit($perpage,$pg);
			
			$this->db->order_by("id","desc");
			$this->db->from($this->name);
	                $query = $this->db->get()->result();
			return $query;
	}
	
	public function totalMetatags($conditions = array())
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
        public function getMetatagStatus()
	{ 
            $this->db->where("status","1");
            $this->db->order_by("name","asc");
            $this->db->from($this->name);
            $query = $this->db->get()->result();
            return $query;
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

	public function getMetaTagInfo($str="")
     {
			 
		 $res = $this->db->select("*")
		 				->from($this->name)
		 				->where_in("urlname",$str)
		 				->get()
		 				->row();

		 return $res;
	}
}
