
<div class="container-fluid" id="wrap">
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read      ?> </b></div>

        <?php
    }
    ?>

    <div class="row-fluid">

        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-heading">
                    <h3 class="panel-title">Change Your Password</h3>
                </div>
                <div class="panel-body"> 
                    <!--//-->
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>tutorsusers/ComparePass/<?php echo $user_id; ?>">
                        <input type="hidden" class="form-control" name="id" id="password" value="<?php echo $this->session->userdata('id') ?>"/>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Old Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="password"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passsword" class="col-sm-3 control-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="newpassword" id="newpassword"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"/>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <a href="#"> <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button></a>

                                <a href="<?php echo base_url(); ?>tutorsusers" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
