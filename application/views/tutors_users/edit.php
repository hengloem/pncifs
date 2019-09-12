<div class="container-fluid" id="wrap"> 
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-heading">
                    <h3 class="panel-title">Edit tutor account</h3>
                </div>

                <div class="panel-body">
                    
                    <?php
                    foreach ($tutor_data as $users_item) {
                        if ($users_item['Id'] == $user_id) {

                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            echo form_open('tutorsusers/check_validation_edit/' . $users_item['UsersId'], $attributes);
                            ?> 
                            <input type="hidden" name="id" value="<?php echo $users_item['UsersId']; ?>"  /><br />
                         
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9" style="color:red;">
                                    <input type="text" class="form-control" name="firstname" id="firstname"  
                                           value="<?php echo set_value('firstname', $users_item['FirstName']); ?>" />
                                 <?php echo form_error('firstname')?> 
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9"  style="color:red;">
                                    <input type="text" class="form-control" name="lastname" id="lastname"  
                                           value="<?php echo set_value('lastname', $users_item['LastName']); ?>" />
                                    <?php echo form_error('lastname')?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">PN Email</label>
                                <div class="col-sm-9"  style="color:red;">
                                    <input type="email" class="form-control" id="pnemail" name="pnemail"  
                                           value="<?php echo set_value('pnemail', $users_item['EmailPN']); ?>" />
                                     <?php echo form_error('pnemail')?>
                                    
                                </div>
                            </div>  
                            <div class="form-group" >
                                <label for="password" class="col-sm-3 control-label">Skype ID</label>
                                <div class="col-sm-9" style="color:red;">
                                    <input class="form-control" type="text" name="skypeid" id="skypeid"  
                                           value="<?php echo set_value('skypeid', $users_item['SkypeID']); ?>" />
                                     <?php echo form_error('skypeid')?>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="major" class="col-sm-3 control-label">Specialization</label>
                                <div class="col-sm-9">
                                    <select id="major" name="Specialization" class="form-control" required>
                                        <option value="WEP" <?php echo ($users_item['Specialization'] == 'WEP') ? 'selected ' : '' ?>>WEP</option>
                                        <option value="SNA" <?php echo ($users_item['Specialization'] == 'SNA') ? 'selected ' : '' ?>>SNA</option>
                                        <option value="PL" <?php echo ($users_item['Specialization'] == 'PL') ? 'selected ' : '' ?>>PL</option> 
                                        <option value="ENGLISH" <?php echo ($users_item['Specialization'] == 'ENGLISH') ? 'selected ' : '' ?>>ENGLISH</option>
                                        <option value="IT ADMIN" <?php echo ($users_item['Specialization'] == 'IT ADMIN') ? 'selected ' : '' ?>>IT ADMIN</option> 
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="major" class="col-sm-3 control-label">Suspend account</label>
                                <div class="checkbox col-sm-9">
                                    <label><input type="checkbox" name="issuspended" <?php echo ($users_item['IsSuspended'] == 1) ? 'checked ' : '' ?>"/></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Connection</label>
                                <div class="col-sm-9">			
                                    <input class="form-control col-sm-9" id="disabledInput" value="<?php echo $users_item['LastConnection']; ?>"disabled="" type="text" />
                                </div>
                            </div>		

                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <button type="submit"  class="btn btn-primary" value="Submit"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Save</button>
                                    &nbsp;
                                    <a href="<?php echo base_url(); ?>tutorsusers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
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