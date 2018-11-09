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
       
        $dd=$this->db->save($this->name, $data, $where); 
        
    return $dd;

}

    public function getSubProductsById($userid = "0") {

        $this->db->from($this->name);

        $this->db->where("id", $userid);

        $query = $this->db->get()->row();

        return $query;
    }

    public function findSubProduct($conditions = array(), $perpage = 0, $pg = 0) {

        $this->db->from($this->name);



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



       // $this->db->order_by("name", "asc");
        $this->db->order_by("id", "desc");



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

    public function getSubProductsForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('active',1);
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
