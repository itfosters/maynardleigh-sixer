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
    protected $order = "itf_order";
  
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
    public function totalData($conditions = array(),$id) {
        
        $this->db->select('DV.*,DVY.status,SB.name');

        $this->db->from($this->name." as DV");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DV.subproducts","LEFT");     
        $this->db->where('DV.order_id',$id);
        $this->db->join($this->delvsos." as DVY",'DVY.diagnose_id=DV.id','LEFT');
        $this->db->group_by('DV.id');
        $this->db->order_by("DV.id","desc");


        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);
        
        return $this->db->get()->num_rows;
    }
    public function findUser($conditions = array(), $perpage = 0, $pg = 0,$id) {

        $this->db->select('O.order_id as orders_id,DV.*,DVY.status,SB.name,P.id as pid');

        $this->db->from($this->name." as DV");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DV.subproducts","LEFT");     
        $this->db->join($this->pro. ' as P',"P.id=DV.products","LEFT");
        $this->db->join($this->order. ' as O',"O.id=DV.order_id","LEFT");
        $this->db->where('DV.order_id',$id);
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

        return $query;
    }

	public function add_Delivery($data)
    {//echo "<pre>";print_r($data);die;
        $this->db->insert($this->name,$data);
        return $this->db->insert_id();
        
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
     public function deletedata($id ='',$oid='') {
        $this->db->where(array('order_id'=>$id, 'id'=>$oid));
        $this->db->delete($this->name); 
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
		$query= $this->db->get()->result();
		return $query;
		
	}
public function getdeliveredProduct($did='')
    {
        $this->db->select('SB.id,SB.name');
        $this->db->from($this->name." as DL");
        $this->db->join($this->deliveredpro.' as DP',"DP.delivery_id=DL.id","LEFT");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DP.delivery_pro_id","LEFT");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->result();
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
	  
}

