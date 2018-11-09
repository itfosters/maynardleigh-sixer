<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Users extends ITF_Model {



    protected $name = "users";
    protected $prefferdairlince = "trf_preferredairlince";

	protected $personal = "user_personal";

    protected $contact = "contact_detail";

	protected $job = "jobs";
    protected $myinfodetail = "myinfodetail";

    protected $assigndetail="assign_date";    
    protected $order="order";    
    protected $diagnose="order_diagnose";    
    protected $membership="membershipdetail"; 
     protected $mapuser = "usermap";   

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


public function addUsers($data=array())
    {
  
//echo "###<pre>";print_r($data);die;
        
       $this->db->insert_batch($this->name,$data);
       //echo $this->db->last_query();die;

       return $this->db->insert_id();
       
    }
    public function addUsersmap($data=array())
    {
  
//echo "###<pre>";print_r($data);die;
        
      return  $this->db->insert($this->mapuser,$data);
       
       
    }
    public function getcallingUserForSelect()
    {
        $this->db->select('id,name');
        $this->db->from($this->name);
        $this->db->where('user_type','N');
        
        return $this->db->get()->result();
    }
    public function isUserExist($emailid=array())
    {//echo "###<pre>";print_r($emailid);
       $query= $this->db->select('id')
                ->from($this->name)
                ->where(array('email'=>$emailid,'user_type'=>'N'))
                ->get()
                ->result();
                //echo $this->db->last_query();die;
                return $query;
    }
    public function showAllUsersForCalling($id=array())
    { 
        //$query='';
      foreach ($id as $key => $value) {
        //echo "<pre>";print_r($value);
        $query=$this->db->from($this->name)
                ->where(array('id'=>$value,'user_type'=>'N'))
                ->group_by('email')
                ->get()
                ->result();
                
                
    }//die;//echo $this->db->last_query();die;
    return $query;
        
    }
    public function updateUser($data = array(), $where = array()) {

        if (!isset($data["password"]) or empty($data["password"])) {
            unset($data["password"]);
        } else {
            $data["password"] = md5($data["password"]);
        }

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

		$this->db->from($this->name." U");

		$this->db->join($this->personal." P","U.id=P.user_id","LEFT");

        $this->db->join($this->contact." C","U.id=C.user_id","LEFT");

		$this->db->join($this->job." J","U.id=J.user_id","LEFT");

		 $this->db->where("U.id", $userid);

        $query = $this->db->get()->row();

	    return $query;

    }

  



    public function findUser($conditions = array() , $perpage = 0, $pg = 0) 

    {       

        $this->db->from($this->name);



         if ( isset($conditions["where"]) and count($conditions["where"]) > 0)

            $this->db->where($conditions["where"]);



        if ( isset($conditions["like"]) and count($conditions["like"]) > 0)

            $this->db->or_like($conditions["like"]);



         if ($perpage > 0)

            $this->db->limit($perpage, $pg);



        $this->db->order_by("id", "desc");

        

        $query = $this->db->get()->result();
        //echo $this->db->last_query();

       return $query;

    }





    public function find($conditions = array() , $perpage = 0, $pg = 0) 

    {       

        $this->db->from($this->name);



         if ( isset($conditions["where"]) and count($conditions["where"]) > 0)

            $this->db->where($conditions["where"]);



        if ( isset($conditions["like"]) and count($conditions["like"]) > 0)

            $this->db->or_like($conditions["like"]);



         if ($perpage > 0)

            $this->db->limit($perpage, $pg);



        $this->db->order_by("name", "asc");

        

        $query = $this->db->get()->result();

        return $query;

    }



    public function totalData($conditions = array()) {

        



        $this->db->from($this->name);

        

        if ( isset($conditions["where"]) and count($conditions["where"]) > 0)

            $this->db->where($conditions["where"]);



        if ( isset($conditions["like"]) and count($conditions["like"]) > 0)

            $this->db->or_like($conditions["like"]);



        return $this->db->get()->num_rows;

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



    

    public function statusupdate($ids = array(), $status = '1') {

        $this->db->where_in("id", $ids);

        $data["status"] = $status;

        $this->db->update($this->name, $data);

    }



    public function getSalaryUsers()

    {

        $this->db->select("U.id,concat(U.name,'(',U.email,') (', J.salary,')') as user_info,J.emp_status",false);

        $this->db->from($this->name." U");

        $this->db->join($this->job." J","U.id=J.user_id","Join");

        $this->db->where("U.status","1");

        $query = $this->db->get()->result();

        return $query;

    }

    
    public function saveMyInfo($data = array(), $where = array(),$flage) {
       // echo "<pre>";print_r($data);die;
        if($flage=0)
        unset($data["id"]);
 
        return $this->db->save($this->myinfodetail, $data, $where);

    }
    //save membership datail
    public function saveMembershipInfo($data = array(),$where = array()){
        //echo "<pre>";print_r($data);die;
        if(is_array($data))
        {
        return $this->db->save($this->membership, $data);
        }
            
    }
    function getMemberDetails($userid)
    {
            // $this->db->select('MF.*,PA.name as airname,M.name,M.detail',false);
            // $this->db->from($this->myinfodetail.' as MF');
            // $this->db->join($this->membership.' as M','MF.userid=M.user_id');
            // $this->db->from($this->prefferdairlince." PA",' as PA.id=MF.preferred_airlience');
             $this->db->select('*');
             $this->db->from($this->membership);
             $this->db->where('user_id',$userid);
             $query = $this->db->get()->result();


        return $query;
    }
    

    //Condition for delete membershipdetails..
    public function memberDelete($ids)
    {
       $where['id']=$ids;
       $this->db->delete($this->membership,$where); 
    }

    public function getMyInfo($userid='')
    {
        $this->db->select("MF.*,PA.name as Airlincename",false);
        $this->db->from($this->myinfodetail." MF");
        $this->db->from($this->prefferdairlince." PA",' as PA.id=MF.preferred_airlience');
        $this->db->where("MF.userid",$userid);
        $query = $this->db->get()->row();
        return $query;
    }
       function calender()
    {
       $this->db->select("*");
        $this->db->from($this->name);
       $this->db->where("user_type",'CM');
        $query = $this->db->get()->result();
        return $query;
    }
    function assignDetail($id)
    {
            $this->db->select('AT.*,U.name');
            $this->db->from($this->assigndetail.' as AT');
            //$this->db->join($this->order.' as O','AT.order_id=O.id');
            $this->db->join($this->name.' as U','AT.manager_id=U.id');
            //$this->db->join($this->diagnose.' as D','U.id=D.id');
            $this->db->where('user_type','CM');

            $query = $this->db->get()->result();

       //  $this->db->select("*");  
       //  $this->db->from($this->assigndetail);
       // $this->db->where("manager_id",$id['id']);
       //  $query = $this->db->get()->result();
    //echo "@@@@@@@@@!!!!!!!!!";print_r($this->db->last_query());die;

        return $query;
    }

}