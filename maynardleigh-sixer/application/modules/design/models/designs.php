<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Designs extends ITF_Model {

    protected $name = "order_design";
    protected $noofcast = "noof_casting";
    protected $manager = "projectmanager";
    protected $assign_date = "assign_date";
    protected $desos = "design_status";
    protected $users = "itf_users";
    protected $subproducts = "subproducts";
    protected $pro = "product";
    protected $information = "itf_trf_information";
    protected $trf_preferdairlince = "itf_trf_preferredairlince";
    protected $order = "itf_order";
    protected $usermap = "itf_usermap";
  
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		
	} 
    public function totalData($conditions = array(),$id) {

      $this->db->select('DS.*,DEOS.status,SB.name');
        $this->db->from($this->name." as DS");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DS.subproducts","LEFT");
        $this->db->where('DS.order_id',$id);
        $this->db->join($this->desos." as DEOS",'DEOS.diagnose_id=DS.id','LEFT');
        $this->db->group_by('DS.id');
        $this->db->order_by('DS.id','desc');




        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);
        return $this->db->get()->num_rows;
    }
    public function findUser($conditions = array(), $perpage = 0, $pg = 0,$id) {

         $this->db->select('O.order_id as orders_id,DS.*,DEOS.status,SB.name,P.name as pname');
        $this->db->from($this->name." as DS");
        $this->db->join($this->pro. ' as P',"P.id=DS.products","LEFT");
        $this->db->join($this->subproducts. ' as SB',"SB.id=DS.subproducts","LEFT");
        $this->db->join($this->order. ' as O',"O.id=DS.order_id","LEFT");
        $this->db->where('DS.order_id',$id);
        $this->db->join($this->desos." as DEOS",'DEOS.diagnose_id=DS.id','LEFT');
        $this->db->group_by('DS.id');
        $this->db->order_by('DS.id','desc');




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

	public function add_Design($data)
    {
        $this->db->insert($this->name,$data);
        return $this->db->insert_id();
        
    }
    public function getDesignStartEndDate($designid)
    {
        $this->db->select('D.start_date,D.end_date');
        $this->db->from($this->name.' as D');
        $this->db->where('D.id',$designid);
        $query=$this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }
    
    public function showAllDesign($id)

    {
        $this->db->select('DS.*,DEOS.status');
        $this->db->from($this->name." as DS");
        $this->db->where('DS.order_id',$id);
        $this->db->join($this->desos." as DEOS",'DEOS.diagnose_id=DS.id','LEFT');
        $this->db->group_by('DS.id');
        return $this->db->get()->result();

    }
    public function getSubdesignById($id='',$subid='')
    {
            $this->db->select('*');
            $this->db->from($this->name);
            $this->db->where(array('id'=>$subid, 'order_id'=>$id));
            $query= $this->db->get()->row();
           // echo "<pre>";print_r($this->db->last_query());die;
            return $query;
    }

    public function update_Design($data,$oid,$id)
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
       public function showDesignDetails($id='')
    {
        $this->db->select('*');
        $this->db->where('order_id',$id);
        $this->db->from($this->name);

        return $this->db->get()->result();
    }
   
	public function getdesignDetail($oid='')
	{
            $this->db->select('DS.*,P.name as product,SB.name');
            $this->db->from($this->name." as DS");
            $this->db->join($this->pro. ' as P',"P.id=DS.products");
            $this->db->join($this->subproducts. ' as SB',"SB.id=DS.subproducts","LEFT");
            $this->db->where(array('DS.order_id'=>$oid,'P.product_type'=>'2'));
            $this->db->group_by('DS.id');
            $query= $this->db->get()->result();
	return $query;
		
	}
	public function getdesignDetailById($did='')
	{
            $this->db->select('concat(P.name,"|",SB.name,"|",DS.start_date,"|",DS.end_date) as completedata',false);
            $this->db->from($this->name." as DS");
            $this->db->join($this->pro. ' as P',"P.id=DS.products");
            $this->db->join($this->subproducts. ' as SB',"SB.id=DS.subproducts","LEFT");
            $this->db->where(array('DS.id'=>$did,'P.product_type'=>'2'));
            $this->db->group_by('DS.id');
            $query= $this->db->get()->row();
	return $query;
		
	}
	  public function getDesignResources($oid='')
    {
        $this->db->select('DS.id,US.name as resources');
        $this->db->from($this->name. " as DS");
        $this->db->join($this->noofcast. ' as C',"C.diagnose_id=DS.id","LEFT");
        $this->db->join($this->users. ' as US',"US.id=C.casting_manager","LEFT");
        $this->db->where(array('DS.order_id'=>$oid,'C.type'=>'2','US.user_type'=>'CM'));
        $query= $this->db->get()->result();
        return $query;   
    }
     public function getdesignedDayInfo($did='')
    {
        $this->db->select('DL.cunsulting_days');
        $this->db->from($this->name." as DL");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->row();
        //die($this->db->last_query());
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
   
   //start 
    public function getDeliveryStartEndDate($deliveryid)
    {
        $this->db->select('D.start_date,D.end_date');
        $this->db->from($this->name.' as D');
        $this->db->where('D.id',$deliveryid);
        $query=$this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
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

}

