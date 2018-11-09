<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title><?php echo $template['title']; ?></title>
    <?php echo $template['metadata']; ?>
    
    <script>var ADMINURL ='<?php echo base_url("admin"); ?>';</script>
    <link href="<?php echo base_url('assests/admin/css');?>/bootstrap.min.css" rel="stylesheet">
     <!--<link href="<?php echo base_url('assests/admin/css');?>/datepicker.css" rel="stylesheet">-->
    <link href="<?php echo base_url('assests/admin/css');?>/font-awesome.css" rel="stylesheet">
    
    <!--<link href="<?php echo base_url('assests/admin/css');?>/style1.css" rel="stylesheet">-->
    
    <link href="<?php echo base_url('assests/admin/css');?>/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/pepper-ginder-custom.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/smart-addons.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/smart-forms.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/bootstrap-select.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/fullcalendar.css" rel="stylesheet">
     <!--<link href="<?php echo base_url('assests/admin/css');?>/contract.css.css" rel="stylesheet">-->
   
     <!--<link href="<?php echo base_url('assests/admin/css');?>/bootstrap1.css" rel="styleshee    <link href="<?php echo base_url('assests/admin/css');?>/bootstrap-select.min1.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/font-awesome1.css" rel="stylesheet">
t">
   <link href="<?php echo base_url('assests/admin/css');?>/bootstrap-select.min1.css" rel="stylesheet">
    <link href="<?php echo base_url('assests/admin/css');?>/font-awesome1.css" rel="stylesheet">-->
     <link href="<?php echo base_url('assests/admin/css');?>/style.css" rel="stylesheet">
    <script src="<?php echo base_url("assests/admin/js"); ?>/jquery-1.11.1.js"></script>
    <script src="<?php echo base_url("assests/admin/js"); ?>/moment.js"></script>
        <script src="<?php echo base_url("assests/admin/js"); ?>/fullcalendar.js"></script>
         <script src="<?php echo base_url("assests/admin/js"); ?>/daterangepicker.js"></script>
             <script src="<?php echo base_url("assests/admin/js"); ?>/datepicker.js"></script>



    <!--[if lt IE 9]>

    <script src="<?php echo base_url('assests/admin/js');?>/html5shiv.js"></script>
    <script src="<?php echo base_url('assests/admin/js');?>/respond.min.js"></script>
    <![endif]-->
<?php echo $template['jscss_head']; ?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="<?php echo site_url("admin"); ?>">IT Fosters <span class="fullname">Web Solutions Pvt. Ltd</span></a>
            </div>

            <div class="notifications-wrapper">
                <ul class="nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">30% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                                <span class="sr-only">30% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">90% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                                                <span class="sr-only">90% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See Tasks List + </strong>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url("admin/user/profile"); ?>"><i class="fa fa-user-plus"></i> My Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("admin/user/change_password"); ?>"><i class="fa fa-cog"></i> Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url("admin/user/logout"); ?>"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li><div class="user-img-div"><a href="<?php echo site_url("admin/user/profile_image"); ?>"><img src="<?php echo showImage("profile/", $loginuserinfo["LOGEDDATA"]->profile_image); ?>" class="img-circle" /></a></div></li>
                    <li><a  href="<?php echo site_url("admin/user/profile"); ?>"> <strong> <?php echo $loginuserinfo["LOGEDDATA"]->name; ?> </strong></a></li>
                    <li><a class="active-menu"  href="<?php echo site_url("admin"); ?>"><i class="fa fa-dashboard "></i>Dashboard</a></li>
                    <li><a href="#itf"><i class="fa fa-users"></i>User Management <span class="fa icondown arrow"></span></a>
                        <ul class="nav nav-second-level">
                            
                            <li><a href="<?php echo site_url('admin/client');?>"><i class="fa fa-users"></i>Client</a></li>
                    <li><a href="<?php echo site_url('admin/seller');?>"><i class="fa fa-users"></i>Seller</a></li>
                    <li><a href="<?php echo site_url('admin/manager');?>"><i class="fa fa-users"></i>Manager</a></li>
                    <li><a href="<?php echo site_url('admin/casting_manager');?>"><i class="fa fa-users"></i>Casting Manager</a></li>
                        </ul>
                    </li>
                    <li><a href="#order"><i class="fa fa-users"></i>Order <span class="fa icondown arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url("admin/order/index"); ?>"><i class="fa fa-user"></i>Order Listing</a></li>                            
                            <li><a href="<?php echo site_url("admin/order/add_order"); ?>"><i class="fa fa-user"></i>Add Order</a></li> 
                        </ul>
                    </li>
                    
                    <li><a href="<?php echo site_url('admin/product/index');?>"><i class="fa fa-users"></i>Product</a></li>

                     
                                                                                              
                    <li><a href="#itf"><i class="fa fa fa-cogs"></i>Setting <span class="fa icondown arrow"></span></a>
                        <ul class="nav nav-second-level">
                             
                            <li><a href="<?php echo site_url("admin/siteconfig"); ?>"><i class="fa fa-cog"></i>Site Config</a></li>
                            <li><a href="<?php echo site_url("admin/mail"); ?>"><i class="fa fa-envelope"></i>Mail</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">

            <div id="page-inner">

                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo site_url("admin"); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
                            <?php foreach($template["breadcrumbs"] as $itfbread){ 
                                if(!empty($itfbread["uri"])){
                                    ?>
                                <li><a href="<?php echo $itfbread["uri"]; ?>"><?php echo $itfbread["name"]; ?></a></li>
                                <?php }else{ ?>
                                <li><?php echo $itfbread["name"]; ?></li>
                                <?php }     
                            }   
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><?php echo isset($headingtitle)?$headingtitle:"Dashboard"; ?></h1>
                    </div>
                </div>



                <?php if ($this->messages->check("error")) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Warning! </strong> <?php echo $this->messages->flash(); ?>
                        </div>
                    </div>
                </div>                 
                <?php } elseif ($this->messages->check("success")) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Success!</strong> <?php echo $this->messages->flash(); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <?php echo $template['body']; ?>
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>

        
    </div>
    <!-- /. WRAPPER  -->
    <footer >&copy; 2015 ITFosters Web Solutions Pvt. Ltd</footer>
     <script src="<?php echo base_url("assests/admin/js"); ?>/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url("assests/admin/js"); ?>/bootstrap.js"></script>
    <script src="<?php echo base_url("assests/admin/js"); ?>/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url("assests/admin/js"); ?>/custom.js"></script>
   
    <?php echo $template['jscss_footer']; ?>  
     <script>


$(function() {
	$('#custom-date-format').multiDatesPicker({
	dateFormat: "y-m-d", 
	
});

    $('input[name="daterange"]').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
});
</script>       
</body>
</html>