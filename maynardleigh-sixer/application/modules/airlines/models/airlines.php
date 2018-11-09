<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends ITF_Model {

    protected $name = "product";
    protected $subpro = "subproducts";
   
     protected $mrs_list = "itf_mrs_list";
     protected $mrsrecord = "itf_mrs_record";
   
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
       
        $this->db->save($this->name, $data, $where); 
        
    return $this->db->insert_id();

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
        $this->db->select('price,weight');
        $this->db->from($this->name);
        $this->db->where('id',$pid);
       $query= $this->db->get()->row();
       //echo "<pre>";print_r($this->db->last_query());die;
       return $query;
    }
    public function getDeliyverProductsForSelect($pid=0)
    {
        $this->db->select('ML.id,ML.name');
        //$this->db->from($this->name." as P");
        //$this->db->from($this->mrsrecord." as M");
        $this->db->from($this->subpro." as ML");
        $this->db->where('ML.parent_id',$pid);
        //$this->db->group_by('M.proid');
        
        $query= $this->db->get()->result();
        //echo $this->db->last_query();die;
        return $query;
    }
    // public function getDeliyverProductsForSelect($type=0)
    // {
    //     $this->db->select('M.id,ML.name');
    //     //$this->db->from($this->pro." as P");
    //     $this->db->join($this->mrs." as M");
    //     $this->db->join($this->mrslist." as ML","ML.id=M.name");
    //     $this->db->where('M.proid',$type);
    //     //$this->db->group_by('M.proid');
    //     $query= $this->db->get()->row();
    //     //echo $this->db->last_query();die;
    //     return $query;
    // }

    public function getAllMrs($id)
    {
        //echo '<pre>';
                //print_r($id);die;
        $this->db->select('proid,GROUP_CONCAT(name) as name');
        
        $this->db->from($this->mrsrecord);
        $this->db->where("proid",$id);
        $this->db->group_by('proid');
       $query= $this->db->get()->row();
       //echo "<pre>";print_r($this->db->last_query());die;
       return $query;
    }
    public function addmrspro($data=array(),$where=array())
    {
        //echo "!!!<pre>";print_r($data);
                    //print_r($where);die;
        $this->db->delete($this->mrsrecord,$where);
        if(count($data)>0 and count($where)>0){
         	$this->db->insert_batch($this->mrsrecord,$data);
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
