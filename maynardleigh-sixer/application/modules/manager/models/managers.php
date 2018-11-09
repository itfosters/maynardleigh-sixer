<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Managers extends ITF_Model {

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

    public function updateSales($data = array(), $where = array()) {

    
        //unset($data["id"]);

        return $this->db->save($this->name, $data, $where);
    }

   

    public function getManagerForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('user_type','PM');
        $this->db->order_by('name');
        
        return $this->db->get()->result();
    }
	

   
    public function addSales($dataArray= array())
    {
        //echo "<pre>";print_r($dataArray);die;
        $this->db->insert($this->name,$dataArray);
       // $this->db->last_query();die;
        //return true;
    }
    public function update_data($data=array(),$id='')
    {
        //$this->db->where('id',);
        $this->db->update($this->name,$data,$id);
    }
    public function findById($id='')
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

    public function deleteData($id='')
    {
        $this->db->where('id',$id);
        $this->db->delete($this->name);
    }
    public function showAll($limit=12,$start=0)
    {
        $this->db->select('*');
        $this->db->where('user_type','PM');
        $this->db->from($this->name);
        $this->db->limit($limit,$start);
        return $this->db->get()->result();
    }
    public function showAllCount()
    {
        $this->db->select('*');
        $this->db->where('user_type','PM');
        $this->db->from($this->name);
        return $this->db->get()->num_rows();
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
