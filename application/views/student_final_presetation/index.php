<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ?></b></div>

        <?php
    }
    ?>
    <?php if ($users != 0) { ?>
        <?php
        foreach ($users as $users_item) {
            if ($users_item['UsersId'] == $stu_id) {
                ?>
                <div class="row-fluid">
                    <div class="col-md-12">
                        <h2>Template final presentation for batch <?php echo $users_item['Year']; ?></h2><hr/>
                        <table class="table table-striped table-bordered table-hover" id="users">
                            <thead>
                                <tr>
                                    <th>Template final report for student in batch: <?php echo $users_item['Year']; ?> </th>
                                </tr>
                                <tr>
                                    <th>
                                        File Name: <?php echo $_SESSION['tem_file_name'] = $users_item['FinalPresTemplateFileName'] ?><br><br>
                                        DateTime: <?php echo $users_item['FinalPres_UploadDate'] ?>
                                        <br><br><br>
                                        <form method="post">
                                            <input type="hidden" name="filename" value="<?php echo $users_item['FinalPresTemplateFileName'] ?>"/>
                                            <button type="submit" formaction="<?php echo base_url() . "student_final_pres/download_file" ?>" class="btn btn-primary">
                                            <span class="glyphicon glyphicon-download-alt"></span> Download</button>
                                        </form>
                                    </th>
                                </tr>
                            <thead>
                        </table>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    <?php } else { ?>
        <h3>No Users found</h3>                
    <?php } ?>
</div>        
