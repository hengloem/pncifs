
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
      
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-heading">
                    <h3 class="panel-title">Create supervisor account </h3>
                </div>

                <div class="panel-body"> 
                    <!--//-->
                    <form class="form-horizontal" action="<?php echo base_url() ?>supervisorusers/c_check_validation_add" method="post">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input type="text" class="form-control" name="FirstName" id="firstname"  
                                       value="<?php echo set_value('FirstName', $this->input->post('FirstName')); ?>"/>
                                  <?php echo form_error('FirstName')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9" style="color:red;">
                                <input type="text" class="form-control" name="LastName" id="lastname"  
                                      value="<?php echo set_value('LastName', $this->input->post('LastName')); ?>"  />
                                  <?php echo form_error('LastName')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Companyname" class="col-sm-3 control-label">Company name</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input type="text" class="form-control" id="companyname" name="Companyname"  
                                      value="<?php echo set_value('Companyname', $this->input->post('Companyname')); ?>"  />
                                  <?php echo form_error('Companyname')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position" class="col-sm-3 control-label">Position</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="text" name="Position" id="position"  
                                       value="<?php echo set_value('Position', $this->input->post('Position')); ?>" />
                                  <?php echo form_error('Position')?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Departmentname" class="col-sm-3 control-label">Department name</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="text" name="Departmentname" id="Departmentname"  
                                       value="<?php echo set_value('Departmentname', $this->input->post('Departmentname')); ?>" />
                                  <?php echo form_error('Departmentname')?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="Emailpersonal" class="col-sm-3 control-label">Personal email</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="email" name="Emailpersonal" id="Emailpersonal"  
                                       value="<?php echo set_value('Emailpersonal', $this->input->post('Emailpersonal')); ?>" />
                                  <?php echo form_error('Emailpersonal')?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="EmailPN" class="col-sm-3 control-label">Company email</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="email" name="EmailPN" id="EmailPN"  
                                       value="<?php echo set_value('EmailPN', $this->input->post('EmailPN')); ?>" />
                                  <?php echo form_error('EmailPN')?>
                            </div>
                        </div>                       
                        
                        <div class="form-group">
                            <label for="PhoneNumber" class="col-sm-3 control-label">Phone number</label>
                            <div class="col-sm-9"  style="color:red;"> 
                                <input class="form-control" type="text" name="PhoneNumber" id="PhoneNumber"   placeholder="(855) 015-239-369"
                                       value="<?php echo set_value('PhoneNumber', $this->input->post('PhoneNumber')); ?>"/>
                                  <?php echo form_error('PhoneNumber')?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input class="form-control" type="password" name="Password" id="password"  
                                       value="<?php echo set_value('Password', $this->input->post('Password'))?>"
                                       placeholder="The default password of supervisor user is 123"/>
                                  <?php echo form_error('Password')?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Retype password</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input class="form-control" type="password" name="password2" id="password2"  
                                       value="<?php echo set_value('Password', $this->input->post('Password2')); ?>" 
                                       placeholder="The default password of supervisor user is 123"/>
                                  <?php echo form_error('password2')?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button>
                                <a href="<?php echo base_url(); ?>supervisorusers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
