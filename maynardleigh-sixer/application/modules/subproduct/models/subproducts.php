<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subproducts extends ITF_Model {

    protected $name = "subproducts";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */

    public function updateSubProduct($data = array(), $where = array()) {
          //echo "<pre>@@@@@@@";print_r($data);
          //echo "<pre>@@@@@@@";print_r($where);die;
        $dd=$this->db->save($this->name,$data,$where); 
        
    return $dd;

}

    public function getSubProductsById($userid = "0") {

        $this->db->from($this->name);

        $this->db->where("id", $userid);

        $query = $this->db->get()->row();

        return $query;
    }
       public function getSubProducts() {

        $this->db->from($this->name);

       // $this->db->where("id", $userid);

        $query = $this->db->get()->result();

        return $query;
    }

    public function findSubProduct($conditions = array(), $perpage = 0, $pg = 0) {

        $this->db->from($this->name);
        $this->db->where('parent_id','0');



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



       // $this->db->order_by("name", "asc");
        $this->db->order_by("id", "desc");



        $query = $this->db->get()->result();
//echo "##<pre>";print_r($this->db->last_query());die;
        return $query;
    }
    public function getChildProductName($childid)
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('id',$childid);
        $this->db->order_by('id','desc');
        return $this->db->get()->row();
    }
      public function findChild($id,$conditions = array(), $perpage = 0, $pg = 0) {
        //echo "##<pre>";print_r($id);die;
        $this->db->from($this->name);
        $this->db->where('parent_id',$id);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage=10000, $pg=0);



       // $this->db->order_by("name", "asc");
        $this->db->order_by("id", "desc");



        $query = $this->db->get()->result();
//echo "##<pre>";print_r($this->db->last_query());die;
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




//echo "##<pre>";print_r($id);die;
        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);

            $this->db->where('parent_id','0');

        return $this->db->get()->num_rows();
    }
    public function totalChildData($id,$conditions = array()) {




//echo "##<pre>";print_r($id);die;
        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);

            $this->db->where('parent_id',$id);

        return $this->db->get()->num_rows();
    }


    public function getSubProductsForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('active',1);
        $this->db->where('parent_id',0);
        $this->db->order_by('name');
        return $this->db->get()->result();
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
