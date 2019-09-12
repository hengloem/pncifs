<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read        ?> </b></div>

        <?php
    }
    ?>
    <div class="row-fluid">

        <div class="col-md-12">

            <h1>Final Presentation </h1>
            <br><br>
            <div class='col-sm-12'>
                <label>Select Batch *</label>
            </div>
            <div class="col-sm-6">
                <select id="specialization" name="specialization" class="form-control">
                    <?php
                    $year = array("2016", "2017", "2018");

                    foreach ($year as $row) {
                        ?>
                        <option value="<?php echo $row; ?>">
                            <?php echo $row; ?>
                        </option> 
                        <?php
                    }
                    ?>                
                </select>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-info" href="#">Upload</a>                
            </div>
            <br><br><br><br>
            <div class="col-sm-12">
                <a class="btn btn-info" href="<?php base_url() ?>">Filter</a>                
            </div>
            <br><br><br>
            <div class="col-sm-12">
                <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>Template For :<?php echo "2016"?></th>
                        </tr>
                        <tr>                            
                            <th>
                                File Name :<br><br>
                                Date and Time :

                                <br><br><br>
                                <a class="btn btn-info" href="#">Download</a>
                                 <a class="btn btn-danger" href="#">Delete</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
