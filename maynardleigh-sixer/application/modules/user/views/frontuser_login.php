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

                <h3>Login</h3>

                </div>

                <div class="panel-body">

                    <?php echo form_open("user/user_login",array("id"=>"frmlogin")); ?>

                        <div class="form-group">

                        <label for="exampleInputEmail1">Email address</label>

                        <?php echo form_input(array("id"=>"login","name"=>"email","class"=>"form-control", "placeholder"=>"Enter username")); ?>                                    

                        </div>

                        <div class="form-group">

                        <label for="exampleInputPassword1">Password</label>

                         <?php echo form_password(array("id"=>"pass","name"=>"password","class"=>"form-control","placeholder"=>"Password")); ?>                                    

                        </div>

                        

                        <!-- <div class="checkbox">

                        <label>

                        <input type="checkbox" /> Check me out

                        </label>

                        </div> -->

                        <div class="form-group">

                        <?php echo form_button(array("name"=>"login","class"=>"btn btn-primary" , "type"=>"submit"),"Login"); ?>                             

                        </div>

                   <?php echo form_close(); ?>

                    <label>

                    Forgot Password <strong><a href="#" target="_blank">click here</a>  </strong>

                

                </label>

                </div>

            </div>

        </div>

    </div>

</div>