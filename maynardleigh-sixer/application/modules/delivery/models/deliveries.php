<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deliveries extends ITF_Model {

    protected $name = "order_delivery";
    protected $delvsos = "delivery_status";
    protected $users = "itf_users";
    protected $noofcast = "noof_casting";
    protected $subproducts = "subproducts";
    protected $pro = "product";
    protected $deliveredpro = "noof_deliveredpro";
    protected $information = "itf_trf_information";
    protected $trf_preferdairlince = "itf_trf_preferredairlince";
    protected $timeslot = "itf_time_slot_master";
    protected $timeslot_user_map = "itf_timeslot_user_map";
    protected $order = "itf_order";
    protected $usermap = "itf_usermap";
    protected $assign_date = "assign_date";
    protected $time_slot = "time_slot_master";
    protected $usercall = 'user_call';
    protected $order_invoice = 'itf_order_invoice';
    protected $order_partial = 'partial_complete_order';
    protected $order_partial_new = 'partial_complete_order_new';
    protected $goal = 'itf_goal';
    protected $todo = 'itf_participanttodo';
    private $economicbuyer="order_economic";
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	} 
    public function getUserAcceptTime($oid,$did)
    {
        $this->db->select('*');
        $this->db->from($this->timeslot);
        $query=$this->db->get()->result();
        return $query;
    }
    public function getTimeSlotDetailById($time_slot_id=0)
    {
        $this->db->select('*');
        $this->db->from($this->timeslot);
        $this->db->where(array('id'=>$time_slot_id));
        $query=$this->db->get()->row();
        return $query;
    }
    //get catalyst call product id
    public function getAllCatalystCallProducts()
    {
        $this->db->select('id');
        $this->db->from($this->pro);
        $this->db->where(array('catalyst_call_flag'=>1));
        $query=$this->db->get()->result();
        return $query;
    }
    //get excutive call product id
    public function excutiveCallProduct()
    {
        $this->db->select('id');
        $this->db->from($this->pro);
        $this->db->where(array('executive_call_flag'=>1));
        $query=$this->db->get()->result();
        return $query;
    }

    //get catalist call product id
    public function catalystCallProduct()
    {
         $this->db->select('id');
        $this->db->from($this->pro);
        $this->db->where(array('catalyst_call_flag'=>1));
        $query=$this->db->get()->result();
        return $query;
    }
    public function totalData($conditions = array(),$id,$closed=0) {
        
        //for archive order
        $this->db->select('diagnose_id')->from($this->order_partial)->where(array('order_type'=>3,'order_id'=>$id),false);
        $subQuery =  $this->db->get_compiled_select();
        
        $this->db->select('DV.*,DVY.status,SB.name');
        $this->db->from($this->name." as DV");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DV.subproducts","LEFT");     
        $this->db->where('DV.order_id',$id);
        //adding value for invoice
        //$this->db->where("DV.id IN ($subQuery)", NULL, FALSE);
        $this->db->where("DV.id NOT IN ($subQuery)", NULL, FALSE);
        
        $this->db->join($this->delvsos." as DVY",'DVY.diagnose_id=DV.id','LEFT');
        $this->db->group_by('DV.id');
        $this->db->order_by("DV.id","desc");
        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);

        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);
        
        return $this->db->get()->num_rows;
    }
    public function getdeliveredDayInfo($did='')
    {
        $this->db->select('DL.cunsulting_days');
        $this->db->from($this->name." as DL");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->row();
        //die($this->db->last_query());
        return $query;
        
    }
    public function findUser($conditions = array(), $perpage = 0, $pg = 0,$id) {
        
        //for archive order
        $this->db->select('diagnose_id')->from($this->order_partial)->where(array('order_type'=>3,'order_id'=>$id),false);
        $subQuery =  $this->db->get_compiled_select();
        

        $this->db->select('O.order_id as orders_id,DV.*,DVY.status,SB.name,P.id as pid,P.name as pname');

        $this->db->from($this->name." as DV");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DV.subproducts","LEFT");     
        $this->db->join($this->pro. ' as P',"P.id=DV.products","LEFT");
        $this->db->join($this->order. ' as O',"O.id=DV.order_id","LEFT");
        
        $this->db->where('DV.order_id',$id);
        
        //adding value for invoice
        $this->db->where("DV.id NOT IN ($subQuery)", NULL, FALSE);
        
        $this->db->join($this->delvsos." as DVY",'DVY.diagnose_id=DV.id','LEFT');
        $this->db->group_by('DV.id');
        $this->db->order_by("DV.id","desc");


        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);

        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        if ($perpage > 0)
            $this->db->limit($perpage, $pg);



        //$this->db->order_by("name", "asc");


        
        $query = $this->db->get()->result();
        //die($this->db->last_query());
        //echo "<pre>";print_r($query);die;

        return $query;
    }
    
    //get all deliveries without any order id
    public function findDeliveries($tableName='',$orderType='') {
        //for archive order
        $ordertypeArray = array('1'=>'Diagnose','2'=>'Design','3'=>'Delivery','4'=>'Discovery');
        $this->db->select('diagnose_id')->from($this->order_partial_new)->where(array('order_type'=>$orderType),false);
        $subQuery =  $this->db->get_compiled_select();
        $this->db->select('O.order_id as orders_id,"'.$ordertypeArray[$orderType].'" as order_type,
                                    O.team,O.co_ordinator_location,
                                    U.name as clientname,
                                    U1.name as salesname,
                                    U2.name as managername,
                                    E.location,E.contact_No,E.email_Id,
                                    DV.*,DVY.status,SB.name,P.id as pid,P.name as pname',false);
        $this->db->from($tableName." as DV");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DV.subproducts","LEFT");     
        $this->db->join($this->pro. ' as P',"P.id=DV.products","LEFT");
        $this->db->join($this->order. ' as O',"O.id=DV.order_id","LEFT");
        $this->db->join($this->users.' as U','O.client_id=U.id',"LEFT");
        $this->db->join($this->users.' as U1','O.sales_by_id=U1.id',"LEFT");
        $this->db->join($this->users.' as U2', 'O.pm_id =  U2.Id',"LEFT"); 
        $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id',"LEFT");
        $todaydate = date('Y-m-d');
        $fromdate = date('2018-3-31');
        $this->db->where('DV.end_date<="'.$todaydate.'"',NULL,FALSE);
        $this->db->where('DV.end_date>="'.$fromdate.'"',NULL,FALSE);
        //adding value for invoice
        $this->db->where("DV.id NOT IN ($subQuery)", NULL, FALSE);
        $this->db->join($this->delvsos." as DVY",'DVY.diagnose_id=DV.id','LEFT');
        $this->db->group_by('DV.id');
        $this->db->order_by("DV.end_date","desc");
        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);
        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);
        if ($perpage > 0)
            $this->db->limit($perpage, $pg);
        $query = $this->db->get()->result();
        //if($orderType==3)
        //echo "<pre>dfdfsfsdf"; $this->db->last_query();die;
        return $query;
    }
    public function add_Delivery($data)
    {//echo "<pre>";print_r($data);die;
        $this->db->insert($this->name,$data);
        return $this->db->insert_id();
        
    }
    // save user map with time slot
    public function saveUserTimeSlotMap($data)
    {//echo "<pre>";print_r($data);die;
        $this->db->insert($this->timeslot_user_map,$data);
        return $this->db->insert_id();
        
    }
    //update time slot with user
    public function updateTimeSlotWithUser($timeslotid,$user_id)
    {
        $data['user_id'] = $user_id;
        $update=$this->db->update($this->timeslot_user_map,$data,array('time_slot_id'=>$timeslotid));
        return $update;
    }
    //update time start time and end time with slot id
    public function updateTimeSlotTimeBySlotId($dataArray=array(),$whereArray=array())
    {
        $update=$this->db->update($this->timeslot,$dataArray,$whereArray);
        return $update;
    }
    
    public function addTimeSlot($data)
    {
        //echo "<pre>";print_r($data);die;
        $this->db->insert($this->time_slot,$data);
        return $this->db->insert_id();
        
    }
    public function getAllTimeSlotsByResouceIdDiagnoseId($orderid=0,$deliveryId=0,$resourceId=0){
        $this->db->select('TSM.*,U.name,TSUM.user_id');
        if($resourceId!=0)
            $this->db->where('resource_id', $resourceId);
        $this->db->where('delivery_id', $deliveryId);
        $this->db->where('order_id', $orderid);
        $this->db->from($this->time_slot.' as TSM');
        $this->db->join($this->timeslot_user_map." as TSUM",'TSUM.time_slot_id=TSM.id','left');
        $this->db->join($this->users." as U",'U.id=TSUM.user_id','left');
        $this->db->order_by('TSM.timestampstart');
        
        $resutlt = $this->db->get()->result();
        //die($this->db->last_query());
        return $resutlt;
    }
    
    public function getConfirmedSessionTimeByDeliveryIDUserId($userid,$deliveryId){
        $this->db->select('TUM.time_slot_id');
        $this->db->from($this->timeslot_user_map. " as TUM");
        $this->db->join($this->timeslot." as TM",'TM.id=TUM.time_slot_id');
        $this->db->where('TUM.user_id', $userid);
        $this->db->where('TM.delivery_id', $deliveryId);
        $resutlt = (array)$this->db->get()->row();
        //die($this->db->last_query());
        return $resutlt;
    }
    public function getConfirmedSessionTimeByOrderIdDeliveryId($orderId,$deliveryId){
        $this->db->select('TSM.id');
        $this->db->from($this->timeslot. " as TSM");
        $this->db->join($this->timeslot_user_map." as TM",'TSM.id=TM.time_slot_id');
        $this->db->where('TSM.delivery_id', $deliveryId);
        $resutlt = (array)$this->db->get()->result();
        //die($this->db->last_query());
        return $resutlt;
    }
    
    //delete time -slot
    public function deleteTimeSlotById($id){
       //echo "<pre>";print_r($data);die;
        $where = array('id'=>$id);
        return $this->db->delete($this->time_slot, $where);
    }
    public function getUser($oid='',$delivery_id = "") {
        $this->db->select('user_id');
        $this->db->where('order_id', $oid);
        $this->db->where('delivery_id', $delivery_id);
        $this->db->from($this->usermap);
        $resutlt = $this->db->get()->result();
        return $resutlt;
        //die($this->db->last_query());
    }
    public function getInfoByTimeSlotid($timeslideid=0) {
        $this->db->select('*');
        $this->db->where('time_slot_id', $timeslideid);
        $this->db->from($this->timeslot_user_map);
        //$resutlt = $this->db->get()->result();
        $resutlt=$this->db->get()->row();
        return $resutlt;
        //die($this->db->last_query());
    }
     public function addUsersmap($data = array(), $where = array()) {
        //echo "<pre>";print_r($data);die;
        $this->db->delete($this->usermap, $where);
        if (count($data) > 0 and count($where) > 0) {
            $this->db->insert_batch($this->usermap, $data);
        }
    }

    public function getDeliveryStartEndDate($deliveryid)
    {
        $this->db->select('D.start_date,D.end_date');
        $this->db->from($this->name.' as D');
        $this->db->where('D.id',$deliveryid);
        $query=$this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }
    public function showAllDelivery($id)
    {
        $this->db->select('DV.*,DVY.status');
        $this->db->from($this->name." as DV");
        $this->db->where('DV.order_id',$id);
        $this->db->join($this->delvsos." as DVY",'DVY.diagnose_id=DV.id','LEFT');
        $this->db->group_by('DV.id');
        return $this->db->get()->result();

    }
    
    public function update_Delivery($data,$oid,$id)
            
    {
            $update=$this->db->update($this->name,$data,array('order_id'=>$id, 'id'=>$oid));
           

           //echo "<pre>";print_r($this->db->last_query());die;
            return $update;
    }
     public function deletedata($id ='',$oid='',$postalldata) {
         //echo "<pre>!!!!".$id."#####".$oid;die;
         //echo "<pre>".$id."#####".$oid='';print_r();die;
         
        //delete dependency from 
        if(isset($postalldata['deletereason']) && (!empty($postalldata['deletereason'])))
            $data = array('del_status'=>1,'del_comment'=>$postalldata['deletereason']);   
        else
            $data = array('del_status'=>1);
        $update=$this->db->update($this->assign_date,$data,array('order_id'=>$id,'diagnose_id'=>$oid));
        
       //echo "<pre>";print_r($this->db->last_query());die;
         
        $this->db->where(array('order_id'=>$id, 'id'=>$oid));
        $this->db->delete($this->name); 
       return true;
       } 
       public function deleteUser($oid ='',$did='',$uid) {
        $this->db->where(array('order_id'=>$oid, 'delivery_id'=>$did,'user_id'=>$uid));
        $this->db->delete($this->usermap); 
       return true;
       } 
    public function getSubdelevaryById($id='',$subid='')
    {
            $this->db->select('*');
            $this->db->from($this->name);
            $this->db->where(array('id'=>$subid, 'order_id'=>$id));
            $query= $this->db->get()->row();
           // echo "<pre>";print_r($this->db->last_query());die;
            return $query;
    }
    public function showDeliveryDetails($id='')
    {
        $this->db->select('*');
        $this->db->where('order_id',$id);
        $this->db->from($this->name);
        return $this->db->get()->result();
    }
	
	public function getdeliveryDetail($oid='')
	{
        $this->db->select('DL.*,P.name as product,SB1.name,US.id as uid');
        $this->db->from($this->name." as DL");
        $this->db->join($this->pro.' as P',"P.id=DL.products","LEFT");
        $this->db->join($this->subproducts. ' as SB1',"SB1.id=DL.subproducts","LEFT");
        $this->db->join($this->noofcast. ' as C',"C.diagnose_id=DL.id","LEFT");
        $this->db->join($this->users. ' as US',"US.id=C.casting_manager","LEFT");
        $this->db->where(array('DL.order_id'=>$oid,'P.product_type'=>'3'));
        $this->db->group_by('DL.id');
        $query= $this->db->get()->result();
                
                //echo "<pre>";print_r($this->db->last_query());die;
                
		return $query;
		
	}
        
        public function getdeliveryDetailById($did='')
	{
        $this->db->select('concat(P.name,"|",SB1.name,"|",DL.start_date,"|",DL.end_date) as completedata',false);
        //$this->db->select('DL.start_date,DL.end_date,P.name as product,SB1.name,US.id as uid');
        $this->db->from($this->name." as DL");
        $this->db->join($this->pro.' as P',"P.id=DL.products","LEFT");
        $this->db->join($this->subproducts. ' as SB1',"SB1.id=DL.subproducts","LEFT");
        $this->db->join($this->noofcast. ' as C',"C.diagnose_id=DL.id","LEFT");
        $this->db->join($this->users. ' as US',"US.id=C.casting_manager","LEFT");
        $this->db->where(array('DL.id'=>$did,'P.product_type'=>'3'));
        //$this->db->group_by('DL.id');
        $query= $this->db->get()->row();
                
                //echo "<pre>";print_r($this->db->last_query());die;
                
		return $query;
		
	}
        
    public function getdeliveredProduct($did='')
    {
        //echo "<pre>";print_r($did);die;
        $this->db->select('SB.id,SB.name');
        $this->db->from($this->name." as DL");
        $this->db->join($this->deliveredpro.' as DP',"DP.delivery_id=DL.id","LEFT");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DP.delivery_pro_id","LEFT");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->result();
        //die($this->db->last_query());
        return $query;
        
    }
    
    
    
    public function getDeliveryResources($oid='')
    {
        $this->db->select('DL.id,US.name as resources,US.id as uid');
        $this->db->from($this->name. " as DL");
        $this->db->join($this->noofcast. ' as C',"C.diagnose_id=DL.id","LEFT");
        $this->db->join($this->users. ' as US',"US.id=C.casting_manager","LEFT");
        $this->db->where(array('DL.order_id'=>$oid,'C.type'=>'3','US.user_type'=>'CM'));
        $query= $this->db->get()->result();
        return $query;   
    }
    
    //get selected product id based on develiery id
    public function getSelectedProductId($did){
        $this->db->select('subproducts');
        $this->db->from($this->name. " as DL");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->row();
        return $query; 
    }
    public function getSubProducts($id)
    {
      
        $this->db->select('id,name');
        $this->db->from($this->subproducts);
        $this->db->where('parent_id',$id);
        $this->db->order_by('name');
        $query= $this->db->get()->result();
          //echo "<pre>@###$$$$";print_r($query);die;
        return $query; 
    }
     function  trfAllRecords($where)
   {
     //echo "<pre>modal";print_r($where);die;
     
          $query= $this->db->select('TRI.*,TRP.name as preferred');
               $this->db->from($this->information.' as TRI');
               $this->db->join($this->trf_preferdairlince.' as TRP','TRI.preferred=TRP.id','left');
        $this->db->where('TRI.id',$where['id']);
        $this->db->where('TRI.user_id',$where['uid']);
       
         $query=$this->db->get()->row();
       //echo "<pre>modal";print_r($this->db->last_query());die;
         return $query;
   }

   function deliveryTiming($where=array()){

    $results=$this->db->select("D.*,P.timeduration")
                    ->from($this->name." D")
                    ->join($this->pro." P","P.id=D.products")
                    ->where($where)
                    ->get()->row();

        //echo $this->db->last_query(); die;
    return $results;
   }
   function getusermapData($where=array()){

    $results=$this->db->select("UP.id,UP.user_id")
                    ->from($this->name." D")
                    ->join($this->usermap." UP","UP.delivery_id=D.id")
                    ->where($where)
                    ->get()->row();

        //echo $this->db->last_query(); die;
    return $results;
   }
   // get all caller information for user
   /*function getCallerData($order_id=0,$delivery_id=0){
   $where = array('order_id'=>$order_id,'delivery_id'=>$delivery_id);
   $results=$this->db->select("U.id,U.name,U.email")
                    ->from($this->usermap." UP")
                    ->join($this->users." U","UP.user_id=U.id")
                    ->where($where)
                    ->get()->result();

        //echo $this->db->last_query(); die;
    return $results;
   }*/
   // get all caller information for user
   function getCallerData($order_id=0,$delivery_id=0){
   $where = array('UP.order_id'=>$order_id,'UP.delivery_id'=>$delivery_id);
   $results=$this->db->select("U.id,U.name,U.email,P.name as productname,S.name as subproduct,T.time_slot_start as Time,U.location")
                    ->from($this->usermap." UP")
                    ->join($this->users." U","UP.user_id=U.id",'left')
                    ->join($this->name." N","UP.delivery_id=N.id", 'left')
                    ->join($this->pro." P","N.products=P.id", 'left')
                    ->join($this->subproducts." S","N.subproducts=S.id", 'left')
                    ->join($this->timeslot." T","UP.delivery_id=T.delivery_id", 'left')
                    ->group_by('U.id')
                    ->where($where)
                    ->get()->result();

    //echo $this->db->last_query(); die;
    return $results;
   }
   
   //get all time slots with all users
   function getAllTimeSlotsWithUsers($order_id=0,$delivery_id=0) {
       $where = array('TS.order_id'=>$order_id,'TS.delivery_id'=>$delivery_id);
      $results=$this->db->select("TS.id,TS.timestampstart,TS.timestampend,TS.lunchflage,U.id as user_id,U.name,U.last_name,U.email")
                    ->from($this->timeslot." TS")
                    ->join($this->timeslot_user_map." TSUM","TSUM.time_slot_id=TS.id",'left')
                    ->join($this->users." U","U.id=TSUM.user_id",'left')
                    ->where($where)
                    ->order_by("TS.id", "asc")
                    ->get()->result(); 
       //echo $this->db->last_query(); die;
    return $results;
   }
   
   // save user map with time slot comments
    public function saveCommentsByResource($data)
    {//echo "<pre>";print_r($data);die;
        $this->db->insert($this->usercall,$data);
        //die($this->db->last_query());die;
        return $this->db->insert_id();
        
    }
    //get call history
    function getUserHistory($user_id=0) {
        $where = array('UC.user_id' => $user_id);
        $results = $this->db->select("DATE_FORMAT(UC.enty_date, '%D %M, %Y') as enty_date,UC.comment,U.name",false)
                        ->from($this->usercall . " UC")
                        ->join($this->timeslot . " TSM", "TSM.id= UC.time_slot_id", 'left')
                        ->join($this->users . " U", "U.id=TSM.resource_id", 'left')
                        ->where($where)
                        ->get()->result();
        //echo $this->db->last_query(); die;
        return $results;
    }
    //Participant All information
    function getParticipantDetails($oid,$delivery_id)
    {
        $this->db->select('U.*,UM.order_id,UM.delivery_id,G.id as goalid');
        $this->db->from($this->users.' as U');
        $this->db->join($this->usermap.' as UM','U.id=UM.user_id','left');
        $this->db->join($this->goal.' as G','U.id=G.userid','left');
        $this->db->where(array('UM.order_id'=>$oid,'UM.delivery_id'=>$delivery_id));
        $this->db->group_by(array('U.email','U.username'));
        $query= $this->db->get()->result();
        //echo $this->db->last_query();die;
        return $query;
    }
    function participantGoal($deliveryid,$userid)
    {
        $this->db->select('G.*,UM.order_id');
        $this->db->from($this->goal.' as G');
        $this->db->join($this->usermap.' as UM','UM.user_id=G.userid','left');
         $this->db->where(array('G.deliveryid'=>$deliveryid,'G.userid'=>$userid));
        $query= $this->db->get()->result();
        //echo $this->db->last_query();die;
        return $query;
    }
    function addTodo($data,$where)
    {
         return $this->db->save($this->todo, $data, $where);
    }
    function getTodoList($id)
    {
        $this->db->select('TD.*');
        
        $this->db->from($this->todo.' as TD');
        $this->db->join($this->goal.' as G','G.id=TD.goal_id');
         $this->db->where(array('TD.goal_id'=>$id));
        $query= $this->db->get()->result();
        //echo $this->db->last_query();die;
        return $query;
    }
    function getTodo($id,$todoid)
    {
       $this->db->select('TD.*');
        
        $this->db->from($this->todo.' as TD');
        $this->db->join($this->goal.' as G','G.id=TD.goal_id');
         $this->db->where(array('TD.goal_id'=>$id,'TD.id'=>$todoid));
        $query= $this->db->get()->row();
        //echo $this->db->last_query();die;
        return $query;
    }
      // Delete todos
       public function deleteTodoData($goalid,$todoid)
       {
           $this->db->where(array('id'=>$todoid,'goal_id'=>$goalid));
         $query=  $this->db->delete($this->todo);
         //echo $this->db->last_query();die;
return $query;
       }
       
       
       public function getOrderAndDeliveryId($id)
       {
           $this->db->select('UM.order_id,UM.delivery_id,UM.user_id');
           $this->db->from($this->todo.' as TD');
           $this->db->join($this->goal.' as G','G.id=TD.goal_id');
           $this->db->join($this->usermap.' as UM','UM.user_id=G.userid');
           $this->db->where('TD.goal_id',$id);
           $this->db->group_by('UM.id');
           $query=$this->db->get()->row();
           //echo $this->db->last_query();die;
           return $query;
       }
       ////Get All Product
       public function singleDeliveryProduct($oid,$dlvid)
    {
        $this->db->select('products');
        $this->db->from($this->name);
        $this->db->where(array('id'=>$dlvid,'order_id'=>$oid));
        $query=$this->db->get()->row();
        return $query;
    }
    
    //get resource name based on order id, diagnose id, delivery id
    public function getResourceName($id = 0, $orderid = 0, $ordertype = 0) {
        //SELECT U.name, `manager_id` FROM `itf_assign_date` WHERE `order_id`='157' and `diagnose_id`='1157' and `order_type`=3 and `del_status`=0
        $this->db->select('U.name');
        $this->db->from($this->assign_date. ' as ASD');
        $this->db->where(array('ASD.order_id' => $orderid, 'ASD.diagnose_id' => $id,'ASD.order_type' => $ordertype,'ASD.del_status' => '0'));
        $this->db->join($this->users.' as U','U.id = ASD.manager_id');
        $query = $this->db->get()->row();
        //echo $this->db->last_query();die;
        return $query;
    }

}

