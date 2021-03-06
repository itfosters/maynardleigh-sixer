<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Diagnoses extends ITF_Model {

    protected $name = "itf_order_diagnose";
    protected $name_design = "itf_order_design";
    protected $name_delivery = "itf_order_delivery";
    protected $name_discovery = "itf_order_discovery";
    protected $pro = "product";
    protected $subproducts = "subproducts";
    protected $noofcast = "noof_casting";
    protected $deliveredpro = "noof_deliveredpro";
    protected $manager = "projectmanager";
    protected $assign_date = "assign_date";
    protected $users = "itf_users";
    protected $usermap = "usermap";
    protected $dos = "diagnose_status";
    protected $order = "order";
    protected $trf_info = "trf_information";
    protected $trf_preferdairlince = "itf_trf_preferredairlince";
    protected $membershipdetail = "itf_membershipdetail";

    public function __construct() {
        parent::__construct();
    }

    public function totalData($conditions = array(), $id) {

        //$this->db->from($this->name);
        $this->db->select('D.*,DOS.status,SB.name,P.name as proname');
        $this->db->from($this->name . ' as D');
        $this->db->join($this->subproducts . ' as SB', "SB.id=D.subproducts", "LEFT");
        $this->db->join($this->pro . ' as P', "P.id=D.products", "LEFT");
        $this->db->where('D.order_id', $id);
        $this->db->join($this->dos . " as DOS", 'DOS.diagnose_id=D.id', 'LEFT');
        $this->db->group_by('D.id');



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);

        return $this->db->get()->num_rows;
    }

    function checkAssignData($orderid = "", $diagnoseid = 0, $otype = 1) {
        $total_accept = $this->db->select("order_type,status,count(id) as totals", false)->from($this->assign_date)
                        ->where(array("order_id" => $orderid, 'del_status' => 0, 'diagnose_id' => $diagnoseid, 'order_type' => $otype))
                        ->group_by("status")
                        ->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        //echo "#####<pre>";print_r($total_accept);die;

        $allorderty = array("A" => "0", "R" => "0", "N" => "0");
        foreach ($total_accept as $ad) {

            // if(isset($allorderty[$ad->order_type])){}else{$allorderty[$ad->order_type] = $statusinfo;}

            if (isset($ad->order_type)) {
                if ($ad->status == "1")
                    $allorderty["A"] = $ad->totals;
                else if ($ad->status == "2")
                    $allorderty["R"] = $ad->totals;
                else
                    $allorderty["N"] = $ad->totals;
            }
        }
        //$res['alltype']=$allorderty;
        //echo "<pre>";print_r($res);die;

        return $allorderty;
    }

    public function findUser($conditions = array(), $perpage = 0, $pg = 0, $id) {

        //echo "<pre>";print_r($conditions);die;
        //$this->db->select('D.*,DOS.status,SB.name,P.name as proname');
        $this->db->select('O.order_id as orders_id,D.*,SB.name,P.name as proname');
        $this->db->from($this->name . ' as D');
        $this->db->join($this->subproducts . ' as SB', "SB.id=D.subproducts", "LEFT");
        $this->db->join($this->pro . ' as P', "P.id=D.products", "LEFT");
        $this->db->join($this->order. ' as O',"O.id=D.order_id","LEFT");
        $this->db->where('D.order_id', $id);
        //$this->db->join($this->dos." as DOS",'DOS.diagnose_id=D.id','LEFT');
        $this->db->group_by('D.id');
        $this->db->order_by('D.id', 'desc');



        if (isset($conditions["where"]) and count($conditions["where"]) > 0)
            $this->db->where($conditions["where"]);



        if (isset($conditions["like"]) and count($conditions["like"]) > 0)
            $this->db->or_like($conditions["like"]);


        if ($perpage > 0)
            $this->db->limit($perpage, $pg);

        //$this->db->order_by("name", "asc");

        $query = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function index() {
        
    }
    

    public function add_Diagnose($data) {
        $this->db->insert($this->name, $data);
        return $this->db->insert_id();
    }
    
    public function getdiagnosedDayInfo($did='')
    {
        $this->db->select('DL.cunsulting_days');
        $this->db->from($this->name." as DL");
        $this->db->where(array('DL.id'=>$did));
        $query= $this->db->get()->row();
        //die($this->db->last_query());
        return $query;
        
    }

    public function addCasting($data = array(), $where = array()) {
        //echo "<pre>";print_r($data);die;
        $this->db->delete($this->noofcast, $where);
        if (count($data) > 0 and count($where) > 0) {
            $this->db->insert_batch($this->noofcast, $data);
        }
    }

    public function getCurrentExsitenceResourceId($diagnoseid = 0) {
        $this->db->select('casting_manager')
                ->from($this->noofcast)
                ->where('diagnose_id', $diagnoseid);
        $resutlt = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $resutlt;
    }
    
    //get complete diagnose Id
    public function getDiagnosesInforationById($diagnoseid = 0,$table ='diagnose') {
       
        $this->db->select('*')
                ->from('itf_order_'.$table)
                ->where('id', $diagnoseid);
        $resutlt = $this->db->get()->row();
        //echo "<pre>";print_r($resutlt);die;
        return $resutlt;
    }

    public function setStatusInAssingDate($orderid = 0, $diagonoseId = 0, $resouceId = 0) {
        $data['del_status'] = 1;
        $where = array('order_id' => $orderid, 'diagnose_id' => $diagonoseId, 'manager_id' => $resouceId);
        $this->db->save($this->assign_date, $data, $where);
    }

    //delete of date in calender by ajax

    public function deleteAssignDate($id = 0) {
        $where = array('id' => $id);
        $this->db->delete($this->assign_date, $where);
    }

    public function addDeliveredProduct($data, $where = array()) {
        $this->db->delete($this->deliveredpro, $where);
        if (count($data) > 0 and count($where) > 0) {

            $this->db->insert_batch($this->deliveredpro, $data);
        }
    }

    public function getCasting($diagnose_id = "", $type = 1) {
        $this->db->select('casting_manager,casting_manager');
        $this->db->where('diagnose_id', $diagnose_id);
        $this->db->where('type', $type);
        $this->db->from($this->noofcast);
        $resutlt = $this->db->get()->result();
        return $resutlt;
        //die($this->db->last_query());
    }

    public function getDeliveredPro($deliveryid = '') {
        $this->db->select('delivery_id,delivery_pro_id');
        $this->db->where('delivery_id', $deliveryid);
        //$this->db->where('type',$type);
        $this->db->from($this->deliveredpro);
        $resutlt = $this->db->get()->result();
        return $resutlt;
    }

    public function getResourceEmailName($mid) {
        //echo "###<pre>";print_r($mid);die;
        $this->db->select('name,email');
        $this->db->from($this->users);
        $this->db->where('id', $mid);

        $resutlt = $this->db->get()->row();
        //echo $this->db->last_query();die;
        return $resutlt;
    }

    public function showAllDiagnose($id) {
        $this->db->select('D.*,DOS.status');
        $this->db->from($this->name . ' as D ');
        $this->db->where('D.order_id', $id);
        $this->db->join($this->dos . " as DOS", 'DOS.diagnose_id=D.id', 'LEFT');
        $this->db->group_by('D.id');
        return $this->db->get()->result();
    }

    public function assignUser($ids) {
        $this->db->select('NC.diagnose_id,GROUP_CONCAT(NC.casting_manager) as resources');
        $this->db->from($this->name . " as D");
        $this->db->join($this->noofcast . " as NC", "NC.diagnose_id=D.id");
        $this->db->where('D.order_id', $ids);
        $this->db->group_by('NC.diagnose_id');
        $query = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function getSubdiagnoseById($id = '', $subid = '') {
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->where(array('id' => $subid, 'order_id' => $id));
        $query = $this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function update_Diagnose($data, $oid, $id) {

        $update = $this->db->save($this->name, $data, array('order_id' => $id, 'id' => $oid));

        //echo "<pre>";print_r($this->db->last_query());die;
        return $update;
    }

    public function showDiagnoseDetails($id = '') {
        $this->db->select('*');
        $this->db->from($this->name);
        $this->db->where('order_id', $id);
        return $this->db->get()->result();
    }

    public function getAllManagers($did, $where = array()) {
        $otype = $where['order_type'];
        $this->db->select('M.id,M.name')
                ->from($this->noofcast . ' as D1')
                ->join($this->users . ' as M', 'M.id=D1.casting_manager')
                ->where(array('D1.diagnose_id' => $did, 'D1.type' => $otype));
        $query = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function getDiagnosePopUpDetails($did) {
        $this->db->select('')
                ->from($this->name . ' as D')
                ->join($this->users . ' as U', 'U.id=D.casting_manager')
                ->where('D1.diagnose_id', $did);
        $query = $this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function getResourcesAssignDetails($ids = 0, $order_type = 0) {
        $o_type = $order_type['order_type'];
        //echo "<pre>22";print_r($o_type);die;
        $tableArray = array(1 => $this->name,
            2 => $this->name_design,
            3 => $this->name_delivery,
            4 => $this->name_discovery
        );
        //echo "<pre>";print_r($tableArray[$o_type]);die;
        //$this->db->select('D.id as Diagnose_id,SP.name,D.location,
                            //P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            //AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time', false);
        $this->db->select('D.id as Diagnose_id,SP.name,D.location,D.products,D.intervaltime,D.lunchstarttime,D.lunchendtime,
                            P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time', false);
        $this->db->from($tableArray[$o_type] . " as D");
        $this->db->join($this->assign_date . " as AD", "D.id=AD.diagnose_id", "left");
        $this->db->join($this->order . " as O", "O.id=D.order_id", 'left');
        $this->db->join($this->users . " as U", "AD.manager_id=U.id", 'left');
        $this->db->join($this->users . " as U1", "O.client_id=U1.id", 'left');
        $this->db->join($this->pro . ' as P', 'D.products=P.id', 'left');
        $this->db->join($this->subproducts . ' as SP', 'D.subproducts=SP.id', 'left');

        $this->db->where('D.id', $ids);
        //$this->db->where('AD.diagnose_id', $ids);
        $this->db->group_by('D.id');
        $query = $this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;
    }
    
    
    public function getResourcesAssignDetailsForDelete($ids = 0, $order_type = 0) {
        $o_type = $order_type['order_type'];
        //echo "<pre>22";print_r($o_type);die;
        $tableArray = array(1 => $this->name,
            2 => $this->name_design,
            3 => $this->name_delivery,
            4 => $this->name_discovery
        );
        //echo "<pre>";print_r($tableArray[$o_type]);die;
        //$this->db->select('D.id as Diagnose_id,SP.name,D.location,
                            //P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            //AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time', false);
        $this->db->select('D.id as Diagnose_id,SP.name,D.location,D.products,D.intervaltime,D.lunchstarttime,D.lunchendtime,
                            P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time,AD.tstartdatetime,AD.tenddatetime', false);
        $this->db->from($tableArray[$o_type] . " as D");
        $this->db->join($this->assign_date . " as AD", "D.id=AD.diagnose_id", "left");
        $this->db->join($this->order . " as O", "O.id=D.order_id", 'left');
        $this->db->join($this->users . " as U", "AD.manager_id=U.id", 'left');
        $this->db->join($this->users . " as U1", "O.client_id=U1.id", 'left');
        $this->db->join($this->pro . ' as P', 'D.products=P.id', 'left');
        $this->db->join($this->subproducts . ' as SP', 'D.subproducts=SP.id', 'left');

        //$this->db->where('D.id', $ids);
        $this->db->where('AD.diagnose_id', $ids);
        $this->db->where('AD.del_status', '0');
        //$this->db->group_by('D.id');
        $query = $this->db->get()->result();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;
    }
    
    public function getResourcesAssignDetailsForUpdateResource($ids = 0, $order_type = 0,$managerid=0) {
        $o_type = $order_type;
        //echo "<pre>22";print_r($o_type);die;
        $tableArray = array(1 => $this->name,
            2 => $this->name_design,
            3 => $this->name_delivery,
            4 => $this->name_discovery
        );
        //echo "<pre>";print_r($tableArray[$o_type]);die;
        //$this->db->select('D.id as Diagnose_id,SP.name,D.location,
                            //P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            //AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time', false);
        $this->db->select('D.id as Diagnose_id,SP.name,D.location,D.products,D.intervaltime,D.lunchstarttime,D.lunchendtime,
                            P.name as proname,U.name as resourcename,U.email,U1.name as clientname,
                            AD.manager_id,AD.start_date,AD.start_time,AD.end_date,AD.end_time,AD.tstartdatetime,AD.tenddatetime', false);
        $this->db->from($tableArray[$o_type] . " as D");
        $this->db->join($this->assign_date . " as AD", "D.id=AD.diagnose_id", "left");
        $this->db->join($this->order . " as O", "O.id=D.order_id", 'left');
        $this->db->join($this->users . " as U", "AD.manager_id=U.id", 'left');
        $this->db->join($this->users . " as U1", "O.client_id=U1.id", 'left');
        $this->db->join($this->pro . ' as P', 'D.products=P.id', 'left');
        $this->db->join($this->subproducts . ' as SP', 'D.subproducts=SP.id', 'left');

        //$this->db->where('D.id', $ids);
        $this->db->where('AD.diagnose_id', $ids);
        $this->db->where('AD.del_status', '0');
        $this->db->where('U.id', $managerid);
        //$this->db->group_by('D.id');
        $query = $this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;
    }


    public function checkRestrictedDateTime($startdttime = '', $enddttime = '', $mgid = 0,$dvyid=0) {
        //echo "###<pre>";print_r($managerid.' '.$startdate.' '.$starttime);die;
        $this->db->select('manager_id,tstartdatetime,tenddatetime');
        $this->db->from($this->assign_date);
        $this->db->where(array('tstartdatetime' => $startdttime,
            'tenddatetime' => $enddttime
                )
        );
        $query = $this->db->get()->result();
        //echo "<pre>22";print_r($this->db->last_query());die;
        $resultoftime = $this->getStartDateEndDate($mgid,$dvyid);
        $resourcebusyflage = 0;
        foreach ($resultoftime as $datevalue) {
            if (($startdttime >= $datevalue->tstartdatetime) && ($startdttime <= $datevalue->tenddatetime))
                $resourcebusyflage = 1;
            if (($enddttime >= $datevalue->tstartdatetime) && ($enddttime <= $datevalue->tenddatetime))
                $resourcebusyflage = 1;
        }
        if ($resourcebusyflage == 0)
            return false;
        else
            return true;

        //return $query;
    }

    public function getStartDateEndDate($managerid,$dvyid) {
        //echo "###<pre>";print_r($managerid.' '.$startdate.' '.$starttime);die;
        $this->db->select('manager_id,tstartdatetime,tenddatetime');
        $this->db->from($this->assign_date);
        $this->db->where(array('manager_id' => $managerid
                //,'diagnose_id'=>$dvyid
                )
        );
        $this->db->where('status != ',2,FALSE);
        $this->db->where('del_status=',0,FALSE);
        $query = $this->db->get()->result();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;
    }

    public function deletedata($id = '', $oid = '') {
        $this->db->where(array('order_id' => $id, 'id' => $oid));
        $this->db->delete($this->name);
        return true;
    }
   public function getCallUserEmail($oid='0',$did='0')
    {
        $this->db->select('U.id,U.email');
        $this->db->from($this->name_delivery . " as D");
        $this->db->join($this->usermap . " as UM",'D.id=UM.delivery_id');
        $this->db->join($this->users . " as U",'U.id=UM.user_id');
        $this->db->where(array('D.order_id'=>$oid,'D.id'=>$did));
        $query = $this->db->get()->result();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;

    }

    public function showDiagnoseManager($id = '', $subid = '') {
        $this->db->select('*');
        $this->db->from($this->noofcast);
        //$this->db->join(
        $this->db->where(array('diagnose_id' => $id));
        $query = $this->db->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function getDiagnoseStartEndDate($diagnoseid) {
        $this->db->select('D.start_date,D.end_date');
        $this->db->from($this->name . ' as D');
        $this->db->where('D.id', $diagnoseid);
        $query = $this->db->get()->row();
        //echo "<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function addAssignDate($data = array()) {
        //echo"###<pre>";print_r($data);die;
        $this->db->save($this->assign_date, $data);
        //echo "@@@@@<pre>";print_r($this->db->last_query());die;
        return $this->db->insert_id();
    }

    public function getDiagonoesDetail($oid = '') {
        $this->db->select('DG.*,P.name as product,SB.name');
        $this->db->from($this->name . " as DG");
        $this->db->join($this->subproducts . ' as SB', "SB.id=DG.subproducts", "LEFT");
        $this->db->join($this->pro . ' as P', "P.id=DG.products");
        $this->db->where(array('DG.order_id' => $oid, 'P.product_type' => '1'));
        $this->db->group_by('DG.id');
        $query = $this->db->get()->result();
        return $query;
    }

    public function getCalenderDetails($did, $mid) {
        $this->db->select('*');
        $this->db->from($this->assign_date);
        $this->db->where(array('diagnose_id' => $did, 'manager_id' => $mid,'del_status'=>0));
        $query = $this->db->get()->result();
        return $query;
    }

    public function getCommentPopUp($ids = 0, $order_type = 0) {
        $this->db->select('AD.comment', false);
        $this->db->from($this->assign_date . " as AD");
        $this->db->join($this->users . " as U", "U.id=D.manager_id", 'left');
        $this->db->where('AD.id', $ids);
        $query = $this->db->get()->row();
        //echo "<pre>22";print_r($this->db->last_query());die;
        return $query;
    }

    public function getDiagonoesResources($oid = '') {
        $this->db->select('DG.id,US.name as resources');
        $this->db->from($this->name . " as DG");
        $this->db->join($this->noofcast . ' as C', "C.diagnose_id=DG.id", "LEFT");
        $this->db->join($this->users . ' as US', "US.id=C.casting_manager", "LEFT");
        $this->db->where(array('DG.order_id' => $oid, 'C.type' => '1', 'US.user_type' => 'CM'));

        $query = $this->db->get()->result();
        return $query;
    }

    public function saveTrfInfo($data = array()) {
        //echo "!!!!!!1@@<pre>";print_r($data);die;
        $query = $this->db->save($this->trf_info, $data);
        // echo "!!!!!!1@@<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    public function updateTrfInfo($data = array(), $id = '') {
        unset($data['ids']);
        return $this->db->save($this->trf_info, $data, array('id' => $id));
    }

    public function getResourceDetails($order_id = '', $diagnose_id = '', $user_id = '') {
        $query = $this->db->select('TI.*,PA.name as airname')
                        ->from($this->trf_info . ' as TI')
                        ->join($this->trf_preferdairlince . ' as PA', 'PA.id=TI.preferred', 'left')
                        //->group_by('mode')->order_by('PA.name','asc')
                        ->where(array('TI.order_id' => $order_id, 'TI.diagnose_id' => $diagnose_id, 'TI.user_id' => $user_id))
                        ->order_by('TI.mode')
                        ->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die; 
        return $query;
    }

    //public function getResourcesById($data=array(),$id)
    public function getResourcesById($data = array()) {

        $query = $this->db->select('TI.*,TP.name as air')
                        ->from($this->trf_info . ' as TI')
                        ->join($this->trf_preferdairlince . ' as TP', 'TI.preferred=TP.id', left)
                        ->where($data)
                        //->where('TI.id',$id['id'])
                        ->order_by("mode", "asc")
                        //->get()->row();
                        ->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die; 
        return $query;
    }
    
    //public function getResourcesById($data=array(),$id)
    public function getTRFById($id) {

        $query = $this->db->select('TI.*,TP.name as air')
                        ->from($this->trf_info . ' as TI')
                        ->join($this->trf_preferdairlince . ' as TP', 'TI.preferred=TP.id', left)
                        ->where('TI.id',$id)
                        //->where('TI.id',$id['id'])
                        //->order_by("mode", "asc")
                        ->get()->row();
                        //->get()->result();
        //echo "<pre>";print_r($this->db->last_query());die; 
        return $query;
    }

    public function getResourceInfoById($id = '') {
        $query = $this->db->select('TRI.*,TRP.name')
                        ->from($this->trf_info . ' as TRI')
                        ->join($this->trf_preferdairlince . ' as TRP', 'TRI.preferred=TRP.id', 'left')
                        ->where(array('TRI.id' => $id))
                        ->get()->row();
        //echo $this->db->last_query();die;
        return $query;
    }

    public function getTravel() {
        $query = $this->db->select('*')
                        ->from($this->trf_preferdairlince)
                        ->get()->result();
        //echo $this->db->last_query();die;
        return $query;
    }

    public function deleteResources($id = '') {
        return $this->db->where(array('id' => $id))->delete($this->trf_info);
    }

    public function getdetailsById($id = '') {
        //$data=$query= $this->db->select('*')->from($this->membershipdetail)->where(array('id'=>$id))->get()->row();  

        $this->db->select('U.name,U.register_date,U.email,M.detail,M.name as membershipname');
        $this->db->from($this->users . ' as U');
        $this->db->where('U.id', $id);
        $this->db->join($this->membershipdetail . ' as M', 'U.id=M.user_id', left);
        //$this->db->order_by("M.name","asc");
        $query = $this->db->get()->result();
        //echo "<pre>";print_r($query);die;
        //echo "@@@@@<pre>";print_r($this->db->last_query());die;
        return $query;
    }

    function trfAllRecords($where) {
        //echo "<pre>modal";print_r($where);die;
        $query = $this->db->select('TRI.*,TRP.name as preferred');
        $this->db->from($this->trf_info . ' as TRI');
        $this->db->join($this->trf_preferdairlince . ' as TRP', 'TRI.preferred=TRP.id', 'left');
        $this->db->where('TRI.id', $where['id']);
        $this->db->where('TRI.user_id', $where['uid']);

        $query = $this->db->get()->row();
        //echo "<pre>modal";print_r($this->db->last_query());die;
        return $query;
    }

}
