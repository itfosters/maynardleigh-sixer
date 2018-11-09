
<?php
//echo "<pre>";print_r($frmdata);die;
 ?>


 <div class="col-md-12"> <h1 class="page-head-line"> My Information </h3> 



    <form method="post" action="<?php echo site_url('welcome/myinfo'); ?>" >

      <div class="col-md-6">

        <div class="form-group">

            <label> Your current Location</label>

            <input name="userlocation" type="text" value="<?php echo isset($frmdata['myinfos']->user_current_location)?$frmdata['myinfos']->user_current_location:''; ?>" class="form-control" id="inputEmail" placeholder="current location">

        </div>
</div>
        <div class="col-md-6">
        <div class="form-group">

            <label>Preferred Airlince</label>

           <!--  <select class="form-control" name="preferedairlience">
                   <option value="10" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='10')){echo "selected='selected'";} ?>>Airlince</option>
                    <option value="1" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='1') ){echo "selected='selected' ";}  ?>>Jet Airways</option>
                     <option value="2" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='2') ){echo "selected='selected' ";}  ?>> Indian Airlince</option>
                      <option value="3" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='3') ){echo "selected='selected' ";}  ?>> Kingfisher </option>
                      <option value="4" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='4') ) {echo "selected='selected' ";} ?>> Air One </option>
                      <option value="5" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='5') ) {echo "selected='selected' ";} ?>> Premier Airways </option>
                      <option value="6" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='6') ) {echo "selected='selected' ";} ?>> Air Carnival </option>
                      <option value="7" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='7') ){echo "selected='selected' ";}  ?>> Turbo Megha Airways </option>
                      <option value="8" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='8') ){echo "selected='selected' ";}  ?>> Zav Airways </option>
                      <option value="9" <?php  if(isset($frmdata['myinfos']->preferred_airlience) and ($frmdata['myinfos']->preferred_airlience =='9') ){echo "selected='selected' ";}  ?>> Zexus Air </option>
                  </select> -->
                  <?php echo form_dropdown('preferedairlience', $frmdata['allairlines'], $frmdata['myinfos']->preferred_airlience, ' class="required form-control "  ');?>
        </div>
</div>
       <div class="col-md-6">
        <div class="form-group">

            <label>Preferred Food</label>

            <select class="form-control" name="food">
                   <option value=""> Select Food </option>
                    <option value="veg" <?php  if(isset($frmdata['myinfos']->food) and ($frmdata['myinfos']->food =='veg') ){echo "selected='selected' ";}  ?>> Veg</option>
                     <option value="nonveg" <?php  if(isset($frmdata['myinfos']->food) and ($frmdata['myinfos']->food =='nonveg') ) {echo "selected='selected' ";} ?>> Non-Veg </option>
                      

                  </select>

        </div>
</div>
        
<dil class="col-md-12">
        <input type="submit" class="btn btn-primary" value="Save"/>

</div>
    </form>


 </div>