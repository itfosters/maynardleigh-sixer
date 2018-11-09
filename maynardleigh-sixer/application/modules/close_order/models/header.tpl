<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="p:domain_verify" content="ad1fd92e7cc0438c297da6ea65e9d26e"/>
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>" />
    <?php  
    $cururl = $_SERVER['REQUEST_URI']; 
      $testurl =          explode("/" , $cururl);
     
     if($testurl['1'] == "index.php")
     {
		 ?>
		 <script>
		 window.location.href = "http://www.marinerswarehouse.com";
		 </script>
		 <?php
		 
		}
    
     ?>
    <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php } ?>
    
    <?php if ($keywords) { ?>
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <?php } ?>
    
    <?php if ($icon) { ?>
    <link href="<?php echo $icon; ?>" rel="icon" />
    <?php } ?>
    
    <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
    <?php } ?>
    
    
    <script>var swap_product_image="<?php echo $this->config->get("swap_product_image"); ?>"</script>
	<script src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <link rel="stylesheet" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
    <script type="text/javascript" src="catalog/view/javascript/common.js"></script>   
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

	<!-- <link href="catalog/view/theme/denzi/stylesheet/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet">    -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="catalog/view/theme/denzi/stylesheet/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="catalog/view/theme/denzi/stylesheet/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link rel="stylesheet" href="catalog/view/theme/denzi/stylesheet/stylesheet.css">
	<script src="catalog/view/javascript/jquery/livesearch.js"></script><!-- Autofill search -->
	
	    
    <?php foreach ($styles as $style) { ?>
    <link rel="<?php echo $style['rel']; ?>" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
    <?php } ?>
         
    <!-- accordion category options -->
 
    
    <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>"></script>
    <?php } ?>
  
    <?php if ($stores) { ?>
    <script><!--
    $(document).ready(function() {
    <?php foreach ($stores as $store) { ?>
    $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
    <?php } ?>
    });
    //--></script>
    <?php } ?>
    <?php echo $google_analytics; ?>
    
    <!-- Modernizr -->
    <script src="catalog/view/javascript/jquery/modernizr.custom.63321.js"></script>
    
    <?php require_once('catalog/view/theme/denzi/template/common/theme_options.tpl') ;?>
     
	 <?php 
	 
	 if (isset($this->request->get['route'])) { 
        $route = $this->request->get['route']; 
		 
	if (substr($route, 0, 16) == 'product/category' || substr($route, 0, 16) == 'product/product' || substr($route, 0, 16) == 'common/home' || $_SERVER['REQUEST_URI'] =='/') { ?>
	 <style>
	 .nav.navbar-navf.megamenu
	 {
		margin-left: 284px;
	 }
	 </style>
	<?php }	
	
		else
		{ ?>
	 <style>
	 .nav.navbar-navf.megamenu
	 {
		margin-left: 0px !important;
	 }
	 </style>
	<?php 
		} 
		}
	 ?>
</head>

<body>

	<!-- NOTIFICATION AREA -->
    <?php if ($error) { ?>
    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/denzi/image/close.png" alt="" class="close" /></div>
    <?php } ?>
	<div id="notification"></div>


	<div id="topBar">
    	<div class="container" >
        	<div class="row">
            	<div class="span4">
                	<div id="welcome">
                        <!-- <?php if (!$logged) { ?>
                        <?php echo $text_welcome; ?>
                        <?php } else { ?>
                        <?php echo $text_logged; ?>
                        <?php } ?> -->
                        <a href="mailto:info@marinerswarehouse.com"><i class="fa fa-envelope-square"></i> info@marinerswarehouse.com</a> <br />
                        <a href="callto:305-335-5843"><i class="fa fa-phone-square"></i> 305-335-5843</a>
                    </div>
                </div>
                <div class="span8 rightsidepart">
                	<!--<?php echo $language; ?>-->
              		<?php //echo $currency;  ?>
	                <?php if ($_SERVER['REMOTE_ADDR'] == '176.120.37.119'){ ?>
	                <?php //echo $currency;  ?>
	                <?php } ?>
                    <!--<select class="drop" onchange="location = this.options[this.selectedIndex].value;">
                    	<option class="label"><?php echo $text_links; ?></option>
                        <option value="<?php echo $home; ?>"><?php echo $text_home; ?></option>
                        <option value="<?php echo $wishlist; ?>" id="wishlist-total"><?php echo $text_wishlist; ?></option>
                        <option value="<?php echo $account; ?>"><?php echo $text_account; ?></option>
                        <option value="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></option>
                        <option value="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></option>
                        <option value="index.php?route=information/contact"><?php echo $text_contact; ?></option>
                    </select>-->
                    <div id="search" class="radius">
                      <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
                      <button class="button-search"><i class="fa fa-search"></i></button>
                      <select name="color-menu" id="my-color-menu" class="custom-select-menu search_category_id">
                        <option value=""><?php echo $text_all; ?></option>
                        <?php 
                        $category_id=(isset($_GET['category_id']))?$_GET['category_id']:"";
                        foreach ($categories as $category_1) { ?>
                        <?php if ($category_1['category_id'] == $category_id) { ?>
                        <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div> 

                    <ul class="top-list top-list-right">
                      <li><a href="http://marinerswarehouse.com/checkout">Checkout</a></li>
                      <li> |</li>
                      <li> <a href="http://marinerswarehouse.com/wishlist">Wish List</a></li>
                      <li> |</li>
                      <li> <a href="http://marinerswarehouse.com/login"><i class="fa fa-user"></i>  Log In</a></li> 
                      <li> |</li>
                      <li> <a href="http://marinerswarehouse.com/register">Sign Up</a></li>
                     

                    </ul>
                        
                    </div>
                </div>
            </div>
        </div>
   
    
    <?php if($this->config->get('firstblock_title_' . $this->config->get('config_language_id')) != '') { ?> 
 
     <div id="topBlocks">
     	<div class="container">
          <ul class="topBlocks">
              <li>
                 <a href="<?php echo $this->config->get('firstblock_link')?>">
					<?php 
					 if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $path_image = HTTPS_IMAGE;
					 else $path_image = HTTP_IMAGE; 
					 if($this->config->get('firstblock_img')!='') { ?>
					 <img src="<?php echo $path_image . $this->config->get('firstblock_img') ?>" alt="" ><!--custom image-->
					 <?php } ?> 
					 <?php if($this->config->get('firstblock_title_' . $this->config->get('config_language_id')) != '') { ?>   
					 <h4><?php echo $this->config->get('firstblock_title_' . $this->config->get('config_language_id'))?></h4>
					 <?php } ?>
					 <?php if($this->config->get('firstblock_desc_' . $this->config->get('config_language_id')) != '') { ?>
					 <span><?php echo $this->config->get('firstblock_desc_' . $this->config->get('config_language_id'))?></span>
					 <?php } ?>
                 </a>
              </li>
              <li>
                 <a href="<?php echo $this->config->get('secondblock_link')?>">
					 <?php 
					 if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $path_image = HTTPS_IMAGE;
					 else $path_image = HTTP_IMAGE; 
					 if($this->config->get('secondblock_img')!='') { ?>
					 <img src="<?php echo $path_image . $this->config->get('secondblock_img') ?>" alt="" ><!--custom image-->
					 <?php } ?> 
					 <?php if($this->config->get('secondblock_title_' . $this->config->get('config_language_id')) != '') { ?>   
					 <h4><?php echo $this->config->get('secondblock_title_' . $this->config->get('config_language_id'))?></h4>
					 <?php } ?>
					 <?php if($this->config->get('secondblock_desc_' . $this->config->get('config_language_id')) != '') { ?>
					 <span><?php echo $this->config->get('secondblock_desc_' . $this->config->get('config_language_id'))?></span>
					 <?php } ?>
                 </a>
              </li>
              <li>
                 <a href="<?php echo $this->config->get('thirdblock_link')?>">
                     <?php 
                     if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $path_image = HTTPS_IMAGE;
                     else $path_image = HTTP_IMAGE; 
                     if($this->config->get('thirdblock_img')!='') { ?>
                     <img src="<?php echo $path_image . $this->config->get('thirdblock_img') ?>" alt="" ><!--custom image-->
                     <?php } ?> 
                     <?php if($this->config->get('thirdblock_title_' . $this->config->get('config_language_id')) != '') { ?>   
                     <h4><?php echo $this->config->get('thirdblock_title_' . $this->config->get('config_language_id'))?></h4>
                     <?php } ?>
                     <?php if($this->config->get('thirdblock_desc_' . $this->config->get('config_language_id')) != '') { ?>
                     <span><?php echo $this->config->get('thirdblock_desc_' . $this->config->get('config_language_id'))?></span>
                     <?php } ?>
                 </a>
              </li>
              <li>
                 <a href="<?php echo $this->config->get('fourthblock_link')?>">
                     <?php 
                     if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $path_image = HTTPS_IMAGE;
                     else $path_image = HTTP_IMAGE; 
                     if($this->config->get('fourthblock_img')!='') { ?>
                     <img src="<?php echo $path_image . $this->config->get('fourthblock_img') ?>" alt="" ><!--custom image-->
                     <?php } ?> 
                     <?php if($this->config->get('fourthblock_title_' . $this->config->get('config_language_id')) != '') { ?>   
                     <h4><?php echo $this->config->get('fourthblock_title_' . $this->config->get('config_language_id'))?></h4>
                     <?php } ?>
                     <?php if($this->config->get('fourthblock_desc_' . $this->config->get('config_language_id')) != '') { ?>
                     <span><?php echo $this->config->get('fourthblock_desc_' . $this->config->get('config_language_id'))?></span>
                     <?php } ?>
                 </a>
              </li>
              <li>
                 <a href="<?php echo $this->config->get('fifthblock_link')?>">
                     <?php 
                     if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') $path_image = HTTPS_IMAGE;
                     else $path_image = HTTP_IMAGE; 
                     if($this->config->get('fifthblock_img')!='') { ?>
                     <img src="<?php echo $path_image . $this->config->get('fifthblock_img') ?>" alt="" ><!--custom image-->
                     <?php } ?> 
                     <?php if($this->config->get('fifthblock_title_' . $this->config->get('config_language_id')) != '') { ?>   
                     <h4><?php echo $this->config->get('fifthblock_title_' . $this->config->get('config_language_id'))?></h4>
                     <?php } ?>
                     <?php if($this->config->get('fifthblock_desc_' . $this->config->get('config_language_id')) != '') { ?>
                     <span><?php echo $this->config->get('fifthblock_desc_' . $this->config->get('config_language_id'))?></span>
                     <?php } ?>
                 </a>
              </li>
          </ul>
      </div>
    </div>
    <!--/blocks-->
 
    <?php } ?>
    
    <div class="main-content" >
       
        	
            <header>
               <div class="container">
                <div class="row-fluid">
              <?php if ($logo) { ?>
              <div class="span3">
                  <div id="logo">
                    <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
                  </div>
              </div>
              <?php } ?>
              <!--/logo-->
              
              
              <!--/search-->
              <div class="span9">



	              <div class="header-right">
                 
              	  <?php echo $cart; ?>
                  <!-- <div class="contact-us">
              <h4>Call us now</h4>
              <span>305 335 5843</span>
              </div> -->
						<!-- itser -->
		              <?php //if ($_SERVER['REMOTE_ADDR'] == '176.120.37.119'){ ?>
		              <!-- <div class="contact-us" style="background: none; padding-top: 15px; height: 30px;">
			              <a href="./index.php?route=product/propfinder&category_id=63">Propellers Advanced Search</a>
		              </div> -->
		              <!-- <script type="text/javascript"> 
			              $('.prop_search').colorbox({
				              width: 700,
				              height: 900
			              });
			              </script> -->
		              <?php //} ?>
		              <!-- itser -->
              
<!--               	  <div id="search" class="radius">
                    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
                  	<button class="button-search"><i class="fa fa-search"></i></button>
				      <select name="color-menu" id="my-color-menu" class="custom-select-menu search_category_id">
				        <option value=""><?php echo $text_all; ?></option>
				        <?php 
				        $category_id=(isset($_GET['category_id']))?$_GET['category_id']:"";
				        foreach ($categories as $category_1) { ?>
				        <?php if ($category_1['category_id'] == $category_id) { ?>
				        <option value="<?php echo $category_1['category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
				        <?php } else { ?>
				        <option value="<?php echo $category_1['category_id']; ?>"><?php echo $category_1['name']; ?></option>
				        <?php } ?>
				        <?php } ?>
				      </select>
                  </div> -->
              
              </div>
              </div>
              <!--/cart-->
              </div>
            </div>

              <div class="clearfix"></div>
              
              <!-- Default Menu -->
              <?php if($this->config->get('enable_default_menu')==1): ?>
              <?php if ($categories) { ?>
                
                <div id="menu" class="radius">
                  <ul>
                    <?php foreach ($categories as $category) { ?>
                    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                      <?php if ($category['children']) { ?>
                      <div>
                        <?php for ($i = 0; $i < count($category['children']);) { ?>
                        <ul>
                          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                          <?php for (; $i < $j; $i++) { ?>
                          <?php if (isset($category['children'][$i])) { ?>
                          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    </li>
                    <?php } ?>
                  </ul>
                </div><!--/#menu-->
             
              <?php } ?>
              <!--/menu-->
              
              <!--***** MENU FOR MOBILE DEVICES RETURNS INTO SELECT ****-->
              <?php if ($categories) { ?>
              <div class="menuDevices" style="display:none">
                  <div class="select_outer">
                      <div class="bg_select"></div>
                      <select onchange="location=this.value">
                            <option><?php echo $text_menu; ?></option>
                            <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></option>
                            <?php } ?>    
                      </select>
                  </div><!--/select_outer-->
              </div>
              
              
           
              
              
              
              
              
              
              
              <?php } ?>
              <?php endif; ?>
              
              <!-- Mega Menu -->
              <?php echo $mainmenu; ?>
              
              
                              
                	   <!--div class="span6"  style="float:right;">
             
                  <center>  <row style="span:12px;"> <ul class="nav"> 
                    	
                        <li onclick="home_redirct('<?php echo $home; ?>');" style="cursor:pointer;"><?php echo $text_home; ?></li>
                        <li onclick="home_redirct('<?php echo $wishlist; ?>');" style="cursor:pointer;" id="wishlist-total"><?php echo $text_wishlist; ?></li>
                        <li onclick="home_redirct('<?php echo $account; ?>');" style="cursor:pointer;"><?php echo $text_account; ?></li>
                        <li onclick="home_redirct('<?php echo $shopping_cart; ?>');" style="cursor:pointer;"><?php echo $text_shopping_cart; ?></li>
                        <li onclick="home_redirct('<?php echo $checkout; ?>');" style="cursor:pointer;"><?php echo $text_checkout; ?></li>
                        <li onclick="home_redirct('<?php echo "http://marinerswarehouse.com/index.php?route=information/contact"; ?>');" style="cursor:pointer;"><?php echo $text_contact; ?></li>
                       
                    </ul></row></center>
                    </div-->
              
              
                                
            </header>
            
            <div class="clearfix"></div>
            
           <div class="container"> 
              <div class="row">
<script>
	function home_redirct(url)
	{
		
		window.location.href = url;	
	}
</script>

