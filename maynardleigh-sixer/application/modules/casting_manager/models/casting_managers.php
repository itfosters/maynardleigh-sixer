<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class casting_managers extends ITF_Model {

    protected $name = "users";
    protected $mrs = "mrs_record";
    protected $pro = "product";
    protected $mrslist = "mrs_list";
   
    public function __construct() {

        parent::__construct();
    }

    /**

     * Hashes the password to be stored in the database.

     *

     * @return void

     * @author Mathew

     * */

    public function updateCastingManager($data = array(), $where = array()) {

    //echo "!!!!!<pre>";print_r($where);die;
        //unset($data["id"]);

        return $this->db->save($this->name, $data, $where);
    }

   

    public function getCastingManagerForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('user_type','CM');
        $this->db->order_by('name');
        
        return $this->db->get()->result();
    }
    public function getDeliyverProductsForSelect($type=0)
    {
        $this->db->select('P.id,GROUP_CONCAT(ML.name) as name');
        $this->db->from($this->pro." as P");
        $this->db->join($this->mrs." as M","P.id=M.proid");
        $this->db->join($this->mrslist." as ML","ML.id=M.name");
        $this->db->where('P.product_type',$type);
        $this->db->group_by('M.proid');
        
        $query= $this->db->get()->row();
        //echo $this->db->last_query();die;
        return $query;
    }
    public function getCastingManagerEmail()
    {
        $this->db->select('id,email');
        $this->db->from($this->name);
        $this->db->where('user_type','CM');
        
        return $this->db->get()->result();
    }
    public function email_check($email)
    {

        $query = $this->db->select('email,username')->from($this->name)->where(array(
            'email' => $email,
            'username'=>$email
        ))->get();

        $result= $query->num_rows();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $result;
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
    public function getSearchData($data=0)
    {
        //echo "@@@<pre>";print_r($data);die;
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->or_where(array('name'=>$data,'email'=>$data));
        $this->db->where('user_type','CM');
        $query=$this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
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

    public function deleteData($id='')
    {
        $this->db->where('id',$id);
        $this->db->delete($this->name);
    }
    public function showAll($conditions = array(),$limit=0,$start=0)
    {
        //echo "###%%<pre>";print_r($conditions["where"]);
        //echo "###%%<pre>";print_r($conditions["like"]);die;
        $this->db->from($this->name);
         
        if ( isset($conditions["where"]) and count($conditions["where"]) > 0)

            $this->db->where($conditions["where"]);



        if ( isset($conditions["like"]) and count($conditions["like"]) > 0)

            $this->db->or_like($conditions["like"]);



         if ($limit > 0)

            $this->db->limit($limit, $start);


        //$this->db->where('user_type','CM');
         $this->db->order_by("name", "asc");
       
        $query = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;

       return $query;











        // $this->db->select('*');

        // $this->db->from($this->name);
        // $this->db->where('user_type','CM');
        // $this->db->limit($limit,$start);
        // $query= $this->db->get()->result();
        // return $query;
    }
     public function showAllCount($conditions=array())
    {
        //$this->db->select('*');
         //$this->db->where('user_type','CM');
        //$this->db->from($this->name);
        $this->db->from($this->name);

        

        if ( isset($conditions["where"]) and count($conditions["where"]) > 0)

            $this->db->where($conditions["where"]);



        if ( isset($conditions["like"]) and count($conditions["like"]) > 0)

        $this->db->or_like($conditions["like"]);
        //$this->db->where('user_type','CM');
        
        return $this->db->get()->num_rows;
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
