<div class="login-wrapper">

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                

                <?php if ($this->messages->check("error")) { ?>

                <div class="alert alert-danger"><?php echo ($this->messages->flash()); ?></div>

                <?php } elseif ($this->messages->check("success")) { ?>

                <div class="alert alert-success"><?php echo ($this->messages->flash()); ?></div>

                <?php } ?>





                <div class="panel-heading">

                <h3>Engagement Form</h3>

                </div>

                <div class="panel-body">

                    <?php echo form_open("engagement/feedback",array("id"=>"frmlogin")); ?>
                    <?php echo form_hidden("assing_time_id",$assigntime_id); ?>
                        <div class="form-group">

                        <label for="exampleInputEmail1">Your Name</label>

                        <?php echo form_input(array("id"=>"login","name"=>"name","class"=>"form-control form-control", "placeholder"=>"Your good name", 'required' => 'required')); ?>                                    

                        </div>
                        <div class="form-group">

                        <label for="exampleInputEmail1">Mobile No</label>

                        <?php echo form_input(array("id"=>"mobile_no","name"=>"mobile_no","class"=>"form-control required", "placeholder"=>"Mobile number", 'required' => 'required')); ?>                                    

                        </div>
                        <div class="form-group">

                        <label for="exampleInputEmail1">Email Address</label>

                        <?php echo form_input(array("id"=>"mobile_no","name"=>"email_id","class"=>"form-control", "placeholder"=>"Email address")); ?>                                    

                        </div>
                        <div class="form-group">

                        <label for="exampleInputEmail1">Your feedback about this session</label>

                        <?php echo form_textarea(array("id"=>"feedback","name"=>"feedback","class"=>"form-control", "placeholder"=>"Your words about this session.", 'required' => 'required')); ?>                                    

                        </div>

                    

                        <!-- <div class="checkbox">

                        <label>

                        <input type="checkbox" /> Check me out

                        </label>

                        </div> -->

                        <div class="form-group">

                        <?php echo form_button(array("name"=>"login","class"=>"btn btn-primary" , "type"=>"submit"),"Submit"); ?>                             

                        </div>

                   <?php echo form_close(); ?>


                </div>

            </div>

        </div>

    </div>

</div>