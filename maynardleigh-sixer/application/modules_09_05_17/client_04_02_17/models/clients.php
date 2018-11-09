<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clients extends ITF_Model {

    protected $name = "users";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */
    public function register($data = array()) {

        if (!isset($data["password"]) or empty($data["password"])) {

            unset($data["password"]);
        } else {

            $data["password"] = md5($data["password"]);
        }

        if (!isset($data["username"]) or empty($data["username"]))
            $data["username"] = "CAP" . time();



        $this->db->save($this->name, $data);

        return $this->db->insert_id();
    }

    public function updateClient($data = array(), $where = array()) {



        
        unset($data["id"]);



        return $this->db->save($this->name, $data, $where);
    }

    public function getUsersById($userid = "0") {


        $this->db->where("id", $userid);
        $this->db->from($this->name);

        

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
    public function addClient($dataArray= array())
    {
        //echo "<pre>";print_r($dataArray);die;
        $this->db->insert($this->name,$dataArray);
       // $this->db->last_query();die;
        return true;
    }
    public function update_data($data=array(),$id='')
    {
        $this->db->where('id',$id);
        $this->db->update($this->name,$data);
    }
    public function getId($id='')
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

    public function showAll($limit=12,$start=0)
    {
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->where('user_type','C');
        $this->db->limit($limit,$start);
        return $this->db->get()->result();
    }
     public function showAllCount()
    {
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->where('user_type','C');
        return $this->db->get()->num_rows();
    }
    public function getClientsForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('user_type','C');
        return $this->db->get()->result();
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

    public function statusupdate($ids = array(), $status = '1') {

        $this->db->where_in("id", $ids);

        $data["status"] = $status;

        $this->db->update($this->name, $data);
    }

    public function getSalaryUsers() {

        $this->db->select("U.id,concat(U.name,'(',U.email,') (', J.salary,')') as user_info,J.emp_status", false);

        $this->db->from($this->name . " U");

        $this->db->join($this->job . " J", "U.id=J.user_id", "Join");

        $this->db->where("U.status", "1");

        $query = $this->db->get()->result();

        return $query;
    }

}
