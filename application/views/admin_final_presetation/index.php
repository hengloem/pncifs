<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read       ?></b></div>

        <?php
    }
    ?>
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>An admin final presentation</h2><hr/>
            <label>Select Batch *</label>
            <select onChange="window.location.href = this.value" class="form-control">
                <?php
                foreach ($year as $row) {
                    ?>
                    <option value="<?php echo base_url() . 'final_pres/get_filter/' . $row['Id']; ?>" <?php echo ( isset($_SESSION['selected_id']) && ($_SESSION['selected_id'] == $row['Id']) ? "selected" : "") ?>>
                        <?php echo $row['Year']; ?>
                    </option> 

                    <?php
                }
                ?>
            </select><br/>
            <form action="<?php echo base_url() ?>final_pres/upload_file/" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i>Upload</button>
            </form>
        <br>
        <?php
        if (isset($slide_present) && $slide_present != "") {
            foreach ($slide_present as $value) {
                ?>
                <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>Template for batch : <?php echo $value['Year'] ?></th>
                        </tr>
                        <tr>                            
                            <th>
                                File Name: <?php echo $_SESSION['tem_file_name'] = $value['FinalPresTemplateFileName'] ?><br><br>
                                DateTime  <?php echo $value['FinalPres_UploadDate'] ?>
                                <br><br><br>
                                <form method="post">
                                    <input type="hidden" name="filename" value="<?php echo $value['FinalPresTemplateFileName'] ?>"/>
                                    <button type="submit" formaction="<?php echo base_url() . "final_pres/download_file" ?>" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-download-alt"></span> Download</button>
                                    <a onclick=" return confirm('Are you sure to delete?')"class="btn btn-danger" type="submit" href="<?php echo base_url() . "final_pres/delete/" . $value['Id'] ?>"class="btn btn-danger" name="delete"id="confirm-delete">
                                        <span class="glyphicon glyphicon-trash"></span> Delete</a>
                                </form>
                            </th>
                        </tr>
                    </thead>
                </table>
                <?php
            }
        }
        ?>
    </div>
</div>
</div>
