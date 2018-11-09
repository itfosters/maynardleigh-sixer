<?php //echo "<pre>";print_r($itfdata);die;?>
<div class="row">
    <div class="col-md-12">

        <h4>URL is : <h4><h3><?php echo isset($itfdata['url_value']) ?$itfdata['url_value']: '';?></h3>
    </div> 
</div>
<div class="row">

<!-- <div class="clearfix"></div> -->
  <!-- Trigger the modal with a button -->
<div class="table-responsive">
<div id="accordion" role="tablist" aria-multiselectable="true">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> </a>
         <div role="button"  class="thead-inverse deal">
  <?php if (isset($itfdata['alldata']) && count($itfdata['alldata'])>0) { ?>
          <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover" summary="">
        <thead class="thead-inverse">
            
            <tr>
                <!--<th><input type="checkbox" name="" id="selecctall" value="1" title="Select All"></th>-->
                <th>S.No</th>
                <th>Name</th>
                <th>Mobile No </th>
                <th>Email</th>
                <th>Trainer knowledge</th>
                <th>Trainer skill</th>
                <th>Trainer attitude</th>
                <th>Content simplicity</th>
                <th>Content relevance</th>
                <th>Content effectiveness</th>
                <th>Comments pros cons</th>
                <th>Enjoy Session</th>
                <th>Helpful effective session</th>
                <th>Benefits outweigh the investment</th>
                <th>Will you recommend it</th>
                <th>Program rating</th>
                <th>Your learning</th>
                <th>Suggestion to improve</th>
                 
            </tr>  
          
          </thead>
          <tbody>
            <?php
             foreach ($itfdata['alldata'] as $key => $value) {?>
              <tr>
              <td class="colors"><?php echo $key+1;?></td>
              <td class="colors"><?php echo $value->name;?></td>
              <td class="colors"><?php echo $value->mobile_no;?></td>
              <td class="colors"><?php echo $value->email_id;?></td>
              <td class="colors"><?php echo $value->trainer_knowledge;?></td>
              <td class="colors"><?php echo $value->trainer_skill;?></td>
              <td class="colors"><?php echo $value->trainer_attitude;?></td>
              <td class="colors"><?php echo $value->content_simplicity;?></td>
              <td class="colors"><?php echo $value->content_relevance;?></td>
              <td class="colors"><?php echo $value->content_effectiveness;?></td>
              <td class="colors"><?php echo $value->comments_pros_cons;?></td>
              <td class="colors"><?php echo $value->enjoy_session;?></td>
              <td class="colors"><?php echo $value->helpfull_effective_session;?></td>
              <td class="colors"><?php echo $value->benefits_outweigh_the_investment;?></td>
              <td class="colors"><?php echo $value->will_you_recommend_it;?></td>
              <td class="colors"><?php echo $value->program_rating;?></td>
              <td class="colors"><?php echo $value->your_learning;?></td>
              <td class="colors"><?php echo $value->suggestion_to_improve;?></td>
              
          </tr>
           <?php  }?>
         </tbody>
       </table>
        <?php ///echo $links ; ?>
        <?php }else{?>
        
                  <div class="page-head-line"></div>
                  <div class="notfound_text">Sorry!</div>
                  <div class="norecordfound">No Comments Available</div>
        <?php } ?>
        </div>
        
        
      </div>

    </div>
  </div>
</div>
  <script type="text/javascript">
             $(document).ready(function(){

            $('#clock').on('click', function() {
              //alert('hello');
            $('#modal').show('1000');
            //$('#modal').css('z-index', '1500');
            });
           
        });
      </script>
  
  