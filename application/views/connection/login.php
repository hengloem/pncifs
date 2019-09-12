<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <img src="<?php echo base_url(); ?>assets/images/PN_Logo.png" class="center-block"
             style="width: 150px; height: 150px;"
             alt="PNC Internship Follow-up"> 
    </div>
    <div class="col-md-12">
        <h1 class="text-center">Internship Follow-up System</h1>                  
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default" style="margin-top: 5%;">
            <div class="panel-heading">                       
                <h3 class="panel-title">Please Sign In or register</h3>                        
            </div>
            <div class="panel-body">
                <?php echo (isset($flash_partial_view) && $flash_partial_view <> '') ? $flash_partial_view : ''; ?>
                <?php echo validation_errors(); ?>
                <?php
                $attributes = array('id' => 'loginFrom', 'class' => '');
                echo form_open('connection/login', $attributes);
                ?>
                <input type="hidden" name="last_page" value="connection/login" />
                <fieldset>
                    <div class="form-group">

                        <input class="form-control" placeholder="Email" autofocus="" name="email" id="login" value="<?php echo set_value('email'); ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" id="password" value="" type="password">
                    </div>

                    <!-- Change this to a button or input when using this as a form -->
                    <button id="send" type="submit" form="loginFrom" class="btn btn-lg btn-success btn-block">Login</button>  
                    <a href="<?php echo base_url(); ?>connection/register_student" class="btn btn-lg btn-info btn-block">
                        Register as student
                    </a>                                                            
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
