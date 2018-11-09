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

                    <?php echo form_open("engagement/feedback", array("id" => "frmlogin")); ?>
                    <?php echo form_hidden("assing_time_id", $assigntime_id); ?>
                    <div class="form-group col-md-12">
                        <p>Thank you for participating in the workshop. We want to hear your feedback so we can keep improving the session. Please fill this quick survey and let us know your thoughts.</p>
                        <label for="exampleInputEmail1">Your Name</label>
                        <?php echo form_input(array("id" => "login", "name" => "name", "class" => "form-control form-control", "placeholder" => "Your good name", 'required' => 'required')); ?>                                    
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Mobile No</label>
                        <?php echo form_input(array("id" => "mobile_no", "name" => "mobile_no", "class" => "form-control required", "placeholder" => "Mobile number", 'required' => 'required')); ?>                                    

                    </div>
                    <div class="form-group col-md-12">

                        <label for="exampleInputEmail1">Email Address</label>

                        <?php echo form_input(array("id" => "mobile_no", "name" => "email_id", "class" => "form-control", "placeholder" => "Email address")); ?>                                    

                    </div>
                    <div class="form-group col-md-12"><p>Rate the <b>Trainer</b> in terms of his:[<b>Rating Guide</b>:<b>1</b> = Very Poor, <b>2</b> = Poor, <b>3</b> = Average, <b>4</b> = Good, <b>5</b>= Excellent] </p>
                    </div>
                    <div >

                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Knowledge, information and resources for your learning</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="trainer_knowledge_star<?php echo $i; ?>" name="trainer_knowledge" value="<?php echo $i; ?>" /><label class = "full" for="trainer_knowledge_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Skills that created a lively environment for your learning</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="trainer_skill_star<?php echo $i; ?>" name="trainer_skill" value="<?php echo $i; ?>" /><label class = "full" for="trainer_skill_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Attitudinal influence on you in relating the concept to your JOB/LIFE context.</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="trainer_attitude_star<?php echo $i; ?>" name="trainer_attitude" value="<?php echo $i; ?>" /><label class = "full" for="trainer_attitude_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <Br> Rate the <b>Content</b> in terms of his:[<b>Rating Guide</b>:<b>1</b> = Very Poor, <b>2</b> = Poor, <b>3</b> = Average, <b>4</b> = Good, <b>5</b>= Excellent] 
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1"> Simplicity to understand and follow</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="content_simplicity_star<?php echo $i; ?>" name="content_simplicity" value="<?php echo $i; ?>" /><label class = "full" for="content_simplicity_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Relevance in matching your personal/professional needs</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="content_relevance_star<?php echo $i; ?>" name="content_relevance" value="<?php echo $i; ?>" /><label class = "full" for="content_relevance_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Effectiveness in providing vital knowledge through activities like games, theatre, etc</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="content_effectiveness_star<?php echo $i; ?>" name="content_effectiveness" value="<?php echo $i; ?>" /><label class = "full" for="content_effectiveness_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>




                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Your valuable comments(Pros & Cons)</label>

                            <?php echo form_textarea(array("id" => "feedback", "name" => "comments_pros_cons", "class" => "form-control", "placeholder" => "Your words about this session.", 'required' => 'required', 'rows' => '4', 'cols' => '50')); ?>                                    

                        </div>

                        <div class="form-group col-md-12">
                            <p>Comment on Overall <b>Program</b> by encircling your choice</p>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6"style="float:left">
                                <label for="exampleInputEmail1">Did you enjoy it?</label> 
                            </div>
                            <div  class="col-md-6" style="float:left">
                                Yes <input name="enjoy_session" type="radio" value="Yes">   No  <input name="enjoy_session" type="radio" value="No">   Unsure  <input name="enjoy_session" type="radio" value="Unsure">  
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6"style="float:left">
                                <label for="exampleInputEmail1">Is it helpful in turning you more effective ?</label> 
                            </div>
                            <div  class="col-md-6" style="float:left">
                                Yes <input name="helpfull_effective_session" type="radio" value="Yes">   No  <input name="helpfull_effective_session" type="radio" value="No">   Unsure  <input name="helpfull_effective_session" type="radio" value="Unsure">  
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6"style="float:left">
                                <label for="exampleInputEmail1">Do the benefits outweigh the investment ?</label> 
                            </div>
                            <div  class="col-md-6" style="float:left">
                                Yes <input name="benefits_outweigh_the_investment" type="radio" value="Yes">   No  <input name="benefits_outweigh_the_investment" type="radio" value="No">   Unsure  <input name="benefits_outweigh_the_investment" type="radio" value="Unsure">  
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6"style="float:left">
                                <label for="exampleInputEmail1">Will you recommend it ?</label> 
                            </div>
                            <div  class="col-md-6" style="float:left">
                                Yes <input name="will_you_recommend_it" type="radio" value="Yes">   No  <input type="radio" name="will_you_recommend_it" value="No">   Unsure  <input name="will_you_recommend_it" type="radio" value="Unsure">  
                            </div>

                        </div>
                        <br/>
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Overall, how do you rate this program?</label>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="rating">
                                    <?php
                                    for ($i = 5; $i >= 1; $i--) {
                                        ?>
                                        <input type="radio" id="program_rating_star<?php echo $i; ?>" name="program_rating" value="<?php echo $i; ?>" /><label class = "full" for="program_rating_star<?php echo $i; ?>" title="<?php echo $i; ?>"></label>
                                        <?php
                                    }
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Your Learnings</label>

                            <?php echo form_textarea(array("id" => "feedback", "name" => "your_learning", "class" => "form-control", "placeholder" => "Your Learnings.", 'required' => 'required', 'rows' => '4', 'cols' => '50')); ?>                                    

                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Suggestions to improve</label>

                            <?php echo form_textarea(array("id" => "feedback", "name" => "suggestion_to_improve", "class" => "form-control", "placeholder" => "Suggestions to improve.", 'required' => 'required', 'rows' => '4', 'cols' => '50')); ?>                                    

                        </div>

                        <div class="form-group col-md-12">
                            
                            <?php echo form_button(array("name" => "login", "class" => "btn btn-primary", "type" => "submit"), "Submit"); ?>                             

                        </div>

                        <?php echo form_close(); ?>


                    </div>

                </div>

            </div>

        </div>

    </div>