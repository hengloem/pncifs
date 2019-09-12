<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                
                <div class="panel-heading">
                    <h3 class="panel-title">My Profile</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url()?>tutorsusers/editProfile_validation/<?php echo $this->session->userdata('id')?>">

                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-9">
                                <label for="role" class="control-label">Tutor</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id[0]['FirstName'] ?>" type="text" class="form-control" name="firstname" id="firstname" 
                                       />
                                <p style="color:red"<?php echo form_error('firstname')?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id[0]['LastName'] ?>" type="text" class="form-control" name="lastname" id="lastname" 
                                       />
                                <p style="color:red"<?php echo form_error('lastname')?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">PN Email</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id[0]['EmailPN'] ?>" type="email" class="form-control" id="pnemail" name="pnemail"
                                       />
                                <p style="color:red"<?php echo form_error('pnemail')?></p>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="skype" class="col-sm-3 control-label">Skype ID</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id[0]['SkypeID'] ?>" class="form-control" type="text" name="skypeid" id="skypeid" 
                                       />
                                <p style="color:red"<?php echo form_error('skypeid')?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="specialization" class="col-sm-3 control-label">Specialization</label>
                            <div class="col-sm-9">
                                <select id="specialization" name="specialization" class="form-control">
                                    <?php
                                    $MAJOR = array("WEP","SNA","IT ADMIN","ERO","ENGLISH","PL");
                                    
                                    foreach ($MAJOR as $row) {
                                        ?>
                                        <option value="<?php echo $row; ?>" <?php echo ($user_id[0]['Specialization'] == $row ? "selected" : "")?>>
                                            <?php echo $row; ?>
                                        </option> 
                                        <?php
                                    }
                                    ?>                
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <a href="<?php echo base_url(); ?>tutorsusers/form_password/" class="btn btn-info">Change my password</a>
                            </div>
                        </div>    

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                               <a href="#"> <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button></a>
                                &nbsp;
                                <a href="<?php echo base_url(); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>