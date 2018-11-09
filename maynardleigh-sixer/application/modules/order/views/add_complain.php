<?php
//echo "fff<pre>";print_r($complainType);die;
//$complane=array('x','y','z');
//echo "<pre>";print_r($editdatavalue);die;
?>
<?php echo form_open(); //"welcome/index", array("id" => "search")   ?> 
<div class="row"  ng-controller="MainCtrl">
    <div class="col-md-12">
        <div class="form-group">
            <label for="cmp_title">VOC Type:</label>
            <!--    <input type="text" class="form-control" name="cmp_title" value="<?php //echo isset($cmp_title)?$cmp_title:'';?>" id="cmp_title">-->
            <?php
            echo form_dropdown('cmp_type', $complainType, isset($editdatavalue['data']->cmp_type) ? $editdatavalue['data']->cmp_type : '', 'class="form-control"');
            ?>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label for="cmp_desc">VOC Description:</label>
            <textarea name="cmp_desc" placeholder="Type Here" class="form-control" id="cmp_desc"><?php echo isset($editdatavalue['data']->cmp_desc) ? $editdatavalue['data']->cmp_desc : ''; ?></textarea>
        </div>
        <input type="hidden" name="orderID" value="<?php echo isset($ordId) ? $ordId : ''; ?>">
        <input type="hidden" name="cmp_id" value="<?php echo isset($cmp_id) ? $cmp_id : ''; ?>">
        <!--        <button type="submit" class="btn btn-primary detail">Submit</button>-->
    </div>
    
    <!---------------------------------------- Date value start ---------------------------------------->
    <hr>
     <div class="col-md-12">
        <label for="cmp_desc">Related to:</label>
      	<div class="input-group control-group">
           <?php 
           echo form_dropdown('relatedto[]', $allinnerorders, isset($editdatavalue['orderrelatedto'])?$editdatavalue['orderrelatedto']:array(), 'multiple="multiple" class="col-md-12 selectpicker fixed form-control select-block" ');
           ?>
            
        </div>
    </div>
    <div class="col-md-12">
        <label for="cmp_desc">Responsible Person(s):</label>
      	<div class="input-group control-group after-add-more">
           <?php 
           echo form_dropdown('emailaddress[]', $allusers, isset($editdatavalue['selectedValue'])?$editdatavalue['selectedValue']:array(), 'multiple="multiple" class="col-md-12 selectpicker fixed form-control" id="name_of_dlvproducts"');
           ?>
            
          <div class="input-group-btn"> 
            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
          </div>
        </div>
    </div>
      
    <?php if(isset($editdatavalue['responsibleemail']) && count($editdatavalue['responsibleemail'])>0){ ?>
    <div class="col-md-12 copymoreemail ">
    <?php foreach($editdatavalue['responsibleemail'] as $dataformoreemails){
        ?>
        <div class="control-group input-group" style="margin-top:10px">
            <input type="text" name="moreemailaddress[]" class="form-control" value="<?php echo isset($dataformoreemails->userid) ? $dataformoreemails->userid : '';?>" placeholder="Additional Email Address">
        <div class="input-group-btn"> 
          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
        </div>
        
        <?php
    } ?>
    </div>
    <?php } ?>
    
    
    
    
    <!-- Copy Fields -->
    <div class="col-md-12 copy hide">
      <div class="control-group input-group" style="margin-top:10px">
        
        <input type="text" name="moreemailaddress[]" class="form-control" placeholder="Additional Email Address">
          <?php 
           //echo form_dropdown('addmore[]', $allusers, array(), 'multiple="multiple" class="selectpicker fixed form-control" ');
           ?>
        <div class="input-group-btn"> 
          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>
    
    <!---------------------------------------- Date value end ---------------------------------------->
    <!-- -----------------------------------for todo start ------------------------------------------>
    <hr>
    <div class="col-md-12">
        <label for="cmp_desc">Action List:</label>
      	<div class="input-group control-group after-add-more1">
            <input type="checkbox" value="<?php echo isset($editdatavalue['actions'][0]->actname) ? $editdatavalue['actions'][0]->actname : '';?>" <?php echo isset($editdatavalue['actions'][0]->status) && $editdatavalue['actions'][0]->status==1  ? 'checked="checked"':"";?> name="actionschk[]">
            <input type="text" name="actions[]" value="<?php echo isset($editdatavalue['actions'][0]->actname) ? $editdatavalue['actions'][0]->actname : '';?>" class="form-control" placeholder="Action">
          <div class="input-group-btn"> 
            <button class="btn btn-success add-more1" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
          </div>
        </div>
    </div>
    
    
    <?php if(isset($editdatavalue['actionsmore'])) { ?>
    <div class="col-md-12 copy2">
    <?php 
    if(isset($editdatavalue['actionsmore'])){
    foreach($editdatavalue['actionsmore'] as $dataformoreaction){
        ?>
        
            <div class="control-group input-group" style="margin-top:10px">
                <input type="checkbox" value="<?php echo isset($dataformoreaction->actname) ? $dataformoreaction->actname : '';?>" <?php echo $dataformoreaction->status==1  ? 'checked="checked"':"";?> name="moreactionschk[]">
                <input type="text" name="moreactions[]" value="<?php echo isset($dataformoreaction->actname) ? $dataformoreaction->actname : '';?>" class="form-control" placeholder="Action">
                <div class="input-group-btn"> 
                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
            </div>
        
        <?php
    } ?>
    </div>
    <?php 
    } 
    }
    ?>
    
    
    
    <div class="col-md-12 copy1 hide">
      <div class="control-group input-group" style="margin-top:10px">
        <input type="checkbox" value=""  name="moreactionschk[]">
        <input type="text" name="moreactions[]" class="form-control" placeholder="Action">
        <div class="input-group-btn"> 
          <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>
    <!-- ---------------------------------for todo end ------------------------------------------>
    <div class="col-md-12"> 
    <div>
        <button type="submit" class="btn btn-primary detail">Submit</button>
    </div>
    <?php form_close(); ?>
    </div>
<div class="row">
    <!-- <div class="clearfix"></div> -->
</div>
<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript">
CKEDITOR.plugins.addExternal( 'confighelper', 'https://martinezdelizarrondo.com/ckplugins/confighelper/' );
var config = { extraPlugins: 'confighelper', toolbar:'Basic'};
CKEDITOR.replace('cmp_desc', config);
</script>
<script type="text/javascript">
    
    $(document).ready(function () {
        //CKEDITOR.replace('cmp_desc', {});



        $("#cmpresponse").change(function () {
            var id = $(this).val();
            //alert(id)
            if ((id == 1) || (id == 2)) {
                $('#cmpname').show();
                $('#cmpnametext').hide();
            } else {
                $('#cmpname').hide();
                $('#cmpnametext').show();
            }
        });


        //start code for add more////////////////////////////////////////////////////
        $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
        });
        $(".add-more1").click(function(){ 
          var html = $(".copy1").html();
          $(".after-add-more1").after(html);
        });

        $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
        });
        //end code for add more//////////////////////////////////////////////////////

    });
</script>
<script>
    //   app.controller('MainCtrl', function($scope) {
    //       //$scope.choices = [{id: 'choice1'}];
    //       $scope.choices =  [{id: 'choice1'}];
    //       //console.log($scope.choices.length);
    //       $scope.addNewChoice = function() {
    //   
    //       var newItemNo = $scope.choices.length + 1;
    //       $scope.choices.push({'id':'choice' + newItemNo});
    //       };
    //       $scope.removeChoice = function() {
    //       var lastItem = $scope.choices.length - 1;
    //       $scope.choices.splice(lastItem);
    //       };
    //       
    //   });




</script>
<script>
    app.controller('MainCtrl', function ($scope) {

        //  $scope.dataType = ['type1', 'type2', 'type'];
        $scope.dataType = [
            {id: 1, colId: ['col1', 'col4'], dataTypeName: 'Resources'},
            {id: 2, colId: ['col2', 'col3'], dataTypeName: 'Sales'},
            {id: 3, colId: ['col5', 'col6', 'col7', 'col8'], dataTypeName: 'P.M'},
            {id: 4, colId: ['col9', 'col10', 'col11', 'col12'], dataTypeName: 'Stage'},
            {id: 5, colId: ['col13', 'col14', 'col15', 'col16'], dataTypeName: 'Accounts'},
            {id: 6, colId: ['col20', 'col17', 'col18', 'col19'], dataTypeName: 'Others'}
        ];

        $scope.columns = [{colId: 'col1', name: '', dataType: [], dataFormat: '', excludedChar: '', maxLength: '', isKeyField: false, isKeyRequired: false}];

        $scope.addNewColumn = function () {
            var newItemNo = $scope.columns.length + 1;
            //alert(newItemNo)
            $scope.columns.push({'colId': 'col' + newItemNo});
        };
        $scope.removeColumn = function (index) {
            // remove the row specified in index
            $scope.columns.splice(index, 1);
            // if no rows left in the array create a blank array
            if ($scope.columns.length() === 0 || $scope.columns.length() == null) {
                alert('no rec');
                $scope.columns.push = [{"colId": "col1"}];
            }
        };
    });
</script>



