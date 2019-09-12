<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read          ?></b></div>

        <?php
    }
    ?>
    <div class="row-fluid">

        <div class="col-md-12">

            <h1>Welcome Tutor Survey Follow Up Students </h1>
            <br><br>
            <div class='col-sm-12'>
                <label>Select Batch *</label>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <select onChange="window.location.href = this.value" class="form-control">
                        <?php
//                            var_dump($year);exit();
                        foreach ($year as $row) {
                            ?>
                            <option value="<?php echo base_url() . 'tutor_follow_by_admin/get_filter_tutor/' . $row['Id']; ?>" <?php echo ( isset($_SESSION['selected_id']) && ($_SESSION['selected_id'] == $row['Id']) ? "selected" : "") ?>>
                                <?php echo $row['Year']; ?>
                            </option> 

                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br><br><br><br>
            
            <?php
            if (isset($list_student) && $list_student != "") {
               // foreach ($list_student as $value) {
                    ?>
                    <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question Title</th> 
                            <th>Answer</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><?php echo 'How are you?'?></td>
                            <td><?php echo 'I am working right now.'?></td>
                            <td><?php echo 'he got error right now, please let him some relax.'?></td>
                        </tr>
                    </tbody>
                </table>
                    <?php
              //  }
            }
            ?>
        </div>

    </div>
</div>
</div>

