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

                <h3>&#128077;Thank you so much for your feedback.</h3>

                </div>

                
            </div>

        </div>

    </div>

</div>