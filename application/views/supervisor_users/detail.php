<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit supervisor account</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if($supervisor_data != ""){
                    foreach ($supervisor_data as $sup_item) {
                        if ($sup_item['Id'] == $sup_id) {

                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            echo form_open('supervisorusers/c_check_validation_edit/' . $sup_item['Id'], $attributes);
                            ?> 
                            <input type="hidden" name="id" value="<?php echo $sup_item['Id']; ?>"  /><br />
                         
                            <div class="form-group">
                                <label for="FirstName" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-9">
                                    <p name="FirstName"><?php echo set_value('FirstName',$sup_item['FirstName']).' '.set_value('LastName',$sup_item['LastName']) ; ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Companyname" class="col-sm-3 control-label">Company name</label>
                                <div class="col-sm-9">
                                    <p name="Companyname"><?php echo set_value('Companyname',$sup_item['Companyname']); ?></p>
                                </div>
                            </div>  
                            <div class="form-group" >
                                <label for="Position" class="col-sm-3 control-label">Position</label>
                                <div class="col-sm-9" >
                                    <p name="Position"><?php echo set_value('Postition',$sup_item['Position']); ?> </p>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="Departmentname" class="col-sm-3 control-label">Department name</label>
                                <div class="col-sm-9">
                                    <p name="Departmentname"><?php echo set_value('Departmentname',$sup_item['Departmentname']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Emailpersonal" class="col-sm-3 control-label">Personal email</label>
                                <div class="col-sm-9">			
                                    <p name="Emailpersonal"><?php echo set_value('Emailpersonal', $sup_item['Emailpersonal']); ?> </p>
                                </div>
                            </div>		

                            <div class="form-group">
                                <label for="EmailPN" class="col-sm-3 control-label">Company email</label>
                                <div class="col-sm-9">			
                                    <p name="EmailPN"><?php echo set_value('EmailPN', $sup_item['EmailPN']); ?> </p>
                                </div>
                            </div>                            
                            
                            <div class="form-group">
                                <label for="PhoneNumber" class="col-sm-3 control-label">Phone number</label>
                                <div class="col-sm-9">			
                                    <p name="PhoneNumber"><?php echo set_value('PhoneNumber', $sup_item['PhoneNumber']); ?> </p>
                                </div>
                            </div>	
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <a href="<?php echo base_url(); ?>supervisorusers" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Back</a>
                                </div>
                            </div>
                    </form>
                    <?php
                            }
                        }
                    }  else {
                        echo "No record found..!";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>