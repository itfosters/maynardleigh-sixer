

<?php //echo "fff<pre>";print_r($complainType);die;
   //$complane=array('x','y','z');
   ?>
<?php echo form_open(); //"welcome/index", array("id" => "search")  ?> 
<div class="row"  ng-controller="MainCtrl">
   <div class="col-md-12">
      <div class="form-group">
         <label for="cmp_title">Complain Type:</label>
         <!--    <input type="text" class="form-control" name="cmp_title" value="<?php //echo isset($cmp_title)?$cmp_title:'';?>" id="cmp_title">-->
         <?php 
            echo form_dropdown('cmp_type',$complainType,isset($cmp_type)?$cmp_type:'','class="form-control"');
            
            
            ?>
      </div>
   </div>
<!--   <div class="col-md-12">
      <fieldset  ng-repeat="column in columns">
         <div class="col-md-5">
            <div class="form-group">
               <label for="cmp_title">Responsible</label>
               <select name="cmpresponse" class="form-control" id="cmpresponse" required>
                  <option value=""> Select Responsible</option>
                  <option ng-repeat="type in dataType"  value="{{type.id}}" ng-model="dataType.id">{{type.dataTypeName}}</option>
               </select>
            </div>
         </div>
          <div class="col-md-5" id="cmpname"style="display: none">
            <div class="form-group">
               <label for="cmp_title">Name</label>
               <?php echo form_dropdown('cmpname[]',$resources,'','class="form-control"');?>
            </div>
         </div>
          <div class="col-md-5" id="cmpnametext" style="display: none">
            <div class="form-group">
               <label for="cmp_title">Name</label>
               <?php 
               $data=array('name'=>'cmpname[]',
                  'class'=>"form-control" 
                   );
               
               
               echo form_input($data);?>
            </div>
         </div>
         <button class="remove"  ng-click="removeColumn($index)">x</button> 
      </fieldset>
      <button class="addfields" ng-click="addNewColumn()">Add Column</button>
        <button class="addfields" ng-click="setupNewGrid">Validate</button>
   </div>-->
   <div class="col-md-12">
      <div class="form-group">
         <label for="cmp_desc">Complain Description:</label>
         <textarea name="cmp_desc" class="form-control" id="complainDesc"><?php echo isset($cmp_desc)?$cmp_desc:'';?></textarea>
      </div>
      <input type="hidden" name="orderID" value="<?php  echo isset($ordId)?$ordId:''; ?>">
      <input type="hidden" name="cmp_id" value="<?php echo isset($cmp_id)?$cmp_id:''; ?>">
      <button type="submit" class="btn btn-primary detail">Submit</button>
   </div>
   <?php form_close();?>
</div>
<div class="row">
   <!-- <div class="clearfix"></div> -->
</div>
<script type="text/javascript" src="http://localhost/sixer/assests/itfeditor/ckeditor.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    CKEDITOR.replace('complainDesc', {});
    
        $('#clock').on('click', function() {
             $('#modal').show('1000');
        });
        
        
        $("#cmpresponse").change(function () {
           var id=$(this).val();
           //alert(id)
           if((id==1)||(id==2) ){
            $('#cmpname').show();
        $('#cmpnametext').hide();
           }
        else{
            $('#cmpname').hide();
             $('#cmpnametext').show();
         }
        });

        
        
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
   app.controller('MainCtrl', function($scope) {
   
   //  $scope.dataType = ['type1', 'type2', 'type'];
    $scope.dataType = [
   {id: 1, colId:['col1', 'col4'], dataTypeName: 'Resources'},
   {id: 2, colId:['col2', 'col3'], dataTypeName: 'Sales'},
   {id: 3, colId:['col5', 'col6', 'col7', 'col8'], dataTypeName: 'P.M'},
   {id: 4, colId:['col9', 'col10', 'col11', 'col12'], dataTypeName: 'Stage'},
   {id: 5, colId:['col13', 'col14', 'col15', 'col16'], dataTypeName: 'Accounts'},
   {id: 6, colId:['col20', 'col17', 'col18', 'col19'], dataTypeName: 'Others'}
   ];
   
   $scope.columns = [{colId: 'col1', name:'', dataType:[], dataFormat:'',  excludedChar:'', maxLength:'', isKeyField:false, isKeyRequired:false }];
   
   $scope.addNewColumn = function() {
   var newItemNo = $scope.columns.length+1;
   //alert(newItemNo)
   $scope.columns.push({'colId':'col'+newItemNo});
   };
   
   
   $scope.removeColumn = function(index) {
   // remove the row specified in index
   $scope.columns.splice( index, 1);
   // if no rows left in the array create a blank array
   if ( $scope.columns.length() === 0 || $scope.columns.length() == null){
    alert('no rec');
    $scope.columns.push = [{"colId":"col1"}];
   }
   
   
   };
   
   
   
   });
</script>

