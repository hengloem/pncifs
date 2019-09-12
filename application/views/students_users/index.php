<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Student accounts</h2><hr/>
              <a href="<?php echo base_url();?>studentstutorsassoc" class="btn btn-info">Associate students and tutors</a>             
            <?php if (count($users) != 0) { ?>
                <div class="table-responsive">
                <br>
                <table class="table table-striped table-bordered table-hover" id="users">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Skype ID</th>
                            <th>Batch</th>
                            <th>Major</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $users_item) { ?>
                    <tr>
                        <td><?php echo $users_item['UsersId'] ?></td>
                        <td><?php echo $users_item['FirstName'] ?></td>
                        <td><?php echo $users_item['LastName'] ?></td>                       
                        <td><?php echo $users_item['SkypeID'] ?></td>    
                        <td><?php echo $users_item['Year'] ?></td>            
                        <td><?php echo $users_item['Major'] ?></td>  
                       <td data-order="<?php echo $users_item['Id']; ?>">
                            <div>
                                <a href="<?php echo base_url();?>studentsusers/details/<?php echo $users_item['UsersId'] ?>" title="Edit"><span class="glyphicon glyphicon-eye-open"></span></a>
                                &nbsp;
                                <a href="<?php echo base_url();?>studentsusers/edit/<?php echo $users_item['UsersId'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                &nbsp;
                                <a href="#" class="confirm-delete" data-id="<?php echo $users_item['UsersId'];?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </td>             
                    </tr>
                    
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            <?php } else {  ?>
                 <h3>No Users found</h3>                
            <?php } ?>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    //Transform the HTML table in a fancy datatable
    $('#users').dataTable({
		stateSave: true
    });

    $('.confirm-delete').click(function() {
        var id = $(this).data('id');
        bootbox.confirm("Are you sure that you want to delete this user?", function(result) {
            if (result) {
                document.location = '<?php echo base_url();?>studentsusers/delete/' + id;
            }
        });
    });
});
</script>
