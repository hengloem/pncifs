<div class="container-fluid" id="wrap"> 
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit student account</h3>
                </div>
                <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <?php
                    foreach ($users_data as $users_item) {
                        $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                        echo form_open('studentsusers/edit/' . $users_item['UsersId'], $attributes);
                        ?>
                        <input type="hidden" name="id" value="<?php echo $users_item['UsersId']; ?>" required /><br />
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" id="firstname" required 
                                       value="<?php echo set_value('firstname', $users_item['FirstName']); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" id="lastname" required 
                                       value="<?php echo set_value('lastname', $users_item['LastName']); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">PN Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="pnemail" name="pnemail" required 
                                       value="<?php echo set_value('pnemail', $users_item['EmailPN']); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Personnal Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="personnalemail" name="personnalemail" required
                                       value="<?php echo set_value('personnalemail', $users_item['EmailPersonal']); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Skype ID</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="skypeid" id="skypeid" required 
                                       value="<?php echo set_value('skypeid', $users_item['SkypeID']); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="batch" class="col-sm-3 control-label">Batch</label>
                            <div class="col-sm-9">
                                <select id="batchid" name="batchid" class="form-control" required>
                                    <?php
                                    foreach ($batches as $batch) {
                                        echo '<option value="' . $batch['Id'] . '" ';
                                        if ($batch['Id'] == $users_item['BatchId']) {
                                            echo 'selected ';
                                        }
                                        echo '>';
                                        echo $batch['Year'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="major" class="col-sm-3 control-label">Major</label>
                            <div class="col-sm-9">
                                <select id="major" name="major" class="form-control" required>
                                    <option value="WEP" <?php echo ($users_item['Major'] == 'WEP') ? 'selected ' : '' ?>>WEP</option>
                                    <option value="SNA" <?php echo ($users_item['Major'] == 'SNA') ? 'selected ' : '' ?>>SNA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="major" class="col-sm-3 control-label">Suspend account</label>
                            <div class="checkbox col-sm-9">
                                <label><input type="checkbox" name="issuspended" <?php echo ($users_item['IsSuspended'] == 1) ? 'checked ' : '' ?>></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Connection</label>
                            <div class="col-sm-9">			
                                <input class="form-control col-sm-9" id="disabledInput" value="<?php echo $users_item['LastConnection']; ?>"disabled="" type="text" />
                            </div>
                        </div>		
                    <?php } ?>
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            <button id="send" type="submit" form="frmUserForm" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Save</button>
                            &nbsp;
                            <a href="<?php echo base_url(); ?>StudentsUsers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>