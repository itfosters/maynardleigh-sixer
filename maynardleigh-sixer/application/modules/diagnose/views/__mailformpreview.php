<?php //echo "<pre>";print_r($frm_data);die; ?>
<div>
    <?php $id = isset($frmdata["subdelvid"]->id) ? $frmdata["subdelvid"]->id : ''; ?>
    <?php //echo form_open('delivary/insert/'.$subdelvid->id.'/'.$subdelvid->order_id);?>
<?php 
    //echo form_open();
    echo form_open_multipart();

        $data=array('name'=>'oid','value'=>$frm_data['order_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'digid','value'=>$frm_data['diagnose_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'user_id','value'=>$frm_data['user_id'],'class'=>'hidden');
        echo form_input($data);
        $data=array('name'=>'user_email_id','value'=>$userDetails[0]->email,'class'=>'hidden');
        echo form_input($data);
?>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Client:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'client_name',
                'class' => 'gui-input form-control',
                'placeholder' => 'Client Name',
                'value' => isset($frm_data["order_detail"]->client_name) ? $frm_data["order_detail"]->client_name : "",
                'id' => 'client_name'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Course:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'course',
                'class' => 'gui-input form-control',
                'placeholder' => 'Course Name',
                'value' => isset($frm_data["diagnose_detail"]->product) ? $frm_data["diagnose_detail"]->product." / ".$frm_data["diagnose_detail"]->name : "",
                'id' => 'course'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Workshop Date:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $sessionstartdate = date('jS F, Y',$time_detail[0]->tstartdatetime);
            $sessionenddate = date('jS F, Y',$time_detail[0]->tenddatetime);
            if($sessionstartdate !=   $sessionenddate){
               $showdate = $sessionstartdate." - ".$sessionenddate; 
            }else
               $showdate = $sessionstartdate;  
            $data = array('name' => 'workshopdate',
                'class' => 'gui-input form-control',
                'placeholder' => 'Date',
                //'value' => isset($diagnose_detail->start_date) ? date('jS F, Y', strtotime($diagnose_detail->start_date)) : '',
                'value' => $showdate,
                'id' => 'workshopdate'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Workshop Time:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'workshop_time',
                'class' => 'gui-input form-control',
                'placeholder' => 'Workshop Time',
                'value' =>  date('h:i A',$time_detail[0]->tstartdatetime)." - ".date('h:i A',$time_detail[0]->tenddatetime),
                'id' => 'workshop_time'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Leader:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'leader',
                'class' => 'gui-input form-control',
                'placeholder' => 'Leader',
                'value' =>  isset($userDetails[0]->name) ? $userDetails[0]->name : '',
                'id' => 'leader'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Arrival Time of Leader at Venue:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'leader_arrival',
                'class' => 'gui-input form-control',
                'placeholder' => 'Arrival time of Leader at Venue',
                'value' =>  date("h:i A", strtotime("-90 minutes",$time_detail[0]->tstartdatetime)),
                'id' => 'leader_arrival'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Training Venue:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'venue',
                'class' => 'gui-input form-control',
                'placeholder' => 'Training Venue',
                'value'=>isset($allmode['Venue'][0]->venuedetail) ? $allmode['Venue'][0]->venuedetail : 'N/A',
                'id' => 'venue'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Accommodation:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'accommodation',
                'class' => 'gui-input form-control',
                'placeholder' => 'Training Venue',
                'value'=>isset($allmode['Hotel'][0]->description) ? $allmode['Hotel'][0]->description." (".$allmode['Hotel'][0]->city.", ".date('jS F', strtotime($allmode['Hotel'][0]->checkin_date))."-".date('jS F', strtotime($allmode['Hotel'][0]->checkout_date)).")" : 'N/A',
                'id' => 'accommodation'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Room Layout:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'roomlayout',
                'class' => 'gui-input form-control',
                'placeholder' => 'Room Layout',
                'id' => 'roomlayout'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>No. of Participants:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'no_of_participant',
                'class' => 'gui-input form-control',
                'value' => isset($diagnose_detail->pax) ? $diagnose_detail->pax : '',
                'placeholder' => 'No. of Participants:',
                'id' => 'no_of_participant'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Participant List:</label>
        </div>
        <div class="form-group col-md-4">
            
            <div id="file_browse_wrapper1">
             <input type="file" id="participant_list" name='participant_list' multiple="multiple">
            </div>
        </div>
        <div class="form-group col-md-5">
            <input type="button" name="browseclear" value="Clear" class="clear">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>VMS:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'vms',
                'class' => 'gui-input form-control',
                'placeholder' => 'VMS',
                'id' => 'vms'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Handouts:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'handouts',
                'class' => 'gui-input form-control',
                'placeholder' => 'handouts',
                'id' => 'time'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <!-- Air start -->
    <?php if(isset($allmode['air']) and count($allmode['air'])>0){ ?>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Air:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $airvalue='';
            foreach ($allmode['air'] as $airinfo) {
             $airvalue.= date('jS F, Y', strtotime($airinfo->journey_date))." ". $airinfo->journey_from." - " .$airinfo->journey_destination. "(".$airinfo->description.")"; 
             if(!empty($airinfo->return_date)){
                 $airvalue.="<br>";
                 $airvalue.= date('jS F, Y', strtotime($airinfo->return_date))." ". $airinfo->journey_destination." - " .$airinfo->journey_from. "(".$airinfo->description.")";
                 
             }
             $airvalue.="<br>";
            }
            
            $data = array('name' => 'air',
                'class' => 'gui-input form-control',
                'placeholder' => 'Air',
                'value'=>$airvalue,
                'id' => 'air',
                'rows'=> '5',
                'cols' => '10'  
            );
            echo form_textarea($data);
            ?>
            <div id="file_browse_wrapper1">
            Attach Ticket <input type="file" id="air_ticket" name='air_ticket' multiple="multiple">
            </div><span><input type="button" name="airclear" value="Clear" class="clear"></span>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <!-- Air end  -->
    <?php } ?>
    
    <!-- Train start -->
    <?php if(isset($allmode['train']) and count($allmode['train'])>0){ ?>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Train:</label>
        </div>
        <div class="form-group col-md-6">
            <?php
            $trainvalue='';
            foreach($allmode['train'] as $traininfo) {
             $trainvalue.= date('jS F, Y', strtotime($traininfo->journey_date)).$traininfo->journey_from." - " .$traininfo->journey_destination. "(".$traininfo->description.")"; 
             if(!empty($traininfo->return_date)){
                 $trainvalue.="<br>";
                 $trainvalue.= date('jS F, Y', strtotime($traininfo->return_date))." ".$traininfo->journey_destination." - " .$traininfo->journey_from. "(".$traininfo->description.")"; 
             }
             $trainvalue.="<br>";
            }
            
            $data = array('name' => 'train',
                'class' => 'gui-input form-control',
                'placeholder' => 'train',
                'value'=>$trainvalue,
                'id' => 'train',
                'rows'=> '5',
                'cols' => '10'  
            );
            echo form_textarea($data);
            ?>
            
            <div id="file_browse_wrapper1">
            Attach Ticket <input type="file" id="train_ticket" name='train_ticket' multiple="multiple">
            </div><span><input type="button" name="trainclear" value="Clear" class="clear"></span>
            
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <!-- Train end -->
    <?php } ?>
    
    
    <!-- Cab start -->
    <?php if(isset($allmode['cab']) and count($allmode['cab'])>0){ ?>
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Cab:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            
            $all=count($allmode['cab']);
            $cabvalue = "";
            foreach ($allmode['cab'] as $cabinfo) {
                 $cabvalue.= date('jS F', ($cabinfo->journey_date)) . " ".($cabinfo->journey_from)."-".($cabinfo->journey_destination)." (".$cabinfo->description.")"."<br>";
            }
            
            $data = array('name' => 'cab',
                'class' => 'gui-input form-control',
                'placeholder' => 'Cab',
                'value'=>$cabvalue,
                'id' => 'cab',
                'rows'=> '5',
                'cols' => '10'  
            );
            echo form_textarea($data);
            ?>
            <div id="file_browse_wrapper1">
            Attach Ticket <input type="file" id="cab_ticket" name='cab_ticket'>
            </div>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    <?php } ?>
    <!-- Cab end -->
    
    
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label>Contact Person:</label>
        </div>
        <div class="form-group col-md-6">
            
            <?php
            $data = array('name' => 'contact_person',
                'class' => 'gui-input form-control',
                'placeholder' => 'Contact No',
                //'value'=> isset($userDetails[0]->contact_no) ? $userDetails[0]->name." / ".$userDetails[0]->contact_no : '',
                'value'=> ((isset($frm_data["order_detail"]->co_ordinator)) && (!empty($frm_data["order_detail"]->co_ordinator))) ? $frm_data["order_detail"]->co_ordinator." / ".$frm_data["order_detail"]->email_co_ordinator." / ".$frm_data["order_detail"]->contact_no_co_ordinator : 'Not Available',
                'id' => 'contact_person'
            );
            echo form_input($data);
            ?>
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group col-md-3">
            <label><?php
echo form_submit('Submit', 'Send Email', 'class="btn btn-primary"');
?></label>
        </div>
        <div class="form-group col-md-6">
            
        </div>
        <div class="form-group col-md-3"></div>
    </div>
    
    
    <div class="clearfix"></div>

<?php echo form_close(); ?>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.clear').click(function(){
            $('input[type=file]').val('');
        })
    })


</script>