<?php
//echo "&&&&&<pre>";print_r($frmdata['selecteddeliveredproduct']);die;
//if(isset($frmdata['dlvproduct']->name))
//$proname=(array)$frmdata['dlvproduct'];
//echo "$$$$$$$<pre>";print_r($frmdata);die;
//$proname=explode(',', $frmdata['dlvproduct']->name);
//$array_of_call = array(99,98,97,93,86,27,25,23,22,21,20);
$array_of_call = $frmdata['calalyst_call_product'];
//echo "<pre>";print_r($array_of_call);die;

$proname = array();
/* $noofcasting=array('1'=>'1',
  '2'=>'2',
  '3'=>'3',
  '4'=>'4',
  '5'=>'5'); */
$noofcasting = range(0, 20);

//echo "$$$$$$$<pre>";print_r($frmdata["subdelvid"]);die;
?>

<div>
    <?php $id = isset($frmdata["subdelvid"]->id) ? $frmdata["subdelvid"]->id : ''; ?>
    <?php //echo form_open('delivary/insert/'.$subdelvid->id.'/'.$subdelvid->order_id);?>
<?php echo form_open(); ?>
    <input type="hidden" name="pagevalue" value="<?php echo isset($frmdata['page'])?$frmdata['pagevalue']:''; ?>">
    <div class="col-md-6">
        <div class="form-group">
            <label>Products</label>
            <?php //echo "<pre>";print_r($frmdata['product']);die;?>
<?php echo form_dropdown('dvproducts', $frmdata['product'], isset($frmdata["subdelvid"]->products) ? $frmdata["subdelvid"]->products : "", 'class="form-control" id="name_of_products"'); ?>
        <?php echo form_error('dvproducts'); ?></div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Sub-Products:</label>
<?php echo form_dropdown('dsubproducts', $frmdata['subproducts'], isset($frmdata['subdelvid']->subproducts) ? $frmdata['subdelvid']->subproducts : "", 'class="form-control" id="name_of_subproducts"'); ?>
        <?php echo form_error('dsubproducts'); ?>
        </div>

    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Delivery-Products:</label>
            <?php
            if (isset($frmdata['allProductsSelectOption'])) {
                $alloption = $frmdata['allProductsSelectOption'];
                $selectedOption = $frmdata['selecteddeliveredproduct'];
                echo form_dropdown('ddlvproducts[]', $alloption, $selectedOption, 'multiple="multiple" class="selectpicker fixed form-control" id="name_of_dlvproducts"');
            } else {
                echo form_dropdown('ddlvproducts[]', $proname, isset($frmdata['selecteddeliveredproduct']) ? $frmdata['selecteddeliveredproduct'] : array(), 'class="form-control selectpicker" id="name_of_dlvproducts" multiple="multiple"');
            }
            ?> </div>

    </div>

    <!--<div class="col-md-6" style='display:none' id='intime'>
      <div class="form-group">
        <label>Interval Time:</label>
    <?php
    $data = array('name' => 'intervaltime',
        'class' => 'form-control',
        'id' => 'intervaltime'
    );
    echo form_input($data);
    ?> <?php echo form_error('intervaltime'); ?>
         </div>
    
    </div>-->




    <div class="col-md-6">
        <div class="form-group">
            <label>Weight<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvweight',
                'id' => 'weight',
                'class' => 'gui-input form-control',
                'placeholder' => 'Weight',
                'value' => isset($frmdata["subdelvid"]->weight) ? $frmdata["subdelvid"]->weight : ''
            );
            echo form_input($data);
            ?><?php echo form_error('dvweight'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Units</label>
            <?php
            $data = array('name' => 'dvunits',
                'class' => 'gui-input form-control',
                'placeholder' => 'Units',
                'value' => isset($frmdata["subdelvid"]->units) ? $frmdata["subdelvid"]->units : "",
                'id' => 'no_of_units'
            );
            echo form_input($data);
            ?><?php echo form_error('dvunits'); ?>
        </div>
    </div>   

    <div class="col-md-6">
        <div class="form-group">
            <label> Pax<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvpax',
                'id' => 'pax',
                'class' => 'gui-input form-control',
                'placeholder' => 'Pax',
                'value' => isset($frmdata["subdelvid"]->pax) ? $frmdata["subdelvid"]->pax : ''
            );
            echo form_input($data);
            ?><?php echo form_error('dvpax'); ?>
        </div>
    </div>
    <!-- <div class="col-md-6">
       <div class="form-group">
          <label> Resources</label>
<?php //echo "$$$$$$$<pre>";print_r($frmdata["subdelvid"]->no_ofcasting);die; ?>
<?php echo form_dropdown('dvnocasting[]', $frmdata['castingmanager'], isset($frmdata['selectedmangers']) ? $frmdata['selectedmangers'] : array(), ' multiple="multiple" class="selectpicker form-control" id="no_of_casting"'); ?> 
<?php echo form_error('dvnocasting'); ?>
       </div>
    </div> -->

    <div class="col-md-6">
        <div class="form-group">
            <label> Start Date<span class="red_text">*</span>

                &nbsp;Not Confirm&nbsp;<?php
                $flag = isset($frmdata["subdelvid"]->notconfirmed) && $frmdata["subdelvid"]->notconfirmed == 1 ? TRUE : FALSE;
                $data1 = array(
                    'name' => 'notconfirmed',
                    'id' => 'notconfirmed',
                    'value' => '1',
                    'checked' => $flag,
                    //'style' => 'margin:10px'
                );

                echo form_checkbox($data1);
                ?>
            </label>
            <?php
            $data = array('name' => 'dvstartdate',
                'class' => 'gui-input form-control datepicker',
                'placeholder' => 'Start Date',
                'value' => isset($frmdata["subdelvid"]->start_date) ? $frmdata["subdelvid"]->start_date : '',
                'id' => 'startdt'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> End Date<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvenddate',
                'class' => 'gui-input datepicker form-control',
                'placeholder' => 'End Date',
                'value' => isset($frmdata["subdelvid"]->end_date) ? $frmdata["subdelvid"]->end_date : '',
                'id' => 'enddt'
            );
            echo form_input($data);
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Days<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvnoofdays',
                'class' => 'gui-input form-control',
                'placeholder' => 'No Of Days',
                'value' => isset($frmdata["subdelvid"]->no_ofdays) ? $frmdata["subdelvid"]->no_ofdays : "",
                'id' => 'noofdays'
            );
            echo form_input($data);
            ?><?php echo form_error('dvynoofdays'); ?>
        </div>
    </div>  

    <div class="col-md-6">
        <div class="form-group">
            <label>No.Of Consultants</label>
            <?php echo form_dropdown('dvcunsulting', $noofcasting, isset($frmdata["subdelvid"]->cunsulting_days) ? $frmdata["subdelvid"]->cunsulting_days : "", 'class="form-control" id="cunsulting_days"'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Location<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvlocation',
                'class' => 'gui-input form-control',
                'placeholder' => 'Location',
                'value' => isset($frmdata["subdelvid"]->location) ? $frmdata["subdelvid"]->location : ''
            );
            echo form_input($data);
            ?><?php echo form_error('dvlocation'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Price Per Unit<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'dvpriceandunit',
                'class' => 'gui-input form-control',
                'placeholder' => 'Price and Unit',
                'id' => 'price',
                'value' => isset($frmdata["subdelvid"]->price_unit) ? $frmdata["subdelvid"]->price_unit : ''
            );
            echo form_input($data);
            ?><?php echo form_error('dvpriceandunit'); ?>
        </div>
    </div>
<!--    <div class="col-md-6">
        <div class="form-group">
            <label> Co-Ordinator<span class="red_text">*</span></label>
<?php
$data = array('name' => 'dvcoordinator',
    'class' => 'gui-input form-control',
    'placeholder' => 'Co-ordinator',
    'value' => isset($frmdata["subdelvid"]->coordinator) ? $frmdata["subdelvid"]->coordinator : ''
);
echo form_input($data);
?><?php echo form_error('dvcoordinator'); ?>
        </div>
    </div>-->

<!--    <div class="col-md-6">
        <div class="form-group">
            <label> Email<span class="red_text">*</span></label>
<?php
$data = array('name' => 'dvemail',
    'class' => 'gui-input form-control',
    'placeholder' => 'Email',
    'value' => isset($frmdata["subdelvid"]->email_id) ? $frmdata["subdelvid"]->email_id : ''
);
echo form_input($data);
?> <?php echo form_error('dvemail'); ?>
        </div>
    </div>-->
<!--    <div class="col-md-6">
        <div class="form-group">
            <label>Contact No<span class="red_text">*</span></label>
<?php
$data = array('name' => 'dvcontact',
    'class' => 'gui-input form-control',
    'placeholder' => 'Contact No',
    'value' => isset($frmdata["subdelvid"]->contact) ? $frmdata["subdelvid"]->contact : ''
);
echo form_input($data);
?>  <?php echo form_error('dvcontact'); ?>
        </div>
    </div>-->
    <div class="clearfix"></div>

    
    <div id="catalyst_call_system">
    
    
    <div class="col-md-3">
        <div class="form-group">
            <label> Lunch Start<span class="red_text">*</span> </label>
<?php
$data = array('name' => 'lunchstarttime',
    'class' => 'gui-input form-control',
    'placeholder' => 'Lunch Start',
    'id' => 'lunchstarttime',
    'value' => isset($frmdata["subdelvid"]->lunchstarttime) ? $frmdata["subdelvid"]->lunchstarttime : ''
);
echo form_input($data);
?> <?php echo form_error('lunchstarttime'); ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Lunch End<span class="red_text">*</span></label>
            <?php
            $data = array('name' => 'lunchendtime',
                'class' => 'gui-input form-control',
                'placeholder' => 'Lunch End',
                'id' => 'lunchendtime',
                'value' => isset($frmdata["subdelvid"]->lunchendtime) ? $frmdata["subdelvid"]->lunchendtime : ''
            );
            echo form_input($data);
            ?>  <?php echo form_error('lunchendtime'); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Call Intervals in Minutes<span class="red_text">*</span></label>
        <?php
        $data = array('name' => 'intervaltime',
            'class' => 'gui-input form-control',
            'placeholder' => 'eg 10,20,30',
            'id' => 'intervaltime',
            'value' => isset($frmdata["subdelvid"]->intervaltime) ? $frmdata["subdelvid"]->intervaltime : ''
        );
        echo form_input($data);
        ?>  <?php echo form_error('intervaltime'); ?>
        </div>
    </div>
    </div><!-- main Div for catalyst call -->
    <div class="clearfix"></div>

    <div class="col-md-6">
<?php
echo form_submit('Submit', 'Save', 'class="btn btn-primary"');
?>
    </div>
<?php echo form_close(); ?>

</div>
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" style="z-index:1000000000">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="z-index:1000000000">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $(".datepicker").datepicker({format: "yyyy-mm-dd"});
        
            
            
        // set default dates
        var start = new Date();
        // set end date to max one year period:
        var end = new Date(new Date().setYear(start.getFullYear()+1));

        $('#startdt').datepicker({
        startDate : start,
        endDate   : end
        // update "toDate" defaults whenever "fromDate" changes
        }).on('changeDate', function(){
        // set the "toDate" start to not be later than "fromDate" ends:
        $('#enddt').datepicker('setStartDate', new Date($(this).val()));
        }); 

        $('#enddt').datepicker({
        startDate : start,
        endDate   : end
        // update "fromDate" defaults whenever "toDate" changes
        })
//        .on('changeDate', function(){
//         set the "fromDate" end to not be later than "toDate" starts:
//        $('#startdt').datepicker('setEndDate', new Date($(this).val()));
//        });
            
            
    });
</script>
<style type="text/css">
    .error {
        color:red;
        font-size:13px;
        margin-bottom:-15px
    }</style>


<script>
    $(document).ready(function ()
    {
        var catalyst_call = '<?php echo json_encode($array_of_call);?>';
        //console.log(catalyst_call);
        
        $('#catalyst_call_system').hide();
        ids = $('#name_of_products').val();
        var indexofproduct = catalyst_call.indexOf(ids);
        //console.log(indexofproduct);
        //if((ids==28 || ids==29  || ids==20 || ids==21 || ids==22 || ids==27 || ids==25))   
        if(indexofproduct=='-1')
        {
           $('#catalyst_call_system').hide(); 
        }else{
           $('#catalyst_call_system').show();  
        }
        $(document).on('change', '#name_of_products', function ()
        {//alert('vfdtcgvyughbgh');

            var ids = $(this).val();
            var indexofproductrecent = catalyst_call.indexOf(ids);
            //console.log(indexofproductrecent);
            //28,29,20,21,22, 27, 25
            //if((ids==28 || ids==29  || ids==20 || ids==21 || ids==22 || ids==27 || ids==25))   
            if(indexofproductrecent=='-1')   
            {
               $('#catalyst_call_system').hide(); 
            }else{
               $('#catalyst_call_system').show();  
            }
            // alert(ids);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/delivery/getPriceByAjax'); ?>",
                dataType: 'json',
                data: {'ids': ids},
                before: function () {},
                success: function (res)
                {
                    $('#price').val(res.totalprice.proprice.price);
                    $('#weight').val(res.totalprice.proprice.weight);

                }
            });
        });
//$('#name_of_products').trigger('change');

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#pax').focusout(function () {
            var p = $(this).val();
            var w = $('#weight').val();
            if (p < w)
            {
                alert('Pax greater than weight ');
                $('#weight').focus();
            }
        });

        $('#enddt').change(function () {
            var dt1 = $('#startdt').val();
            var dt2 = $('#enddt').val();

            var date1 = new Date(dt1);
            var date2 = new Date(dt2);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime()) + 1;
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            $('#noofdays').val(diffDays);
        });

    });
</script>
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#name_of_subproducts').change(function ()
        {
            var dilevry = $('#name_of_subproducts').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/delivery/getProductByAjax'); ?>",
                dataType: 'json',
                data: {'ids': dilevry},
                success: function (res)
                {
                    //var data=
                    //console.log(res);
                    $('#name_of_dlvproducts').empty();
                    $.each(res, function (index, element) {

                        //var text=element.name;
                        //console.log(element.id);
                        //console.log(element.name);
                        $('#name_of_dlvproducts').append(
                                $('<option></option>').text(element.name).attr("value", element.id)
                                );
                    })
                    $('#name_of_dlvproducts').selectpicker('refresh');
                    $('#name_of_dlvproducts').selectpicker('selectAll');

                }
            })

        })
        $('#lunchstarttime').timepicker({'timeFormat': 'h:i A',
                                          'minTime': '1:00pm',
                                          'maxTime': '5:30pm'
                                          });
        $('#lunchendtime').timepicker({'timeFormat': 'h:i A',
                                        'minTime': '1:00pm',
                                        'maxTime': '5:30pm'
                                        });
        
        
    });
</script>