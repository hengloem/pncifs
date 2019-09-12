<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <!--for dynamic year in the title-->
            <?php 
                    $year = $batch_data[0]['Year'];
                    foreach($batch_data as $batch) 
                    {
                        if ($batch['Id'] == $this->input->post('batch')) {
                            $year = $batch['Year'];
                        }
                    }
            ?> 
            <h2>List of survey in batch <?php echo $year; ?></h2><hr/>
            <div class="table-responsive">
                <form action="<?php echo base_url() ?>view_student_survey/index" method="post">
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
                                <?php 
                                //$batch declared for store an Id = 0;
                                $batch = 0;
                                //if $_SESSION has selected, compare current id with new id that we are selected
                                if($_SESSION['current_select'] != ""){
                                    $batch = $_SESSION['current_select'];
                                }
                                //if $batch_data == TRUE, printed
                                if ($batch_data != "" && $batch_data!= null) { ?>
                                    <?php foreach ($batch_data as $batchs) {
                                        ?>
                                        <option <?php if ($batchs['Id'] == $batch) echo 'selected'; ?> value = "<?php echo $batchs['Id'];?>"> 
                                            <!--show result-->
                                            <?php echo $batchs['Year'];?>
                                        </option> 
                                <?php 
                                    }
                                }else{
                                    echo "No record found!";
                                }
                                ?>
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
               <!--list drop down for survey-->
                <form action="<?php echo base_url() ?>view_student_survey/" method="post">
                    <div class="form-group ">
                        <div class="col-md-12">
                            <label class="control-label requiredField" for="batch">
                                Select a survey
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                        </div>
                        <div class="col-md-5">
                            <select class="select form-control" id="survey" name="survey">
                                <?php 
                                //$batch declared for store an Id = 0;
                                $survey = 0;
                                //if $_SESSION has selected, compare current id with new id that we are selected
                                if($_SESSION['get_select'] != ""){
                                    $survey = $_SESSION['get_select'];
                                }
                                //if $batch_data == TRUE, printed
                                if ($survey_byBatch != "") { ?>
                                    <?php foreach ($survey_byBatch as $SurveyBatch) {
                                        ?>
                                        <option <?php if ($SurveyBatch['Survey_Id'] == $survey) echo 'selected'; ?> value = "<?php echo $SurveyBatch['Survey_Id'];?>"> 
                                            <!--show result-->
                                            <?php echo $SurveyBatch['SurveyTitle'];?>
                                        </option> 
                                <?php 
                                    }
                                }else{
                                    echo "No record found!";
                                }
                                ?>  
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
               <!--end of list drop down survey-->
                <table class="table table-striped table-bordered table-hover" id="batches">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Email PNC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if ($studentSurvey_data != "" && $studentSurvey_data != null ) {
                            foreach ($studentSurvey_data as $survey_value) { ?>
                                <tr>
                                    <td><?php echo $survey_value['UsersId']; ?></td>
                                    <td><?php echo $survey_value['FirstName']." ".$survey_value['LastName']; ?></td>
                                    <td><?php echo $survey_value['EmailPN']; ?></td>        
                                    <td>
                                        <a href="<?php echo base_url()?>view_student_survey/read_survey/<?php echo $survey_value['UsersId']?>/<?php echo (isset($_POST['survey']))?$_POST['survey']:$survey_value['Survey_Id'];?>" >
                                            <button type="button" class="btn btn-info" value="" name="btnReadSurvey" >Read Survey</button>
                                             
                                        </a>
                                    </td>
                                            
                                </tr> 
                            <?php }
                        } else { ?>
                            <tr><td colspan="5">No Student found!</td></tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>   
           
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Transform the HTML table in a fancy datatable
        $('#batches').dataTable({
            stateSave: true
        });

        $('.getUncompleteSurvey').click(function () {
            var id = $(this).data('id');
            document.location = '<?php echo base_url(); ?>surveys/delete/' + id;
            });
        });

</script>


