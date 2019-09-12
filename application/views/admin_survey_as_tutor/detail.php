<style>
    #users tr{background-color: lightblue;}
    #txtarea {pointer-events: none;resize: none;}
</style>
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
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Preview survey information</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($surveys_data != "") {
                        foreach ($surveys_data as $survey_value) {
                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            echo form_open('Survey_by_admin/c_process_submit/' . $survey_value['Survey_Id'], $attributes);
                            ?> 
                            <input type="hidden" name="id" value="<?php echo $survey_value['Survey_Id']; ?>"  /><br />

                            <div class="form-group">
                                <label for="Username" class="col-sm-3 control-label">Student Name : </label>
                                <div class="col-sm-9" style="text-transform: uppercase;">
                                    <p name="Username"><?php echo set_value('Username', $survey_value['FirstName'] . ' ' . $survey_value['LastName']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="SurveyTitle" class="col-sm-3 control-label">Survey title : </label>
                                <div class="col-sm-9">
                                    <p name="SurveyTitle"><?php echo set_value('SurveyTitle', $survey_value['SurveyTitle']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Description" class="col-sm-3 control-label">Description : </label>
                                <div class="col-sm-9">
                                    <p name="Description"><?php echo set_value('Description', $survey_value['Description']); ?></p>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="Surveytype" class="col-sm-3 control-label">Survey type : </label>
                                <div class="col-sm-9">
                                    <p name="Name"><?php echo set_value('Name', $survey_value['Name']); ?></p>
                                </div>
                            </div>  

                            <div class="form-group" >
                                <label for="Deadline" class="col-sm-3 control-label">Deadline : </label>
                                <div class="col-sm-9" style="color: red;">
                                    <p name="Deadline"><?php echo set_value('Deadline', $survey_value['Deadline']); ?> </p>
                                </div>
                            </div>
                            <!--For each questions -> list question -->
                            <div class="row-fluid">
                                <div class="col-md-12">
                                    <label>List of questions with answers : </label>
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-striped table-bordered table-hover" id="users">
                                            <!--<thead>-->
                                                <!--<tr>-->
                                                    <!--<th></th>-->
                                            <!--</tr>-->
                                            <!--</thead>-->
                                            <tbody>
                                                <?php
                                                if ($questions_data != "") {
                                                    $id = 1;
                                                    foreach ($questions_data as $question_row) {
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" value='<?php echo $question_row['QuestionId']; ?>' name="userSurveyId"> 
                                                            <td><?php echo '<b>' . $id . '. ' . $question_row['QuestionTitle'] . '</b>'; ?>
                                                                <!--TRUE: show asterisk mark as a subscript to make that question *Important-->
                                                                <?php if ($question_row['Ismandatory'] == 1): ?>
                                                                    <span style="color: red; font-size: 20px;">*</span>
                                                                <?php endif; ?>

                                                                <!--special point : Student's answer-->
                                                                <?php foreach ($answers_data as $answer_row): ?>
                                                                    <?php if ($question_row['QuestionId'] == $answer_row['AnswersId'] && $answer_row['Isreturn'] == 1): ?>
                                                                        <textarea id="txtarea" name="AnswerTitle" class="form-control"><?php echo $answer_row['AnswerText'] ?></textarea>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </td>
                                                            <td>
                                                                <?php foreach ($answers_data as $answer_row): ?>
                                                                    <?php if ($question_row['QuestionId'] == $answer_row['AnswersId'] && $answer_row['Isreturn'] == 1): ?>
                                                                        <a href="#" data-id="<?php echo $question_row['QuestionId']; ?>" title="Report issue" class="btn btn-danger getQuestionId" data-toggle="modal" data-target="#<?php echo $question_row['QuestionId']; ?>" >
                                                                            <span>Report</span></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                $id ++;    }
                                                
                                                } else {
                                                    echo "<tr><td colspan='4'>No recode found..!</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--End of for each list question-->
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <a href="<?php echo base_url(); ?>Survey_by_admin/c_process_submit/<?php echo $survey_value['Survey_Id'];?>" >
                                        <button type="submit" class="btn btn-success" value="1"><span class="glyphicon glyphicon-share glyphicon-white"></span>&nbsp;Submit</button> 
                                    </a> 
                                    <a href="<?php echo base_url(); ?>Survey_by_admin" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Back</a>
                                </div>
                            </div>
                            </form>
                        <?php
                        }
                    } else {
                        echo "No record found..!";
                    }
                    ?>
                </div>
                <!-- Modal -->
               <?php
                if ($questions_data != "" && $answers_data != "") {
                foreach ($questions_data as $question_row) {
                    foreach($answers_data as $answer_row){
                    $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                    //form : action='url'
                    echo form_open('Survey_by_admin/c_process_report/' .$question_row['QuestionId'], $attributes);
                ?>
                <input type="hidden" value='<?php echo $question_row['QuestionId']; ?>' name="questionIdHidden">                
                <div class="modal fade" id="<?php echo $question_row['QuestionId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Report</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="QuestionTitle" class="col-sm-3 control-label">Question</label>
                                    <div class="col-sm-9">
                                        <p  name="QuestionTitle"><?php echo set_value('QuestionTitle', $question_row['QuestionTitle']); ?>
                                            <?php if ($question_row['Ismandatory'] == 1): ?>
                                                <span style="color: red; font-size: 20px;">*</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="QuestionTitle" class="col-sm-3 control-label">Answer</label>
                                    <div class="col-sm-9">
                                        <?php if ($question_row['QuestionId'] == $answer_row['AnswersId'] && $answer_row['Isreturn'] == 1): ?>
                                            <p name="AnswerTitle"><?php echo set_value('AnswerTitle', $answer_row['AnswerText']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <textarea style="resize: none;" rows="5" name="ReportsText" placeholder="Leave a comment here..." placeholder-no-fix class="form-control ReportsText" id="ReportsText" 
                                          value=" <?php echo set_value('ReportsText', $this->input->post('ReportsText')); ?>" required="TRUE"></textarea>
                                          <?php echo form_error('ReportsText')?>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" id="submit_report"  onclick="submitForm()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <?php }}}?>
            <!--end of get modal-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function submitForm() {
        document.contact-form.submit();
        document.contact-form.reset();
    }
    $(document).ready(function () {
        $('.getQuestionId').click(function () {
            var id = $(this).data('id');//alert(id);
            $('#myModal').modal('show');
            //end of onclick
        });
        // end of .ready
    });
</script>