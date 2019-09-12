<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <img src="<?php echo base_url(); ?>assets/images/PN_Logo.png" class="center-block"
             style="width: 150px; height: 150px;"
             alt="PNC Internship Follow-up"> 
    </div>
    <div class="col-md-12">
        <h1 class="text-center">Internship Follow-up System</h1>
        <h2 class="text-center">Create account</h2>  
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="login-panel panel panel-default" style="margin-top: 5%;">
            <div class="panel-heading">
                <h3 class="panel-title">Create your student account</h3>
            </div>
            <div class="panel-body">
                <?php echo (isset($flash_partial_view) && $flash_partial_view <> '') ? $flash_partial_view : ''; ?>
                <?php echo validation_errors(); ?>
                <?php
                $attributes = array('id' => 'register', 'class' => 'form-horizontal');

                echo form_open('connection/register_student', $attributes);
                ?>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="firstname" id="firstname" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="lastname" id="lastname" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">PN Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="pnemail" name="pnemail" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="password" id="password" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Retype password</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="password" name="password2" id="password2" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Skype ID</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="skypeid" id="skypeid" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Personnal Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="personnalemail" name="personnalemail" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="major" class="col-sm-3 control-label">Major</label>
                    <div class="col-sm-9">
                        <select id="major" name="major" class="form-control"required>
                            <option value="WEP" selected>WEP</option>
                            <option value="SNA">SNA</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="batchcode" class="col-sm-3 control-label">Batch Code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="batchcode" name="batchcode" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button id="send" type="submit" form="register" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Create</button>
                        &nbsp;
                        <a href="<?php echo base_url(); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

