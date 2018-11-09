<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Close_orders extends ITF_Model {

    protected $name = "order";
    protected $pro = "product";
    protected $subproducts = "subproducts";
    private $client="clients";
    private $product="product";
    private $seller="sellers";
    private $projectmanager="projectmanager";
    private $economicbuyer="order_economic";
    private $addressbilling="order_addressbilling";
    private $diagnose="order_diagnose";
    private $design="order_design";
    private $delivery="order_delivery";
    private $discovery="order_discovery";
    private $termcondition="order_termconditions";
    private  $documentupload="order_documentupload";
    private  $transport="order_transport";
    private  $transportname="order_transportationname";
    private  $users="users";
    private  $assigntime="assign_date";
    private  $viewdiagnosestatus="diagnose_status";
    private  $viewdesignstatus="design_status";
    private  $viewdeliverystatus="delivery_status";
    private  $viewdiscoverystatus="discovery_status";
    private  $vieworderstatus="order_status";
    private  $pin="pincodes";
    private  $noofcast="noof_casting";
    private  $resource="resouces";
    private  $leadership_report="leadership_report";
    private  $order_invoice="itf_order_invoice";
    private  $time_slot_master="itf_time_slot_master";
    private  $complete_master="complete_order";
   
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
        //$this->db->from($this->name);
        $this->db->select('O.id,
                                O.order_Id,O.email_co_ordinator,O.co_ordinator_location,
                                    U.name as clientname,
                                    U1.name as salesname,
                                    U2.name as managername,
                                    E.location,E.contact_No,E.email_Id,
                                    O.status as orderstatus,
                                    ',false);

            $this->db->from($this->name.'  AS O');
            $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
            $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
            $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
            $this->db->join($this->viewdiagnosestatus.' as OS', 'O.id =  OS.order_id',"LEFT");
            $this->db->join($this->viewdesignstatus.' as OSD', 'O.id =  OSD.order_id',"LEFT");
            $this->db->join($this->viewdeliverystatus.' as OSDI', 'O.id =  OSDI.order_id',"LEFT");
            $this->db->join($this->viewdiscoverystatus.' as OSDIS', 'O.id =  OSDIS.order_id',"LEFT");
            
            //$this->db->join($this->complete_master.' as OCM', 'O.id =  OCM.order_id AND  ( ((OCM.diagnose - OCM.com_diagnose) =0) AND ((OCM.design - OCM.com_design) =0) AND ((OCM.delivery - OCM.com_delivery) =0) AND ((OCM.discovery - OCM.com_discovery) =0) ) ',"INNER");
            $this->db->join($this->complete_master.' as OCM', 'O.id =  OCM.order_id AND  ( (OCM.com_diagnose >0) OR (OCM.com_design >0) OR (OCM.com_delivery >0) OR (OCM.com_discovery) >0 ) ',"INNER");
            
            
           
            
            $this->db->group_by('O.id');  
            $this->db->order_by('O.id','DESC');



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



        //$this->db->order_by("name", "asc");



        $query = $this->db->get()->result();
        //die($this->db->last_query());

        return $query;
    }

   
	 public function resourceDetails($id) {

        //$this->db->from($this->name);
        //$tableArray = array($this->diagnose,$this->design,$this->delivery,$this->discovery);
        $this->db->select('O.id,
                                O.order_Id,
                                    U.name as clientname,
                                    AD.order_type
                                    ',false);

            $this->db->from($this->name.'  AS O');
            $this->db->join($this->assigntime.'  AS AD','O.id=AD.order_id');
            $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT"); 
            $this->db->group_by('O.id');  
            $this->db->order_by('O.id','DESC');
			$this->db->where('O.id',$id);



        $query = $this->db->get()->row();

        return $query;
    }
    public function moreResourceDetails($id,$o_type)
    {
       //echo "$$$<pre>";print_r($o_type);die;
       
        $tableArray = array(1=>$this->diagnose,
                            2=>$this->design,
                            3=>$this->delivery,
                            4=>$this->discovery
                            );

//echo "$$$<pre>";print_r($tableArray[$o_type]);die;
        $this->db->select('P.name,D.start_date,D.end_date',false);
        $this->db->from($tableArray[$o_type]." as D");
        $this->db->join($this->product.' as P','D.products=P.id','left');
        
        //$this->db->where('D.order_id',$id);
        $this->db->where('D.id',$id);
        //$this->db->group_by('D.id');
        $query=$this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
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

        


        //$this->db->from($this->name);
        $this->db->select('         
                        O.order_Id'
                        );

            $this->db->from($this->name.'  AS O');
            $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
            $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
            $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
            $this->db->join($this->viewdiagnosestatus.' as OS', 'O.id =  OS.order_id',"LEFT");
            $this->db->join($this->viewdesignstatus.' as OSD', 'O.id =  OSD.order_id',"LEFT");
            $this->db->join($this->viewdeliverystatus.' as OSDI', 'O.id =  OSDI.order_id',"LEFT");
            $this->db->join($this->viewdiscoverystatus.' as OSDIS', 'O.id =  OSDIS.order_id',"LEFT");
            
            $this->db->join($this->complete_master.' as OCM', 'O.id =  OCM.order_id AND  ( (OCM.com_diagnose >0) OR (OCM.com_design >0) OR (OCM.com_delivery >0) OR (OCM.com_discovery) >0 ) ',"INNER");
            
            

            //$this->db->where("O.id IN ($subQuery)", NULL, FALSE);

        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        return $this->db->get()->num_rows;
    }
    public function getClientAddress($ids)
    {
        $this->db->select('street,location,state,city,pincode');
        $this->db->from($this->users);
        $this->db->where('id',$ids);
        return $this->db->get()->row();
    }
    public function getClientIdByOrderId($ids)
    {
        $this->db->select('O.client_id');
        $this->db->from($this->name.'  AS O');
        $this->db->where(array('id'=>$ids));
        $query = $this->db->get()->row();
        //echo "$$$<pre>";print_r($this->db->last_query());die;
        return $query;
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
    public function showAllRows($userid)
    {
        //die("asdf");
        $this->db->select('');

             $this->db->from($this->assigntime.'  AS AD');
             $this->db->join($this->name.'  AS O','O.id=AD.order_id');
             $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
             $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
             $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
             $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
             $this->db->where(array('AD.manager_id'=>$userid,'AD.status'=>1)); 
             $this->db->group_by('O.id');
             $query = $this->db->get()->num_rows();
            //echo "<hr>ranu".$this->db->last_query();die;
            return $query;
            //die('dsdwf');
            
           
                }
    public function countAllRows($userid,$date)
    {
        //die("asdf");
        $this->db->select('',false);

             $this->db->from($this->assigntime.'  AS AD');
             $this->db->join($this->name.'  AS O','O.id=AD.order_id');
             $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
             $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
             $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
             $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
             $this->db->where(array('AD.manager_id'=>$userid,'AD.status'=>1)); 
             $this->db->where('AD.tenddatetime <',$date);
             $query = $this->db->get()->num_rows();
            //echo "<hr>ranu".$this->db->last_query();die;
            return $query;
            //die('dsdwf');
            
           
                }
     public function showAllOrder($id='')
    {
        $this->db->select('O.id,
								O.order_Id,
									U.name as clientname,
                                    U1.name as salesname,
                                    U2.name as managername,
                                    E.location,E.contact_No,E.email_Id,
                                    AD.status
                                    ',false);

            $this->db->from($this->assigntime.'  AS AD');
            $this->db->join($this->name.'  AS O','AD.order_id=O.id');
            $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
            $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
            $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
            $this->db->where(array('AD.manager_id'=>$id,'AD.status'=>1)); 
            //$this->db->limit($limit,$start); 
            //$this->db->order_by('O.id','DESC');
            $this->db->group_by('O.id');
            //$this->db->group_by('O.id');

            $query = $this->db->get()->result();
            return $query;
            //die('dsdwf');
            
           
    }
     public function showAcceptOrder($id='',$date)
    {
        //die("asdf");
        $this->db->select('O.id,
                                O.order_Id,
                                    U.name as clientname,
                                    U1.name as salesname,
                                    U2.name as managername,
                                    E.location,E.contact_No,E.email_Id,
                                    AD.status
                                    ',false);

            $this->db->from($this->assigntime.'  AS AD');
            $this->db->join($this->name.'  AS O','AD.order_id=O.id');
            $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
            $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
            $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
            $this->db->where(array('AD.manager_id'=>$id,'AD.status'=>1)); 
            $this->db->where('AD.tenddatetime <',$date);
            //$this->db->limit($limit,$start); 
            //$this->db->order_by('O.id','DESC');
            //$this->db->group_by('O.id');
            $query = $this->db->get()->result();
            //echo "<hr>ranu".$this->db->last_query();die;
            return $query;
            //die('dsdwf');
            
           
    }
    public function getOrderDetail($where=array(),$o_type=3)
    {
         $tableArray = array(1 => $this->diagnose,
            2 => $this->design,
            3 => $this->delivery,
            4 => $this->discovery
        );
        //echo "$$$<pre>";print_r($where);die;
           $this->db->select('O.id,O.order_Id,O.entry_Time,
                                O.status,O.co_ordinator,O.email_co_ordinator,O.contact_no_co_ordinator,
		   						U.name as client_name,
								U1.name as seller_name,
								U2.name as manager_name,
								E.first_name,E.last_name,E.location,E.contact_No,E.email_Id,
								A.street,A.pincode,A.state,A.city,A.location as alocation,
								TC.price_validity,TC.cancellation_clouse,TC.special_item
                                ,TC.contract_no,TC.notes,TC.handled_by,TC.nda_required,TC.payment_cycle
                                ,TC.mode_ofpayment,TC.termsconditions,TC.tax,TC.transport_tax,
                                group_concat(T.value) as tvalue,group_concat(T.transport_id) as tid,P.name as proname,SP.name as subproductname'
							);

			$this->db->from($this->name.'  AS O');
			$this->db->join($this->users.' as U', 'U.id =  O.client_id','left');
			$this->db->join($this->users.' as U1', 'U1.id =  O.sales_by_id','left');
			$this->db->join($this->users.' as U2', 'U2.id =  O.pm_id','left');
			$this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id','left');
			$this->db->join($this->addressbilling.' as A', 'O.id =  A.order_Id','left');
                        $this->db->join($this->termcondition.' as TC', 'O.id =  TC.order_Id','left');
                        $this->db->join($this->transport.' as T', 'O.id =  T.order_Id','left');
                        $this->db->join($tableArray[$o_type].' as D', 'O.id =  D.order_id','left');
                        
                       
                        $this->db->join($this->pro . ' as P', 'D.products=P.id', 'left');
                        $this->db->join($this->subproducts . ' as SP', 'D.subproducts=SP.id', 'left');
                        
			$this->db->where($where);
			$query = $this->db->get()->row();
            //echo "$$$<pre>";print_r($this->db->last_query());die;
            return $query;
    }
    public function getEcoEmail($where=array())
    {
           $this->db->select('O.id,E.email_Id,
                            E.first_name,E.last_name,
                            U.email as pmemail,U1.email as salesemail'
                            );

            $this->db->from($this->name.'  AS O');
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id','LEFT');
            $this->db->join($this->users.' as U', 'U.id =  O.pm_id','LEFT');
            $this->db->join($this->users.' as U1', 'U1.id =  O.sales_by_id','LEFT');
            $this->db->where($where);
            $query = $this->db->get()->row();
            //echo $this->db->last_query(); die;
            return $query;
    }
    public function getAllEmail($where=array())
    {
        //echo "$$$$$<pre>";print_r($where['O.id']);die;
       
           $this->db->select('O.id,
                            U2.email as resourceemail'
                            );

            $this->db->from($this->name.'  AS O');
            $this->db->join($this->assigntime.' as AT', 'AT.order_id =  O.id');
            $this->db->join($this->noofcast.' as NC', 'NC.diagnose_id =  AT.diagnose_id');
            $this->db->join($this->users.' as U2','NC.casting_manager=U2.id');

            
           
            $this->db->where($where);
            $this->db->group_by('U2.email');
            $query = $this->db->get()->result();
           // echo $this->db->last_query(); die;
            return $query;
    }
    public function getSuborderById($id)
    {
        $this->db->select('O.id,O.order_Id,O.client_id,O.sales_by_id,O.pm_id,
                           O.co_ordinator,O.email_co_ordinator,O.contact_no_co_ordinator,O.team,
                           E.first_name,E.last_name,E.location,
                           E.designation,E.contact_No,E.email_Id,
                           A.street,A.location as alocation,A.pincode,A.city,A.state,
                           TC.price_validity,TC.cancellation_clouse,TC.special_item,TC.contract_no,TC.notes,
                           TC.handled_by,TC.nda_required,TC.payment_cycle,TC.mode_ofpayment,TC.termsconditions,
                           TC.transport_tax,TC.tax');
        $this->db->from($this->name.' as O');
        $this->db->join($this->users.' as U','O.client_id=U.id','left');
        $this->db->join($this->users.' as U1','O.sales_by_id=U1.id','left');
        $this->db->join($this->users.' as U2','O.pm_id =  U2.Id','left');
        $this->db->join($this->economicbuyer.' as E','O.id =  E.order_Id','left');
        $this->db->join($this->addressbilling.' as A','O.id =  A.order_Id','left');
        $this->db->join($this->termcondition.' as TC','O.id =  TC.order_Id','left');
        $this->db->where('O.id',$id);
        $query = $this->db->get()->row();
            return $query;
    }
    public function getDocById($id)
    {
        $this->db->select('D.document_id,
                           D.file_name');
        $this->db->from($this->documentupload.' as D');
        $this->db->where('D.order_Id',$id);
        $query = $this->db->get()->result();
        //echo "<hr>ranu".$this->db->last_query();die;
            return $query;
    }
    public function getPinData($data)
    {
        $this->db->select('*');
        $this->db->like('pincode',$data);
        $this->db->from($this->pin);
        $query=$this->db->get()->result();
        //echo "@@<pre>";print_r($this->db->last_query());die;
        return $query;
    }
    public function getTransById($id)
    {
        $this->db->select('T.transport_id,T.value');
        $this->db->from($this->transport.' as T');
        $this->db->where('T.order_Id',$id);
        $query=$this->db->get()->result();
        return $query;
    }
    
    //update order data
        public function updateOrder($data = array(), $where = array()) 
        {
        unset($data["id"]);
        return $this->db->save($this->name, $data, $where);
        }

        public function getId($id='')
        {
            $this->db->select('*');
            $this->db->where('id',$id);
            $this->db->from($this->name);
            return $this->db->get()->row();
    }
    //now save order data
    public function addOrder($data,$where=array()){
    //echo "####!!<pre>";print_r($data);die;
        $this->db->save($this->name,$data,$where);
        return $this->db->insert_id();
    }

    public function add_EconomicBuyer($data,$where=array())
    {
        $query=$this->db->save($this->economicbuyer,$data,$where);
       //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }
     public function add_AddressBilling($data,$where=array())
    {
        unset($where['id']);
        $this->db->save($this->addressbilling,$data,$where);
        
    }
    public function add_Diagnose($data)
    {
        $this->db->insert($this->diagnose,$data);
        
    }
    public function add_Design($data)
    {
        $this->db->insert($this->design,$data);
        
    }
    public function add_Delivery($data)
    {
        $this->db->insert($this->delivery,$data);
        
    }
    public function add_Discovery($data)
    {
        $this->db->insert($this->discovery,$data);
        
    }
    public function add_termcondition($data,$where=array())
    {//echo "##############<pre>";print_r($data);die;
        $query=$this->db->save($this->termcondition,$data,$where);
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
        
    }
     public function add_Transport($data,$where=array())
    {
        $this->db->save($this->transport,$data,$where);
     }

     public function add_UpdateTransport($data,$where=array())
    {
        $this->db->delete($this->transport,$where);

        $this->db->insert_batch($this->transport,$data);
     }

    //update order no
    public function updateOrderno($oid,$data){
        $this->db->where('Id', $oid);
        $this->db->update($this->name, $data); 
        //$this->db->update($this->name,$data,array('id',$oid));
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

    public function saveDocuments($data,$where=array()){
        //echo "!!!<pre>";print_r($data);die;
        if(isset($where['order_id'])){
        $result = $this->checkExistenceOfDoc($where['order_id'],$where['document_id']);
        if(!$result)
            $where=array();
        }

        $this->db->save($this->documentupload,$data,$where);
    }
    public function checkExistenceOfDoc($order_id,$document_id)
    {
        $result=$this->db->select('id')
                ->from($this->documentupload)
                ->where('order_id',$order_id)
                ->where('document_id',$document_id)
                ->get()->result();
        return $result;
    }


    function checkAssignData($orderid="")
    {
        $total_accept = $this->db->select("order_type,status,count(id) as totals",false)->from($this->assigntime)
                ->where(array("order_id"=>$orderid,'del_status'=>0))
                ->group_by("order_type,status")
                ->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
                //echo "#####<pre>";print_r($total_accept);die;

        $statusinfo=array("A"=>"0","R"=>"0","N"=>"0");
        $allorderty = array();
        foreach($total_accept as $ad){
            
            if(isset($allorderty[$ad->order_type])){}else{$allorderty[$ad->order_type] = $statusinfo;}

            if(isset($ad->order_type))
            {
                if($ad->status=="1")
                    $allorderty[$ad->order_type]["A"]=$ad->totals;
                else if($ad->status=="2")
                    $allorderty[$ad->order_type]["R"]=$ad->totals;
                else
                    $allorderty[$ad->order_type]["N"]=$ad->totals;
            }
        }
        $res['alltype']=$allorderty;
        //echo "<pre>";print_r($res);die;

        return $allorderty;
    }

    public function autoCompletedPayment($data)
    {
        $this->db->select('payment_cycle');
        $this->db->like('payment_cycle',$data);
        $this->db->from($this->termcondition); 
        $this->db->group_by('payment_cycle');
        $query=$this->db->get()->result();
        //echo "@@<pre>";print_r($this->db->last_query());die;
        return $query;
    }

	 public function resouces_forme($data)
    {
        $this->db->insert($this->resource,$data);
       
        //echo "@@<pre>";print_r($this->db->last_query());die;
		   //$this->db->insert($this->addressbilling,$data);
        //return $query;
    }
    function TimeSlot($where)
    {
        //echo "<pre>";print_r($where);die;
       $this->db->select('*');
     
        $this->db->from($this->time_slot_master); 
       $this->db->where('order_id',$where['o_id']);
       $this->db->where('delivery_id',$where['d_id']);
        $query=$this->db->get()->result(); 
        return $query;
    }
     function userCall($where)
    {
        //echo "<pre>";print_r($where);die;
       $this->db->select('*');
     
        $this->db->from($this->users); 
       $this->db->where('id',$where['u_id']);
     
        $query=$this->db->get()->result(); 
        return $query;
    }
    //
    
    
    //function for get all dates
    
    function checkAllDates($Oderid=0)
    {

        $sqlforalldates = "select IOD.start_date as dstartdate,IOD.end_date as denddate
from 
itf_order O
left join itf_order_delivery IOD on O.id=IOD.order_id
where O.id=".$Oderid."
union

select IODS.start_date as dstartdate,IODS.end_date as denddate
from 
itf_order O
left join itf_order_diagnose IODS on O.id=IODS.order_id
where O.id=".$Oderid."

union

select IODD.start_date as dstartdate,IODD.end_date as denddate
from 
itf_order O
left join itf_order_design IODD on O.id=IODD.order_id
where O.id=".$Oderid."

union
select IODV.start_date as dstartdate,IODV.end_date as denddate
from 
itf_order O
left join itf_order_design IODV on O.id=IODV.order_id
where O.id=".$Oderid;
        
        //$this->db->where('O.id',$Oderid);
        //$this->db->group_by('D.id');
        $queryresult  = $this->db->query($sqlforalldates)->result_array();
        //echo "<pre>";print_r($queryresult);die;
        //$query=$this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return (array)$queryresult;
    }
    //
    function getSellerUserEmail($Oderid=0)
    {

        $this->db->select('U.email seller, U1.email pm',false);
        $this->db->from($this->name." as O");
        $this->db->join($this->users.' as U','U.id = O.sales_by_id','left');
        $this->db->join($this->users.' as U1','U1.id = O.pm_id','left');
        
        $this->db->where('O.id',$Oderid);
        //$this->db->group_by('D.id');
        $query=$this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return (array)$query;
    }
    
    public function saveLeadershipReport($data = array(), $where = array()) {

        unset($data["id"]);

        return $this->db->save($this->leadership_report, $data, $where);
    }
    
    //get leadership report
    public function getLeaderShipReport($assing_time_id=0,$diagnoseid = 0, $order_type = 3) {
        //echo "<pre>";print_r($where);die;
        $this->db->select('*');
        $this->db->from($this->leadership_report);
        $this->db->where('diagnose_id', $diagnoseid);
        $this->db->where('order_type', $order_type);
        $this->db->where('assign_date_id', $assing_time_id);
        $query = $this->db->get()->row();
        return $query;
    }
    
}
