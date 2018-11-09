<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcomes extends ITF_Model {

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
    protected $noof_casting = "noof_casting";
    
    protected $tableArray = array(1=>'order_diagnose',
				  2=>'order_design',
				  3=>'order_delivery',
				  4=>'order_discovery'
			   );

  
    public function __construct() {
        parent::__construct();
    }

   
       public function getdetail($userid){
       	$this->db->select('*');
        $this->db->from('itf_users');
        $this->db->where("id",$userid);
        $query= $this->db->get()->row();
         //$this->db->last_query(); 
        return $query;
        
       }

    public function updateinfo($data,$userid ){
       //echo "<pre>";print_r( $data ); die;
       unset($data['submit']);
        $this->db->where('id', $userid );
        $updated=$this->db->update('itf_users',$data);
        if($updated){
        	return true;
        }else{
        	return false;
        }

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
        $this->db->join($this->noof_casting." as CD","CD.diagnose_id=AD.diagnose_id");
	$this->db->where(array('AD.manager_id'=>$userid,'CD.casting_manager'=>$userid,'AD.del_status'=>0));
        //$this->db->where(array('manager_id'=>$userid));
        
        
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


	public function getAssignDateDetails($where=array())
{


$mid=$where['casting_id'];
$this->db->select('AD.id,AD.order_id,AD.order_type,AD.diagnose_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time,U.name as clientname,AD.status,AD.comment');
		$this->db->from($this->assigndate." as AD");
		
		$this->db->join($this->order." as O","AD.order_id=O.id",'inner');
		$this->db->join($this->name." as U","O.client_id=U.id",'inner');
		$this->db->join($this->noof_casting." as CD","CD.diagnose_id=AD.diagnose_id");
		

$this->db->where(array('AD.manager_id'=>$mid,'CD.casting_manager'=>$mid,'AD.del_status'=>0));
$this->db->_protect_identifiers=false; 
$this->db->order_by("STR_TO_DATE(AD.start_date,'%m/%d/%Y')",'desc');
$query=$this->db->get()->result();
//echo $this->db->last_query(); die;
return $query;
}

public function getMoreInfoForResource($order_id,$order_type){
	//echo $this->tableArray[$order_type]."<hr>";
	 $this->db->select('O.location,P.name,S.name as subname',false);
        $this->db->from($this->tableArray[$order_type]." O");

        $this->db->join($this->pro." as P","O.products=P.id",'left');
		$this->db->join($this->subpro." as S","O.subproducts=S.id",'left');
		


        $this->db->where(array('O.id'=>$order_id));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->row();
        return $query;
        //echo $this->db->last_query(); die;

}
public function getMoreDataForResource($order_id,$order_type,$diagnoseid){
	//echo $this->tableArray[$order_type]."<hr>";
	 $this->db->select('O.location,P.name,S.name as subname, OO.order_Id as showorderid',false);
        $this->db->from($this->tableArray[$order_type]." O");

        $this->db->join($this->pro." as P","O.products=P.id",'left');
	$this->db->join($this->subpro." as S","O.subproducts=S.id",'left');
	$this->db->join($this->order." as OO","OO.id=O.order_id",'left');
		


        $this->db->where(array('O.id'=>$diagnoseid));
        //$this->db->where(array('start_date'=>$startdata,'end_date'=>$enddate));
        $query= $this->db->get()->row();
         //echo $this->db->last_query(); die;

        return $query;
       
}
    public function getClientName($assignId){
       $this->db->select('U.name',false);
        $this->db->from($this->assigndate." IAD");

        $this->db->join($this->order." as O","O.id = IAD.order_id",'left');
        $this->db->join($this->name." as U","O.client_id=U.id",'left');

        $this->db->where(array('IAD.id'=>$assignId));
        $query= $this->db->get()->row();
        return $query; 
    }
}

?>
