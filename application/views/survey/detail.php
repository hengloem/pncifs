<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>View detail survey</h2><hr/>
            <div class="login-panel panel panel-default" style="margin-top: 2%;">
                <div class="panel-body">
                    <?php foreach ($survey_data as $sur_value) { ?>
                        <div class="form-group col-md-8">
                            <label for="FirstName" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9"  >
                                <?php echo $sur_value['SurveyTitle']; ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="FirstName" class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-9"  > 
                                <?php foreach ($survey_type as $sur_type) { ?>
                                    <?php echo ($sur_value['SurveyTypesId'] == $sur_type['Id']) ? $sur_type['Name'] : ''; ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="FirstName" class="col-sm-3 control-label">In Batch</label>
                            <div class="col-sm-9"  > 
                                <?php foreach ($batch_data as $batch_value) { ?>
                                    <?php echo ($sur_value['BatchId'] == $batch_value['Id']) ? $batch_value['Year'] : ''; ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="FirstName" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9" >
                                <?php echo $sur_value['Description']; ?>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="FirstName" class="col-sm-3 control-label">Deadline</label>
                            <div class="col-sm-9"  style="color:red;">
                                <?php echo $sur_value['Deadline']; ?>
                            </div>
                        </div><br/>
                    <?php } ?> 
                    <table class="table table-striped table-bordered table-hover" id="batches">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Question</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            if ($question_data != "" && $question_data != null) {
                                foreach ($question_data as $ques_value) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td> 
                                        <td><?php echo $ques_value['QuestionTitle']; ?></td> 
                                        <td><?php echo ($ques_value['Ismandatory'] == 1) ? 'Mandatory' : ''; ?></td>
                                    </tr> 
                                    <?php
                                }
                            } else {
                                ?>
                                <tr><td colspan="5"><?php echo 'This survey did not have question yet!'; ?></td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="<?php echo base_url(); ?>surveys/" class="btn btn-danger" ><span class="glyphicon glyphicon-arrow-left glyphicon-white"></span>&nbsp;Back</a>
                </div>
            </div>
        </div>
    </div>
</div>