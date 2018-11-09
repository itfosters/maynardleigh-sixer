<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <!-- panel-btns -->
                <h4 class="panel-title">My Profile</h4>
            </div>
            <div class="panel-body nopadding">

            <?php echo form_open_multipart("admin/user/profile/",array("id"=>"frmfosters","class"=>"form-bordered")); ?>

                <div class="form-group col-md-6">
                    <label for="name">First Name</label>
                        <?php echo form_input(array("id"=>"name","name"=>"name","class"=>"form-control"),isset($frm_data["frm_data"]->name)?$frm_data["frm_data"]->name:"");?>
                        <?php echo form_error('name') ?>               
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                        <?php echo form_input(array("id"=>"last_name","name"=>"last_name","class"=>"form-control"),isset($frm_data["frm_data"]->last_name)?$frm_data["frm_data"]->last_name:"");?>
                        <?php echo form_error('lastname')?>             
                </div>

                <div class="form-group col-md-6">
                    <label for="username">User Name</label>
                        <?php echo form_input(array("id"=>"username","name"=>"username","class"=>"form-control"),isset($frm_data["frm_data"]->username)?$frm_data["frm_data"]->username:"");?>
                        <?php echo form_error('username')?>
                </div>


                <div class="form-group col-md-6">
                    <label for="email">Email Id</label>
                        <?php echo form_input(array("id"=>"email","name"=>"email","class"=>"form-control"),isset($frm_data["frm_data"]->email)?$frm_data["frm_data"]->email:"");?>
                        <?php echo form_error('email')?>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <button class="btn btn-primary mr5 mb10" type="submit">Update</button>
                    </div>
                </div><!-- form-group -->


                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>