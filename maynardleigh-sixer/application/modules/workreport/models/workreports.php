<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Workreports extends ITF_Model {

    protected $name = "users";
    protected $order="order";
    protected $diagnose="order_diagnose";
    protected $design="order_design";
    protected $economicbuyer="order_economic";
    protected $assigndate = "assign_date";
    protected $acceptreject = "manager_accept_reject";
    protected $delivery = "order_delivery";
    protected $discovery = "order_discovery";
    protected $pro = "product";
    protected $subpro = "subproducts";
    protected $casting = "noof_casting";
    protected $noof_casting = "noof_casting";
    
    protected $tableArray = array(1=>'order_diagnose',
							2=>'order_design',
							3=>'order_delivery',
							4=>'order_discovery'
							);

  
    public function __construct() {
        parent::__construct();
    }

	public function getStatistic()
	{
	
		$query= $this->db->query("select 
		case when title='users' then total  end as totaluser,
		case when title='pages' then total  end as totalpages
		 from  (SELECT '1' as rowdata, count(id) as total,'users' as title FROM ".$this->db->dbprefix('users'). " UNION  SELECT '1' as rowdata, count(id) as total,'pages' as title FROM ".$this->db->dbprefix('pages').")  statistc");
		//echo $this->db->last_query(); die;
		return $query->result();
	} 
	public function getCalenderData($ids)
	{
		$this->db->select('U.id,A.start_date,A.end_date');
		$this->db->from($this->name." as U");
		$this->db->join($this->assigndate." A","U.id=A.manager_id");
		$this->db->where('U.id',$ids);

		$query = $this->db->get()->row();
		//echo "@@@<pre>";print_r($this->db->last_query());die;
		return $query;
	}
	public function add_Comment($data)
	{
		//echo "$$<pre>";print_r($where);die;
				//$this->db->where('')
	 $this->db->insert($this->acceptreject,$data);
	}
	public function updateReject($data=array()){
		$where=array('id'=>$data['id']);
				$query=$this->db->update($this->assigndate,$data,$where);

	}
	public function getDiagnosePopUpDetails($ids=0,$order_type=0)
	{
		//echo"<pre>#####";print_r($ids);die;
		
		$this->db->select('D.id as Diagnose_id,D.subproducts,S.name as sproducts,D.location,
							P.name,P.product_type,
						   	U.name as ClientName,
						   	',false);
		$this->db->from($this->tableArray[$order_type]." as D");
		$this->db->join($this->order." as O","D.order_id=O.id",'left');
		$this->db->join($this->name." as U","O.client_id=U.id",'left');
		$this->db->join($this->pro.' as P','D.products=P.id','left');
		$this->db->join($this->subpro.' as S','D.subproducts=S.id','left');
		$this->db->where('D.id',$ids);
		$query=$this->db->get()->row();
		//echo "<pre>22";print_r($this->db->last_query());die;
		return $query;
	}
	public function totalData($id,$conditions = array()) {

//echo "<pre>";print_r($id);die;



        //$this->db->from($this->name);
        $this->db->select('         
                        AD.order_Id,AD.status'
                        );

            $this->db->from($this->assigndate.'  AS AD');
            $this->db->join($this->order.'  AS O','AD.order_id=O.id');
            $this->db->join($this->name.' as U','O.client_id=U.id');
            $this->db->join($this->name.' as U1','O.sales_by_id=U1.id');
            $this->db->join($this->name.' as U2', 'O.pm_id =  U2.Id'); 
            $this->db->join($this->economicbuyer.' as E', 'O.id =  E.order_Id');
            $this->db->where(array('AD.status'=>1,'manager_id'=>$id));



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);



        $query= $this->db->get()->num_rows;
        //echo $this->db->last_query();die;
        return $query;
    }
	
	
	public function statusChange($data=array(),$where=array())
	{
		$query=$this->db->update($this->assigndate,$data,$where);
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query;
	}
	 public function getAssignDate($userid)
    {   //echo "!!!<pre>";print_r($userid);die;
        $this->db->select('AD.order_id,AD.id,AD.diagnose_id,AD.manager_id,AD.order_type,str_to_date(AD.start_date,"%m/%d/%Y") as start,AD.start_time,str_to_date(AD.end_date,"%m/%d/%Y") as end,AD.end_time,AD.status',false);
        $this->db->from($this->assigndate." AD");
        $this->db->where(array('manager_id'=>$userid));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->result();
        //echo $this->db->last_query(); die;
        return $query;
    }
    public function getOrderIdAssignTable($userid)
    {
    	$this->db->select('AD.order_id',false);
        $this->db->from($this->assigndate." AD");
        $this->db->where(array('manager_id'=>$userid));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->row();
        //echo $this->db->last_query(); die;
        return $query;
    }
    // public function getAssignTimeResource($did,$mid)
    // {   
    //     $this->db->select('AD.start_time,AD.end_time');
    //     $this->db->from($this->assign_date." as AD");
    //     $this->db->where(array('AD.diagnose_id'=>$did,'AD.manager_id'=>$mid));
    //     $query= $this->db->get()->result();
    //     return $query;
    // }
	public function getAssignDateDetails($where=array())
{
//echo "!!!!!!!!!<pre>";print_r($where);die;

$mid=$where['casting_id'];
$this->db->select('AD.id,AD.order_id,AD.order_type,AD.diagnose_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time,AD.comment,AD.del_comment,U.name as clientname,AD.status,UC.name AS clientsname',false);
		$this->db->from($this->casting." as C ");
		
		$this->db->join($this->assigndate." as AD","C.casting_manager=AD.manager_id",'left');
		//$this->db->join($this->diagnose." as D","D.order_id=O.id",'left');
		$this->db->join($this->name." as U","C.casting_manager=U.id",'left');
                $this->db->join($this->order." as O","O.id=AD.order_id",'left');
		$this->db->join($this->name." as UC","O.client_id=UC.id",'left');
		$this->db->join($this->casting." as NC","AD.diagnose_id=NC.diagnose_id AND AD.manager_id=NC.casting_manager",'inner');
                if(!empty($mid))
		$this->db->where('AD.manager_id ',$mid);
		//$this->db->where('str_to_date(AD.start_date,"%m/%d/%Y") >=',$where['start_date'],false);
		//$this->db->where('str_to_date(AD.end_date,"%m/%d/%Y") <=',$where['end_date'],false);

		$this->db->where("(str_to_date(AD.start_date,'%m/%d/%Y') >='".$where['start_date']."' and 
			str_to_date(AD.start_date,'%m/%d/%Y') <='".$where['end_date']."'
			) or (str_to_date(AD.end_date,'%m/%d/%Y') >='".$where['start_date']."' and 
			str_to_date(AD.end_date,'%m/%d/%Y') <='".$where['end_date']."'
			)",false,false);
		$this->db->where('AD.status','1');
                if(!empty($mid))
		$this->db->where('U.id',$mid);
		//$this->db->where('user_type','CM');
		$this->db->group_by('AD.id');
		$this->db->order_by('AD.start_date');
		$query=$this->db->get()->result();
		//echo"<pre>@@";print_r($this->db->last_query()); die;

		return $query;
}
	public function getAssignDateDownload($where=array())
{
//echo "<pre>";print_r($where);die;
$mid=$where['casting_id'];
$this->db->select('AD.id,AD.order_id,AD.order_type,AD.diagnose_id,AD.start_date,AD.entry_date,AD.start_time,AD.end_date,AD.end_time,U.name as clientname,AD.status,UC.name AS clientsname');
		$this->db->from($this->casting." as C");
		
		$this->db->join($this->assigndate." as AD","C.casting_manager=AD.manager_id",'left');
		//$this->db->join($this->diagnose." as D","D.order_id=O.id",'left');
		$this->db->join($this->name." as U","C.casting_manager=U.id",'left');
		$this->db->join($this->order." as O","O.id=AD.order_id",'left');
		$this->db->join($this->name." as UC","O.client_id=UC.id",'left');
                
                
                if(!empty($mid))
		$this->db->where('AD.manager_id ',$mid);
                
		//$this->db->where('str_to_date(AD.start_date,"%m/%d/%Y") >=',$where['start_date'],false);
		//$this->db->where('str_to_date(AD.end_date,"%m/%d/%Y") <=',$where['end_date'],false);

		$this->db->where("(str_to_date(AD.start_date,'%m/%d/%Y') >='".$where['start_date']."' and 
			str_to_date(AD.start_date,'%m/%d/%Y') <='".$where['end_date']."'
			) or (str_to_date(AD.end_date,'%m/%d/%Y') >='".$where['start_date']."' and 
			str_to_date(AD.end_date,'%m/%d/%Y') <='".$where['end_date']."'
			)",false,false);
		$this->db->where('AD.status','1');
                 if(!empty($mid))
                    $this->db->where('U.id',$mid);
                
		$this->db->group_by('C.casting_manager');
		$query=$this->db->get()->result_array();
		
                //echo "<pre>";print_r($query);die;
		return $query;
}

public function getMoreInfoForResource($order_id,$order_type){
	//echo $this->tableArray[$order_type]."<hr>";
	 $this->db->select('O.location,P.name,P.catalyst_call_flag,P.executive_call_flag, O.weight,O.cunsulting_days,O.units,S.name as subname',false);
        $this->db->from($this->tableArray[$order_type]." as O");
		$this->db->join($this->pro." as P","O.products=P.id",'left');
		$this->db->join($this->subpro." as S","O.subproducts=S.id",'left');
		


        $this->db->where(array('O.id'=>$order_id));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->row();
        //echo $this->db->last_query(); die;
        return $query;

}
public function getMoreDownloadResource($order_id,$order_type){
	//echo $this->tableArray[$order_type]."<hr>";
	//$this->db->select('O.location,P.name,ROUND(P.weight*O.units) as weight,S.name as subname',false);
        $this->db->select('O.location,P.name,O.weight,O.cunsulting_days,O.units,S.name as subname',false);
        $this->db->from($this->tableArray[$order_type]." O");

        $this->db->join($this->pro." as P","O.products=P.id",'left');
		$this->db->join($this->subpro." as S","O.subproducts=S.id",'left');
		


        $this->db->where(array('O.id'=>$order_id));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->row_array();
      //echo"<pre>";print_r($query); die;
        	# code...
        	  return $query;
  
    
        //echo $this->db->last_query(); die;

}
  function calender_resource($id)
    {
       $this->db->select("name");
        $this->db->from($this->name);
       $this->db->where("user_type",'CM');
       $this->db->where("id",$id);
        $query = $this->db->get()->row();
        return $query;
    }
    
        public function getAllLeadershipList($where=array())
{

                $mid=isset($where['casting_id'])?$where['casting_id']:'';
                $this->db->select('AD.id,AD.order_id,AD.order_type,AD.diagnose_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time,AD.comment,AD.del_comment,U.name as clientname,U.email as resourceemail,AD.status,UC.name AS clientsname',false);
		$this->db->from($this->casting." as C ");
		
		$this->db->join($this->assigndate." as AD","C.casting_manager=AD.manager_id",'left');
		//$this->db->join($this->diagnose." as D","D.order_id=O.id",'left');
		$this->db->join($this->name." as U","C.casting_manager=U.id",'left');
                $this->db->join($this->order." as O","O.id=AD.order_id",'left');
		$this->db->join($this->name." as UC","O.client_id=UC.id",'left');
		$this->db->join($this->casting." as NC","AD.diagnose_id=NC.diagnose_id AND AD.manager_id=NC.casting_manager",'inner');
                if(!empty($mid))
		$this->db->where('AD.manager_id ',$mid);
		//$this->db->where('str_to_date(AD.start_date,"%m/%d/%Y") >=',$where['start_date'],false);
		//$this->db->where('str_to_date(AD.end_date,"%m/%d/%Y") <=',$where['end_date'],false);

		$this->db->where("(str_to_date(AD.start_date,'%m/%d/%Y') >='".$where['start_date']."')",false,false);
		$this->db->where('AD.status','1');
                if(!empty($mid))
		$this->db->where('U.id',$mid);
		//$this->db->where('user_type','CM');
		$this->db->group_by('AD.id');
		$this->db->order_by('AD.start_date');
		$query=$this->db->get()->result();
		//echo"<pre>@@";print_r($this->db->last_query()); die;

		return $query;
        }
    

}


