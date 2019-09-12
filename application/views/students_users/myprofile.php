<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-heading">
                    <h3 class="panel-title">My Profile</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>studentsusers/editProfile_validation/<?php echo $this->session->userdata('id'); ?>">
                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">Role</label>
                            <div class="col-sm-9">
                                <label for="role" class="control-label">Tutor</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id['FirstName'] ?>" type="text" class="form-control" name="firstname" id="firstname" 
                                       />
                                <p style="color:red"<?php echo form_error('firstname') ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id['LastName'] ?>" type="text" class="form-control" name="lastname" id="lastname" 
                                       />
                                <p style="color:red"<?php echo form_error('lastname') ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pnemail" class="col-sm-3 control-label">PN Email</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id['EmailPN'] ?>" type="email" class="form-control" id="pnemail" name="pnemail"
                                       />
                                <p style="color:red"<?php echo form_error('pnemail') ?></p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="personalemail" class="col-sm-3 control-label">Personal Email</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id['EmailPersonal'] ?>" type="email" class="form-control" id="personalemail" name="personalemail"
                                       />
                                <p style="color:red"<?php echo form_error('personalemail') ?></p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="skype" class="col-sm-3 control-label">Skype</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $user_id['SkypeID'] ?>" class="form-control" type="text" name="skypeid" id="skypeid" 
                                       />
                                <p style="color:red"<?php echo form_error('skypeid') ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="batchid" class="col-sm-3 control-label">Batch</label>
                            <div class="col-sm-9">
                                <p name="batchid"><?php echo $user_id['Year'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tutorname" class="col-sm-3 control-label">Tutor Name</label>
                            <div class="col-sm-9">
                                <?php foreach ($tutor_data as $row) { ?>
                                    <p name="TutorsId"><?php if ($user_id['TutorsId'] == $row['Id']) echo $row['FirstName'] . '  ' . $row['LastName']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supervisor" class="col-sm-3 control-label">Supervisor Name</label>
                            <div class="col-sm-9">
                                <?php foreach ($supervisor_data as $row) { ?>
                                    <p name="TutorsId"><?php
                                        if ($user_id['SupervisorId'] == $row['UsersId']) {
                                            echo $row['FirstName'] . '  ' . $row['LastName'];
                                        }
                                        echo 'not have supervisor';
                                        ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="specialization" class="col-sm-3 control-label">Specialization</label>
                            <div class="col-sm-9">
                                <select id="specialization" name="specialization" class="form-control">
                                    <?php
                                    $MAJOR = array("WEP", "SNA");
                                    foreach ($MAJOR as $row) {
                                        ?>
                                        <option value="<?php echo $row; ?>" <?php echo ($user_id['Major'] == $row ? "selected" : "") ?>>
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
                                <a href="<?php echo base_url(); ?>studentsusers/form_password/" class="btn btn-info">Change my password</a>
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