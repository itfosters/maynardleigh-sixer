<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Discoveries extends ITF_Model {

    protected $name = "order_discovery";
    protected $discovysos = "discovery_status";
    protected $users = "itf_users";
    protected $noofcast = "noof_casting";
    protected $subproducts = "subproducts";
    protected $pro = "product";
    protected $information = "itf_trf_information";
    protected $trf_preferdairlince = "itf_trf_PreferredAirlince";
    protected $order = "itf_order";
  
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	} 
    public function totalData($conditions = array(),$id) {
        
            $this->db->select('DIS.*,DSY.status,SB.name');
         $this->db->from($this->name." as DIS");
         $this->db->join($this->subproducts. ' as SB',"SB.id=DIS.subproducts","LEFT");
         $this->db->join($this->discovysos." as DSY",'DSY.diagnose_id=DIS.id','LEFT');
         $this->db->where('DIS.order_id',$id);
         $this->db->group_by('DIS.id');
         $this->db->order_by('DIS.id','desc');

        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);

        return $this->db->get()->num_rows;
    }
    public function findUser($conditions = array(), $perpage = 0, $pg = 0,$id) {

         $this->db->select('O.order_id as orders_id,DIS.*,DSY.status,SB.name,P.name as pname');
         $this->db->from($this->name." as DIS");
         $this->db->join($this->subproducts. ' as P',"P.id=DIS.products","LEFT");
         $this->db->join($this->subproducts. ' as SB',"SB.id=DIS.subproducts","LEFT");
         $this->db->join($this->discovysos." as DSY",'DSY.diagnose_id=DIS.id','LEFT');
         $this->db->join($this->order. ' as O',"O.id=DIS.order_id","LEFT");
         $this->db->where('DIS.order_id',$id);
         $this->db->group_by('DIS.id');
         $this->db->order_by('DIS.id','desc');

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

	public function add_Discovery($data)
    {
        $this->db->insert($this->name,$data);
        return $this->db->insert_id();
        
    }
    public function getDiscoveryStartEndDate($discoveryid)
    {
        $this->db->select('D.start_date,D.end_date');
        $this->db->from($this->name.' as D');
        $this->db->where('D.id',$discoveryid);
        $query=$this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }
    public function showAllDiscovery($id)
    {
        $this->db->select('DIS.*,DSY.status');
        $this->db->from($this->name." as DIS");
        $this->db->where('DIS.order_id',$id);
        $this->db->join($this->discovysos." as DSY",'DSY.diagnose_id=DIS.id','LEFT');
        $this->db->group_by('DIS.id');
        return $this->db->get()->result();


    }
    
    public function getdiscoveriesDayInfo($did='')
    {
        $this->db->select('DL.cunsulting_days');
        $this->db->from($this->name." as DL");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->row();
        //die($this->db->last_query());
        return $query;
        
    }
     public function getSubdiscoveryById($id='',$subid='')
    {//die('dsfef');
            $this->db->select('*');
            $this->db->where(array('id'=>$subid, 'order_id'=>$id));
            $this->db->from($this->name);
            
            $query= $this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
            return $query;
    }
    public function update_Discovery($data,$oid,$id)
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
       public function showDiscoveryDetails($id='')
    {
        $this->db->select('*');
        $this->db->where('order_id',$id);
        $this->db->from($this->name);

        return $this->db->get()->result();
    }
	
	public function getdiscoveryDetail($oid='')
	{
		$this->db->select('D.*,P.name as product,SB.name');
        $this->db->from($this->name." as D");
        $this->db->join($this->pro. ' as P',"P.id=D.products","LEFT");
        $this->db->join($this->subproducts. ' as SB',"SB.id=D.subproducts","LEFT");
		$this->db->where(array('D.order_id'=>$oid,'P.product_type'=>'4'));
		$query= $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
		return $query;
		
	}
	
    public function getDiscoveryResources($oid='')
    {
        $this->db->select('DS.id,US.name as resources');
        $this->db->from($this->name. " as DS");
        $this->db->join($this->noofcast. ' as C',"C.diagnose_id=DS.id","LEFT");
        $this->db->join($this->users. ' as US',"US.id=C.casting_manager","LEFT");
        $this->db->where(array('DS.order_id'=>$oid,'C.type'=>'4','US.user_type'=>'CM'));
        $query= $this->db->get()->result();
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

