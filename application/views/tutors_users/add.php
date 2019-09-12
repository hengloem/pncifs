
<div class="container-fluid" id="wrap">
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
            <div id="flash-inner-message" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">×</button>
              <b> <?php echo $this->session->flashdata('sms'); ////read   ?> </b></div>
       
        <?php
    }
    ?>
    <div class="row-fluid">
      
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-heading">
                    <h3 class="panel-title">Create tutor account </h3>
                </div>

                <div class="panel-body"> 
                    <!--//-->
                    <form class="form-horizontal" action="<?php echo base_url() ?>tutorsusers/check_validation_add" method="post">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input type="text" class="form-control" name="FirstName" id="firstname"  
                                       value=" <?php echo set_value('FirstName', $this->input->post('FirstName')); ?>"    />
                                  <?php echo form_error('FirstName')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9" style="color:red;">
                                <input type="text" class="form-control" name="LastName" id="lastname"  
                                      value=" <?php echo set_value('LastName', $this->input->post('LastName')); ?>"  />
                                  <?php echo form_error('LastName')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">PN Email</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input type="email" class="form-control" id="pnemail" name="EmailPN"  
                                      value=" <?php echo set_value('EmailPN', $this->input->post('EmailPN')); ?>"  />
                                  <?php echo form_error('EmailPN')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Skype ID</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="text" name="SkypeID" id="skypeid"  
                                       value=" <?php echo set_value('SkypeID', $this->input->post('SkypeID')); ?>" />
                                  <?php echo form_error('SkypeID')?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="specialization" class="col-sm-3 control-label">Specialization</label>
                            <div class="col-sm-9">
                                <select id="specialization" name="Specialization" class="form-control" >
                                    <option value="WEP">WEP</option> 
                                    <option value="SNA">SNA</option>
                                    <option value="PL">PL</option> 
                                    <option value="ENGLISH">ENGLISH</option>
                                    <option value="IT ADMIN">IT ADMIN</option> 
                                     <option value="ERO">ERO</option> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input class="form-control" type="password" name="Password" id="password"  />
                                  <?php echo form_error('Password')?>
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Retype password</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input class="form-control" type="password" name="password2" id="password2"  />
                                  <?php echo form_error('password2')?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="major" class="col-sm-3 control-label">Administrator account</label>
                            <div class="checkbox col-sm-9">
                                <label><input type="checkbox"   name="IsAdministrator" /></label>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button>

                                <a href="<?php echo base_url(); ?>tutorsusers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
