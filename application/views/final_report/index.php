<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
            <div id="flash-inner-message" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">×</button>
              <b> <?php echo $this->session->flashdata('sms'); ////read   ?> </b></div>
       
        <?php
    }
    ?>

    <div class="row-fluid">
        <div class="col-md-12"> 
            <h1>Final report</h1>
            <form method="POST" action="<?php echo base_url(); ?>final_report" name="Get_Filter_By_Year">
                <div class="form-group ">
                    <label class="control-label requiredField" for="select">
                        Select a Batch
                        <span class="asteriskField">
                            *
                        </span>
                    </label>
                </div>
                <div class="form-group ">
                    <div class="col-sm-6">
                        <select class="select form-control" id="select" name="select">
                            <?php 
                            //$batch declared for store an Id = 0;
                            $batch = 0;
                            //if $_SESSION has selected, compare current id with new id that we are selected
                            if($_SESSION['current_select'] != ""){
                                $batch = $_SESSION['current_select'];
                            }
                            //if $batch_data == TRUE, printed
                            if ($batch_data != "") { ?>
                                <?php foreach ($batch_data as $batch_value) {
                                    ?>
                                    <option <?php if ($batch_value['Id'] == $batch) echo 'selected'; ?> value = "<?php echo $batch_value['Id'];?>"> 
                                        <!--show result-->
                                        <?php echo $batch_value['Year'];?>
                                    </option> 
                            <?php 
                                }
                            }else{
                                echo "No record found!";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-info" href="#">Upload</a>                
                    </div>
                </div>
                <div class="form-group">
                    <br><br><br><br>
                    <div class="col-sm-12">
                        <a class="btn btn-info" href="<?php base_url() ?>final_pres/list_file_presentaion">Filter</a>                
                    </div>
                </div>
            </form>
            
<!--            form of file-->
            <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Template for: 
                        <?php echo $batch_value['Year'];?>
                    </h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="<?php echo base_url()?>tutorsusers/editProfile_validation/<?php echo $this->session->userdata('id')?>">

                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">File name: </label>
                            <div class="col-sm-9">
                                <label for="role" class="control-label">Tutor</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="role" class="col-sm-3 control-label">Date: </label>
                            <div class="col-sm-9">
                                <label for="role" class="control-label">Tutor</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                               <a href="#"> <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Download</button></a>
                                &nbsp;
                                <a href="<?php echo base_url(); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Delete</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>       

        </div>
    </div>
</div> 
 

