<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-primary" style="margin-top: 5%;">

                <div class="panel-heading ">
                    <h3 class="panel-title">Detail student information</h3>
                </div>
                <div class="panel-body">
                    <?php
                    foreach ($student_data as $users_item) {
                        if ($users_item['Id'] == $user_id) {
                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            ?> 
                            <input type="hidden" name="id" value="<?php echo $users_item['Id']; ?>"/><br/>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label text-left">Username</label>
                                <div class="col-sm-9">
                                    <p name="Firstname"><?php echo $users_item['FirstName'] . " " . $users_item['LastName']; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label text-left">PN Email</label>
                                <div class="col-sm-9">
                                    <p name="EmailPN"><?php echo set_value('EmailPN', $users_item['EmailPN']); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="major" class="col-sm-3 control-label text-left">Email Personal</label>
                                <div class="col-sm-9">
                                    <p name="EmailPersonal"><?php echo set_value('EmailPersonal', $users_item['EmailPersonal']); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Skype ID</label>
                                <div class="col-sm-9">		
                                    <p name="SkypeID"><?php echo set_value('firstname', $users_item['SkypeID']); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Major</label>
                                <div class="col-sm-9">			
                                    <p name="Major"><?php echo set_value('Major', $users_item['Major']); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Batch ID</label>
                                <div class="col-sm-9">			
                                    <p name="Year"><?php echo set_value('Year', $users_item['Year']); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tutor Name</label>
                                <div class="col-sm-9">	
                                    <?php foreach ($tutor_data as $row) { ?>
                                        <p name="TutorsId"><?php if ($users_item['TutorsId'] == $row['Id']) echo $row['FirstName'] . '  ' . $row['LastName']; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Supervisor Name</label>
                                <div class="col-sm-9">	 
                                    <p name="">Processing</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Last Connection</label>
                                <div class="col-sm-9">
                                    <p name="LastConnection"><?php echo set_value('LastConnection', $users_item['LastConnection']); ?></p>
                                </div>
                            </div><br>
                            <div class="form-group">
                                <div class="col-sm-12">             
                                    <a href="<?php echo base_url(); ?>studentsusers" class="btn btn-danger btn-md"><span class=" glyphicon glyphicon-circle-arrow-left"></span> &nbsp;&nbsp;Back</a>
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