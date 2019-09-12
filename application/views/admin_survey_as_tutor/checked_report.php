<style>
    #users tr{background-color: lightblue;}
    #txtarea {pointer-events: none;resize: none;}
</style>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-heading">
                    <h3 class="panel-title">Check survey information</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if ($checked_surveys_data != "") {
                        foreach ($checked_surveys_data as $checked_survey_row) {
                            $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                            echo form_open('SurveysByTutor/#/' . $checked_survey_row['Survey_Id'], $attributes);
                            ?>
                            <div class="form-group">
                                <label for="Username" class="col-sm-3 control-label">Student Name : </label>
                                <div class="col-sm-9" style="text-transform: uppercase;">
                                    <p name="Username"><?php echo set_value('Username', $checked_survey_row['FirstName'] . ' ' . $checked_survey_row['LastName']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="SurveyTitle" class="col-sm-3 control-label">Survey title : </label>
                                <div class="col-sm-9">
                                    <p name="SurveyTitle"><?php echo set_value('SurveyTitle', $checked_survey_row['SurveyTitle']); ?></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Description" class="col-sm-3 control-label">Description : </label>
                                <div class="col-sm-9">
                                    <p name="Description"><?php echo set_value('Description', $checked_survey_row['Description']); ?></p>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="Surveytype" class="col-sm-3 control-label">Survey type : </label>
                                <div class="col-sm-9">
                                    <p name="Name"><?php echo set_value('Name', $checked_survey_row['Name']); ?></p>
                                </div>
                            </div>
                            <!--For each questions -> list question -->
                            <div class="row-fluid">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <br>
                                        <table class="table table-striped table-bordered table-hover" id="users">
                                            <thead>
                                                <th>Id</th>
                                                <th>Question title</th>
                                                <th>Answer</th>
                                                <th>Comment</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($checked_questions_data != "") {
                                                    $id = 1;
                                                    foreach ($checked_questions_data as $question_row) {
                                                        ?>
                                                        <tr>
                                                            <input type="hidden" value='<?php echo $question_row['QuestionId']; ?>' name="userSurveyId"> 
                                                            <td><?php echo $id; ?></td>
                                                            <td>
                                                                <!--TRUE: show asterisk mark as a subscript to make that question *Important-->
                                                                <?php echo $question_row['QuestionTitle']; ?>
                                                                <?php if ($question_row['Ismandatory'] == 1): ?>
                                                                    <span style="color: red; font-size: 20px;">*</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <!--special point : Student's answer-->
                                                                <?php foreach ($checked_answers_data as $answer_row): ?>
                                                                    <?php if ($question_row['QuestionId'] == $answer_row['AnswerId'] && $answer_row['Isreturn'] == 1): ?>
                                                                        <?php echo $answer_row['AnswerText'] ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </td>
                                                            <td>
                                                                <?php foreach ($checked_report_data as $report_row): ?>
                                                                    <?php if ($question_row['QuestionId'] == $report_row['Answers_Id'] && $report_row['IsReport'] == 1): ?>
                                                                        <?php echo $report_row['ReportsText'];?>
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
                                    <a href="<?php echo base_url(); ?>surveysbytutor" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Back</a>
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