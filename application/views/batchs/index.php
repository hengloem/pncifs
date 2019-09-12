<?php ?>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>List of Batches</h2><hr/>
            <?php if (count($batches) != 0) { ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="batches">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Year</th>
                                <th>Internship Start Date</th>
                                <th>Internship End Date</th>
                                <th>Code</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($batches as $batch) { ?> 
                                <tr>
                                    <td><?php echo $batch['Id'] ?></td>
                                    <td><?php echo $batch['Year'] ?></td>
                                    <td><?php echo $batch['InternshipStartDate'] ?></td>
                                    <td><?php echo $batch['InternshipEndDate'] ?></td>   
                                    <td><?php echo $batch['Code'] ?></td>     
                                    <td data-order="<?php echo $batch['Id']; ?>">                            
                                        <div class="">
                                            <a href="<?php echo base_url(); ?>batchs/edit/<?php echo $batch['Id'] ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                            &nbsp;
                                        </div>
                                    </td>             
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <h3>No batches found</h3>                
            <?php } ?>
                <p><strong>Note*:</strong>&nbsp;&nbsp;The tutor can only delete batch that no student in it.</p>
            <a class="btn btn-info" href="<?php echo base_url(); ?>batchs/add">Create one</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Transform the HTML table in a fancy datatable
        $('#batches').dataTable({
            stateSave: true
        });

        $('.confirm-delete').click(function () {
            var id = $(this).data('id');
            bootbox.confirm("Are you sure that you want to delete this batch?", function (result) {
                if (result) {
                    document.location = '<?php echo base_url(); ?>batchs/delete/' + id;
                }
            });
        });

    });
</script>

