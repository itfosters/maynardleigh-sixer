<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socialusers extends ITF_Model
{
	protected $name = "users";

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
	public function register_fbuser($data = array())
	{
		if(!isset($data["password"]) or empty($data["password"])) {
			unset($data["password"]);
		}
		else{
			$data["password"]=md5($data["password"]);
		}
		$data["username"]="AB".time();
		$this->db->save($this->name, $data);
		return $this->db->insert_id();
	}
	
	public function update($data = array(),$condition = array())
	{
		return  $this->db->save($this->name, $data,$condition);
	}
	
	public function getUsersById($userid = "0")
	{ 
			$this->db->where("id",$userid);
			$this->db->from($this->name);
	        $query = $this->db->get()->row();
			return $query;
	}
	
	public function getUsersByEmail($emailid = "")
	{ 
			$this->db->where("email",$emailid);
			$this->db->from($this->name);
	        $query = $this->db->get()->row();
			return $query;
	}
	
	
	
}
