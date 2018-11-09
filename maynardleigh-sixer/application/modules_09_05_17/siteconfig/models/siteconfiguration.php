<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteconfiguration extends ITF_Model
{
	protected $name = "siteconfig";

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getMeta($data = array())
	{
		//$this->db->order_by('orders');
		$this->db->from($this->name);
		$query = $this->db->get()->result();
		return $query;
	}	
	
	public function updateSiteConfig($data = array())
	{
		$allconfigdata = array();
		foreach($data as $k=>$dt) {
			$allconfigdata[]= array("field_value"=>$dt , "field_code"=>$k);
		}
		$this->db->update_batch($this->name, $allconfigdata , "field_code");
               
		
	}
		
	public function getSiteConfig()
	{ 
			$this->db->where("status","1");
			$this->db->order_by("orders");
			$this->db->from($this->name);
	        $query = $this->db->get()->result();
			return $query;
	}
	
}
