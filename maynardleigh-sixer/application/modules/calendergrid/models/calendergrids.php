<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendergrids extends ITF_Model {

    protected $name = "product";
   
     protected $mrs_list = "mrs_list";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */

    public function updateProduct($data = array(), $where = array()) {
       
        $dd=$this->db->save($this->name, $data, $where); 
        
    return $dd;

}

    public function getUsersById($userid = "0") {

        $this->db->from($this->name);

        $this->db->where("id", $userid);

        $query = $this->db->get()->row();

        return $query;
    }

    public function findUser($conditions = array(), $perpage = 0, $pg = 0) {

        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



        $this->db->order_by("name", "asc");



        $query = $this->db->get()->result();

        return $query;
    }

    public function find($conditions = array(), $perpage = 0, $pg = 0) {

        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



        $this->db->order_by("name", "asc");



        $query = $this->db->get()->result();

        return $query;
    }

    public function totalData($conditions = array()) {





        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        return $this->db->get()->num_rows;
    }

    public function getProductsForSelect($typeid=0)
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('active',1);
		$this->db->where('product_type',$typeid);
        return $this->db->get()->result();
    }
    public function getProductPrice($pid)
    {
        $this->db->select('price');
        $this->db->from($this->name);
        $this->db->where('id',$pid);
       $query= $this->db->get()->row();
       //echo "<pre>";print_r($this->db->last_query());die;
       return $query;
    }

public function getAllMrs ()
    {
        $this->db->select('id,name');
        $this->db->from($this->mrs_list);
        
       $query= $this->db->get()->row();
       //echo "<pre>";print_r($this->db->last_query());die;
       return $query;
    }
    public function addmrspro($data=array(),$where=array())
    {
        //echo "!!!<pre>";print_r($data);
                    //print_r($where);die;
        $this->db->delete($this->mrs_list,$where);
        if(count($data)>0 and count($where)>0){
         	$this->db->insert_batch($this->mrs_list,$data);
		}
    }
    public function getMrsProduct()
    {
        $this->db->select('id,name');
        $this->db->from($this->mrs_list);
        $query= $this->db->get()->result();
        return $query;
    
    }

    public function delete($data = array()) {

        if (count($data) > 0) {

            $this->db->where($data);

            $this->db->delete($this->name);

            return true;
        } else {

            return false;
        }
    }

    public function deleteMulti($data = array(), $condition = "id") {

        if (count($data) > 0) {

            $this->db->where_in($condition, $data);

            $this->db->delete($this->name);

            return true;
        } else {

            return false;
        }
    }

    

}
