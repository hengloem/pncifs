<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <?php
            $year = $batch_data[0]['Year'];
            foreach ($batch_data as $batch) {
                if ($batch['Id'] == $this->input->post('batch')) {
                    $year = $batch['Year'];
                }
            }
            ?> 
            <h2>Survey of a batch: <?php echo $year; ?></h2><hr/>
            <div class="table-responsive">
                <form action="<?php echo base_url() ?>surveys/index" method="post">
                    <div class="form-group ">
                        <div class="col-md-12">
                            <label class="control-label requiredField" for="batch">
                                Select a Batch
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <select class="select form-control" id="batch" name="batch">
<?php foreach ($batch_data as $batchs) { ?>
                                    <option value="<?php echo $batchs['Id'] ?>" <?php echo ($batchs['Id'] == $this->input->post('batch')) ? 'selected' : '' ?>><?php echo $batchs['Year'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary " name="submit" type="submit">
                                    Filter
                                </button>
                            </div>
                        </div> 
                    </div>
                </form>
                <table class="table table-striped table-bordered table-hover" id="batches">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Deadline</th> 
                            <th>Publish</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if ($survey_data != "") {
                            foreach ($survey_data as $survey_value) {
                                ?>
                                <tr>
                                    <td><?php echo $survey_value['Survey_Id']; ?></td>
                                    <td><?php echo $survey_value['SurveyTitle']; ?></td>
                                    <td><?php echo $survey_value['Description']; ?></td>
                                    <td><?php echo $survey_value['Deadline']; ?></td>  
                                    <td><?php echo ($survey_value['IsPublish'] == '1') ? 'Yes' : 'No'; ?></td>
                                    <td data-order="1">                            
                                        <div class="">
                                            <a href="<?php echo base_url(); ?>surveys/detail/<?php echo $survey_value['Survey_Id'] ?>" title="preview the question"><span class="glyphicon glyphicon-eye-open"></span></a>
                                            &nbsp;
                                            <a href="<?php echo base_url(); ?>surveys/edit/<?php echo $survey_value['Survey_Id']; ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                                            &nbsp;

                                            <a href="#" class="confirm-delete" data-id="<?php echo $survey_value['Survey_Id']; ?>"  class="confirm-delete" data-id="<?php echo 1; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                                        </div>
                                    </td>             
                                </tr> 
                            <?php }
                        } else {
                            ?>
                            <tr><td colspan="5">No Survey found!</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>   
            <a class="btn btn-info" href="<?php echo base_url(); ?>surveys/add">Create one</a>
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
            bootbox.confirm("Are you sure that you want to delete this Survey?", function (result) {
                if (result) {
                    document.location = '<?php echo base_url(); ?>surveys/delete/' + id;
                }
            });
        });

    });
</script>

