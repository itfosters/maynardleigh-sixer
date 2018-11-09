<?php if(count($banners)>0) { ?>
<div class="container mobile_view">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div id="skin_3" class="itf_game_latest">
              <ul class="itf-list">
              <?php foreach($banners as $k=>$banner){ ?>
                  <li>
                        <div class="itf-content  table">
                            <a href="#itf" target="_blank">
                            <img src="<?php echo PUBLIC_ULR."banner/".$banner->banner_image;?>"  alt="">
                            </a>                   
                     </div>
                  </li> 
                  <?php } ?>                    
               </ul>
         </div>
      </div>
   </div>
<?php } ?>      