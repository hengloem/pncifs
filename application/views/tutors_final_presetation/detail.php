<div class="container-fluid" id="wrap">

    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-primary" style="margin-top: 5%;">

                <div class="panel-heading ">
                    <h3 class="panel-title">View Detail</h3>
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
                                <label for="firstname" class="col-sm-3 control-label text-left">Username</label>
                                <div class="col-sm-9">
                                    <p name="Firstname"><?php echo set_value('firstname', $users_item['FirstName']." ".$users_item['LastName']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label text-left">PN Email</label>
                                <div class="col-sm-9">
                                   <p name="EmailPN"><?php echo set_value('EmailPN', $users_item['EmailPN']); ?></p>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="major" class="col-sm-3 control-label text-left">Specialization</label>
                                <div class="col-sm-9">
                                    <p name="Specialization"><?php echo set_value('Specialization', $users_item['Specialization']); ?></p>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-3 control-label">Skype ID</label>
                                <div class="col-sm-9">			
                                    <p name="SkypeID"><?php echo set_value('firstname', $users_item['SkypeID']); ?></p>
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
                                    <a href="<?php echo base_url(); ?>tutorsusers" class="btn btn-success btn-lg"><span class=" glyphicon glyphicon-circle-arrow-left"></span> &nbsp;&nbsp;Back</a>
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