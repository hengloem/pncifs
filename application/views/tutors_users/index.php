<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read    ?> </b></div>

        <?php
    }
    ?>
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Tutor accounts</h2><hr/>
            <div class="table-responsive">
                <br>
                <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Skype ID</th>
                            <th>Specialization</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tutor_data as $row) {
                            ?>      

                            <tr>
                                <td><?php echo $row['Id'] ?></td>
                                <td><?php echo $row['FirstName'] ?></td>
                                <td><?php echo $row['LastName'] ?></td>                       
                                <td><?php echo $row['SkypeID'] ?></td>    
                                <td><?php echo $row['Specialization'] ?></td>            
                                <td data-order="1">
                                    <div>
                                        <a href="<?php echo base_url(); ?>tutorsusers/details/<?php echo $row['Id'] ?>" title="preview"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>tutorsusers/edit/<?php echo $row['Id'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                        &nbsp;  
                                        <?php if ($row['Id'] != $admin_id) { ?>
                                            <a href="#" class="confirm-delete" data-id="<?php echo $row['Id']; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                        <?php } ?>
                                    </div>
                                </td>             
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <br>
            <a class="btn btn-info" href="<?php echo base_url(); ?>tutorsusers/add">Create one</a>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        //Transform the HTML table in a fancy datatable
        $('#users').dataTable({
            stateSave: true
        });

        $('.confirm-delete').click(function () {
            var id = $(this).data('id');
            bootbox.confirm("Are you sure that you want to delete this user?", function (result) {
                if (result) {
                    document.location = '<?php echo base_url(); ?>tutorsusers/delete/' + id;
                }
            });
        });

    });
</script>
