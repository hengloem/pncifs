<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit supervisor account</h3>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($supervisor_data as $sup_item) {
                        if ($sup_item['Id'] == $sup_id) {

                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            echo form_open('supervisorusers/c_check_validation_edit/' . $sup_item['Id'], $attributes);
                            ?> 
                            <input type="hidden" name="id" value="<?php echo $sup_item['Id']; ?>"  /><br />
                         
                            <div class="form-group">
                                <label for="FirstName" class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9" style="color:red;">
                                    <input type="text" class="form-control" name="FirstName" id="firstname"  
                                           value="<?php echo set_value('FirstName', $sup_item['FirstName']); ?>" />
                                 <?php echo form_error('FirstName')?> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="LastName" class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9"  style="color:red;">
                                    <input type="text" class="form-control" name="LastName" id="lastname"  
                                           value="<?php echo set_value('lastname', $sup_item['LastName']); ?>" />
                                    <?php echo form_error('LastName')?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Companyname" class="col-sm-3 control-label">Company name</label>
                                <div class="col-sm-9"  style="color:red;">
                                    <input type="text" class="form-control" id="Companyname" name="Companyname"  
                                           value="<?php echo set_value('Companyname', $sup_item['Companyname']); ?>" />
                                     <?php echo form_error('Companyname')?>
                                    
                                </div>
                            </div>  
                            <div class="form-group" >
                                <label for="Position" class="col-sm-3 control-label">Position</label>
                                <div class="col-sm-9" style="color:red;">
                                    <input class="form-control" type="text" name="Position" id="Position"  
                                           value="<?php echo set_value('Positon', $sup_item['Position']); ?>" />
                                     <?php echo form_error('Position')?>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="Departmentname" class="col-sm-3 control-label">Department name</label>
                                <div class="col-sm-9" style="color:red;">
                                    <input class="form-control" type="text" name="Departmentname" id="Departmentname"  
                                           value="<?php echo set_value('Departmentname', $sup_item['Departmentname']); ?>" />
                                     <?php echo form_error('Departmentname')?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Emailpersonal" class="col-sm-3 control-label">Personal email</label>
                                <div class="col-sm-9" style="color:red;">			
                                    <input class="form-control" type="text" name="Emailpersonal" id="Emailpersonal"  
                                           value="<?php echo set_value('Emailpersonal', $sup_item['Emailpersonal']); ?>" />
                                     <?php echo form_error('Emailpersonal')?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="EmailPN" class="col-sm-3 control-label">Company email</label>
                                <div class="col-sm-9" style="color:red;">			
                                    <input class="form-control" type="text" name="EmailPN" id="EmailPN"  
                                           value="<?php echo set_value('EmailPN', $sup_item['EmailPN']); ?>" />
                                     <?php echo form_error('EmailPN')?>
                                </div>
                            </div>	

                            <div class="form-group">
                                <label for="PhoneNumber" class="col-sm-3 control-label">Phone number</label>
                                <div class="col-sm-9" style="color:red;">			
                                    <input class="form-control" type="text" name="PhoneNumber" id="Departmentname"   placeholder="(855) 015-239-369"
                                           value="<?php echo set_value('PhoneNumber', $sup_item['PhoneNumber']); ?>"/>
                                     <?php echo form_error('PhoneNumber')?>
                                </div>
                            </div>	
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <button type="submit"  class="btn btn-primary" value="Submit"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Save</button>
                                    &nbsp;
                                    <a href="<?php echo base_url(); ?>supervisorusers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                                    </div>
                            </div>
                    </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>