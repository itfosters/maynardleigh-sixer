<script type="text/javascript">
    $(document).ready(function () {
        $( "#samebillingaddress" ).click(function() {
            if($(this). prop("checked") == true){
                $('#samebillingaddress').val('1');
                $('input[placeholder="Street"]').eq(0).val($('#street').val());
                $('input[placeholder="Location"]').eq(1).val($('#location').val())
                $('input[placeholder="State"]').eq(1).val($('#state').val())
                $('input[placeholder="City"]').eq(1).val($('#city').val())
                $('input[placeholder="Pin Code"]').eq(1).val($('#pincode').val())
                $('input[placeholder="GSTIN No."]').eq(1).val($('#cgstinno').val())
            }
            else{
                 $('#samebillingaddress').val('0');
                $('input[placeholder="Street"]').eq(0).val('');
                $('input[placeholder="Location"]').eq(1).val('')
                $('input[placeholder="State"]').eq(1).val('')
                $('input[placeholder="City"]').eq(1).val('')
                $('input[placeholder="Pin Code"]').eq(1).val('')
                $('input[placeholder="GSTIN No."]').eq(1).val('')

            }
        });
        
    // $("#contact_no").mask("+999-99999999");
    });</script>
<div>
</div>
<div class="row"  ng-controller="MainCtrl">
    <?php $id = isset($frm_data['view']->id) ? $frm_data['view']->id : ''; ?>
    <?php //echo "@@<pre>";print_r($frm_data);die; ?>
    <?php echo form_open('admin/client/form' . '/' . $id); ?>
    <div class="col-md-6">
        <div class="form-group">
            <label> Name* </label>

            <?php
            $data = array(
                'name' => 'name',
                'class' => 'form-control',
                'placeholder' => 'Client Name',
                'value' => isset($frm_data['view']->name) ? $frm_data['view']->name : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('name'); ?>    
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Email Id* </label>
            <?php
            if (!empty($id)) {
                ?> 
                <?php
                $data = array(
                    'name' => 'email',
                    'class' => 'form-control',
                    'readonly' => 'true',
                    'value' => isset($frm_data['view']->email) ? $frm_data['view']->email : ''
                );
                echo form_input($data);
                ?>
                <?php echo form_error('email'); ?>  
                <?php
            } else {
                $data = array(
                    'name' => 'email',
                    'class' => 'form-control',
                    'placeholder' => 'Email Id',
                    'value' => isset($frm_data['view']->email) ? $frm_data['view']->email : ''
                );
                echo form_input($data);
                echo form_error('email');
            }
            ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Contact No * </label>
            <?php
            $data = array(
                'name' => 'contact_no',
                'class' => 'form-control',
                'id' => 'contact_no',
                'placeholder' => '+011-99999999',
                'value' => isset($frm_data['view']->contact_no) ? $frm_data['view']->contact_no : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('contact_no'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Street/Plot No * </label>

            <?php
            $data = array(
                'name' => 'street',
                'id' => 'street',
                'class' => 'form-control',
                'placeholder' => 'Street/Plot No',
                'value' => isset($frm_data['view']->street) ? $frm_data['view']->street : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('street'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Location * </label>

            <?php
            $data = array(
                'name' => 'location',
                'id' => 'location',
                'class' => 'form-control',
                'placeholder' => 'Location',
                'value' => isset($frm_data['view']->location) ? $frm_data['view']->location : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('location'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> City * </label>

            <?php
            $data = array(
                'name' => 'city',
                'id' => 'city',
                'class' => 'form-control',
                'placeholder' => 'City',
                'value' => isset($frm_data['view']->city) ? $frm_data['view']->city : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('city'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> State * </label>

            <?php
            $data = array(
                'name' => 'state',
                'id' => 'state',
                'class' => 'form-control',
                'placeholder' => 'State',
                'value' => isset($frm_data['view']->state) ? $frm_data['view']->state : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('state'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Pin Code * </label>

            <?php
            $data = array(
                'name' => 'pincode',
                'id' => 'pincode',
                'class' => 'form-control',
                'placeholder' => 'Pin Code',
                'value' => isset($frm_data['view']->pincode) ? $frm_data['view']->pincode : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('pincode'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> UIN No </label>

            <?php
            $data = array(
                'name' => 'uinno',
                'class' => 'form-control',
                'placeholder' => 'UIN No',
                'value' => isset($frm_data['view']->uinno) ? $frm_data['view']->uinno : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('uinno'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> PAN No. </label>

            <?php
            $data = array(
                'name' => 'panno',
                'class' => 'form-control',
                'placeholder' => 'PAN No.',
                'value' => isset($frm_data['view']->panno) ? $frm_data['view']->panno : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('panno'); ?>  
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label> GSTIN No. </label>

            <?php
            $data = array(
                'name' => 'cgstinno',
                'class' => 'form-control',
                'id' => 'cgstinno',                
                'placeholder' => 'GSTIN No.',
                'value' => isset($frm_data['view']->cgstinno) ? $frm_data['view']->cgstinno : ''
            );
            echo form_input($data);
            ?>
            <?php echo form_error('cgstinno'); ?>  
        </div>
    </div>
    <div class="col-md-6">
        
    </div>
    
    




    <div>
        <h4>Billing Address</h4> (Same as main Address) <input type="checkbox" name="samebillingaddress" id="samebillingaddress" value="0"<?php  if(isset($frm_data['view']->samebillingaddress) and ($frm_data['view']->samebillingaddress== '1')){ echo "checked='checked'";} ?> />
        

        <div >
            <fieldset  data-ng-repeat="choice in choices">
                <?php
                $data = array(
                    'name' => 'bstreet[]',
                    'placeholder' => 'Street',
                    'value' => '{{choice.street}}'
                    
                        //'value' => 
                );
                echo form_input($data);
                ?>
                <?php //echo form_error('street'); ?>   
                <?php
                $data = array(
                    'name' => 'blocation[]',
                    'placeholder' => 'Location',
                    'value' => '{{choice.location}}'
                );
                echo form_input($data);
                ?>

                <?php
                $data = array(
                    'name' => 'bstate[]',
                    'placeholder' => 'State',
                    'value' => '{{choice.state}}'
                );
                echo form_input($data);
                ?>



                <?php
                $data = array(
                    'name' => 'bcity[]',
                    'placeholder' => 'City',
                    'value' => '{{choice.city}}'
                );
                echo form_input($data);
                ?>

                <?php
                /*
                $data = array(
                    'name' => 'bcountry[]',
                    'placeholder' => 'Country',
                    'value' => '{{choice.country}}'
                );
                echo form_input($data);
                */
                ?>

                <?php
                $data = array(
                    'name' => 'bpincode[]',
                    'placeholder' => 'Pin Code',
                    'value' => '{{choice.pincode}}',
                    'style'=> 'width: 100px;',
                );
                echo form_input($data);
                ?>
                
                <input name="bgstinno[]" placeholder="GSTIN No." value="{{choice.gstinno}}"  type="text" maxlength="15" minlength='15' required></input>
                <?php
               /* $data = array(
                    'name' => 'bgstinno[]',
                    'placeholder' => 'GSTIN No',
                    'value' => '{{choice.gstinno}}',
                    'minlength'=>"15",
                    'maxlength'=>"15"
                );*/
                //echo form_input($data);
                ?>

                <button class="remove" ng-show="$last" ng-click="removeChoice()">-</button>
            </fieldset>
            <input class="addfields" type="button" ng-click="addNewChoice()" value="Add Address" />
        </div>




        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group">
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <div class="col-md-6">

        <ng-submit ng-submit="expression">
            <div class="form-group">
                <?php
                $data = array('value' => 'Submit',
                    'class' => 'btn btn-primary',
                    'name' => 'submit'
                );
                //echo form_submit($data);
                ?>
                <button type="submit" ng-disabled="loginform.$invalid">Submit</button>
            </div>
        </ng-submit>
    </div>
    <div class="col-md-6">
        <div class="form-group">

        </div>
    </div>

    <?php //echo form_submit(array('id' => 'update', 'value' => 'Update','name'=>'update')); ?>
    <?php //echo form_submit(array('id' => 'delete', 'value' => 'Delete','name'=>'delete'));  ?>
<?php echo form_close(); ?>

</div>

<style type="text/css">
    .error {
        color:red;
        font-size:13px;
        margin-bottom:-15px
    }</style>


<style>
    fieldset{
        background: #FCFCFC;
        padding: 16px;
        border: 1px solid #D5D5D5;
    }
    .addfields{
        margin: 10px 0;
    }

    #choicesDisplay {
        padding: 10px;
        background: rgb(227, 250, 227);
        border: 1px solid rgb(171, 239, 171);
        color: rgb(9, 56, 9);
    }
    .remove{
        background: #C76868;
        color: #FFF;
        font-weight: bold;
        font-size: 24px;
        border: 0;
        cursor: pointer;
        display: inline-block;
        padding: 4px 9px;
        vertical-align: top;
        line-height: 100%;   
    }
    input[type="text"],
    select{
        padding:5px;
    }
</style>
<script>
    
    app.controller('MainCtrl', function($scope) {
        //$scope.choices = [{id: 'choice1'}];
        $scope.choices = <?php echo isset($frm_data['billing']) ? json_encode($frm_data['billing']) : "[{id: 'choice1'}]"; ?>;
        //console.log($scope.choices.length);
        $scope.addNewChoice = function() {

        var newItemNo = $scope.choices.length + 1;
        $scope.choices.push({'id':'choice' + newItemNo});
        };
        $scope.removeChoice = function() {
        var lastItem = $scope.choices.length - 1;
        $scope.choices.splice(lastItem);
        };
        
    });
    
    
    
    
</script>