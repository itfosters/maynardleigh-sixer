<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contracts extends ITF_Model {

   //protected $name = "order";
    //private $client="clients";
    private $product="product";
   protected $subproducts = "subproducts";
    //private $seller="sellers";
    //private $projectmanager="projectmanager";
    //private $economicbuyer="order_economic";
    //private $addressbilling="order_addressbilling";
    private $diagnose="order_diagnose";
    private $design="order_design";
    private $delivery="order_delivery";
    private $discovery="order_discovery";
    //private $termcondition="order_termconditions";
    //private  $documentupload="order_documentupload";
    private  $transport="order_transport";
	 //private  $users="users";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */
    

    public function updateClient($data = array(), $where = array()) {



        
        unset($data["id"]);



        return $this->db->save($this->name, $data, $where);
    }

    public function getUsersById($userid = "0") {



        $this->db->from($this->name);

        $this->db->where("id", $userid);

        $query = $this->db->get()->row();

        return $query;
    }

    public function getUsersInfoById($userid = "0") {



        $this->db->select("U.*,P.id as personal_id,P.licence_number,P.licence_expire, P.gender,P.marital_status,P.nationality,P.dob,C.id as conact_id, 

            C.address1, C.address2,C.city,C.state,C.zipcode,C.country,C.home_phone,C.mobile,C.work_email,C.other_email,J.id as job_id,J.job_type_id,

            J.job_category_id,J.join_date,J.location_id,J.contract_start_date,J.contract_end_date,J.contract_detail,J.salary,J.emp_status");

        $this->db->from($this->name . " U");

        $this->db->join($this->personal . " P", "U.id=P.user_id", "LEFT");

        $this->db->join($this->contact . " C", "U.id=C.user_id", "LEFT");

        $this->db->join($this->job . " J", "U.id=J.user_id", "LEFT");

        $this->db->where("U.id", $userid);

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
    public function client_Data()
    {
        $this->db->select('*');
        $this->db->from($this->client);
        return $this->db->get()->result();
        //$this->db->last_query();
       // return result();
    }
    public function product_Data()
    {
        $this->db->select('*');
        $this->db->from($this->product);
        return $this->db->get()->result();
        //$this->db->last_query();
       // return result();
    }
    public function seller_Data()
    {
        $this->db->select('*');
        $this->db->from($this->seller);
        return $this->db->get()->result();
        //$this->db->last_query();
       // return result();
    }
     public function projectmanager_Data()
    {
        $this->db->select('*');
        $this->db->from($this->projectmanager);
        return $this->db->get()->result();
        //$this->db->last_query();
       // return result();
    }
    public function economicbuyer($data=array())
    {
        $this->db->insert($this->economicbuyer,$data);
       //  $this->db->select('*');
       //  $this->db->from($this->economicbuyer);
       //  return $this->db->get()->result();
       //  //$this->db->last_query();
       // // return result();
    }
    public function addressbilling($data=array())
    {
        $this->db->insert($this->addressbilling,$data);
       //  $this->db->select('*');
       //  $this->db->from($this->economicbuyer);
       //  return $this->db->get()->result();
       //  //$this->db->last_query();
       // // return result();
    }
    public function update_data($data=array(),$id='')
    {
        $this->db->where('id',$id);
        $this->db->update($this->name,$data);
    }
    public function up_data($id='')

    {
    $this->db->select('*');
    $this->db->where('id',$id);
    $this->db->from($this->name);
    return $this->db->get()->row();
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
    public function deletedata($id ='') {
        $this->db->where('id', $id);
        $this->db->delete($this->name); 
       return true;
       } 
    public function showAllRows()
    {
     
	   
           
   }
   
    public function get_diagnose($id='')
    {
     $this->db->select('P.product_type,P.name,SP.name as subpro');
	 $this->db->from($this->diagnose.' AS D');
     $this->db->join($this->product.' AS P', 'D.products=P.id');
	 $this->db->join($this->subproducts.' AS SP', 'D.subproducts=SP.id');
     $this->db->where('D.order_id',$id);
	 $query=$this->db->get()->result();
     //echo "<pre>";print_r($this->db->last_query());die;
     return $query;
           
   }
   
    public function get_design($id='')
    {
     $this->db->select('P.product_type,P.name,SP.name as subpro');
	 $this->db->from($this->design.' AS D');
	 $this->db->join($this->product.' AS P', 'D.products=P.id');
     $this->db->join($this->subproducts.' AS SP', 'D.subproducts=SP.id');

     $this->db->where('D.order_id',$id);
	  $query=$this->db->get()->result();
     //echo "<pre>";print_r($this->db->last_query());die;
     return $query;
           
   }
   
   public function get_delivey($id='')
    {
     $this->db->select('P.product_type,P.name,SP.name as subpro');
	 $this->db->from($this->delivery.' AS D');
	 $this->db->join($this->product.' AS P', 'D.products=P.id');
     $this->db->join($this->subproducts.' AS SP', 'D.subproducts=SP.id');

	  $this->db->where('D.order_id',$id);
      $query=$this->db->get()->result();
     //echo "<pre>";print_r($this->db->last_query());die;
     return $query;
           
   }
   public function get_discovery($id='')
    {
     $this->db->select('P.product_type,P.name,SP.name as subpro');
	 $this->db->from($this->discovery.' AS D');
	 $this->db->join($this->product.' AS P', 'D.products=P.id');
     $this->db->join($this->subproducts.' AS SP', 'D.subproducts=SP.id');

	  $this->db->where('D.order_id',$id);
      $query=$this->db->get()->result();
     //echo "<pre>";print_r($this->db->last_query());die;
     return $query;
           
   }
   
   public function get_transport($id='')
    {
     //$this->db->select();
	// $this->db->from($this->order_transportationname.' AS TN');
	 //$this->db->join($this->order_transport.' AS T', 'T.transport_id=TN.id');
	 // return $this->db->get()->result();
           
   }
  
   
}
