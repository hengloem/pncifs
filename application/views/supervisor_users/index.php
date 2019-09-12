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
            <h1>List of supervisor accounts </h1>
            <div class="table-responsive">
                <br>
                <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Company name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($supervisor_data != ""){
                        foreach ($supervisor_data as $supervisor_list) {
                            ?>
                            <tr>
                                <td><?php echo $supervisor_list['Id'] ?></td>
                                <td><?php echo $supervisor_list['FirstName'].' '.$supervisor_list['LastName'] ?></td>                   
                                <td><?php echo $supervisor_list['Companyname'] ?></td>    
                                <td><?php echo $supervisor_list['Position'] ?></td>  
                                <td><?php echo $supervisor_list['Emailpersonal'] ?></td>
                                <td><?php echo $supervisor_list['PhoneNumber'] ?></td>
                                <td data-order="1">
                                    <div>
                                        <a href="<?php echo base_url(); ?>supervisorusers/c_preview_detail/<?php echo $supervisor_list['Id'] ?>" title="preview"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        &nbsp;
                                        <a href="<?php echo base_url(); ?>supervisorusers/c_edit/<?php echo $supervisor_list['Id'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                        &nbsp;
                                        <a href="#" class="confirm-delete" data-id="<?php echo $supervisor_list['Id']; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                    </div>
                                </td>             
                            </tr>
                        <?php }
                        }  else {
                            echo "<tr><td colspan='8'>No recode found..!</td></tr>";
                        }?>
                    </tbody>
                </table>
            </div>
            <br>
            <a class="btn btn-info" href="<?php echo base_url(); ?>supervisorusers/c_add">Create one</a>
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
                    document.location = '<?php echo base_url(); ?>supervisorusers/c_delete_supervisor/' + id;
                }
            });
        });

    });
</script>
