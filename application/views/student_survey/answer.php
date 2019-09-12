<style>
    #users tr {
        background: lightblue;
    }
    textarea{
        resize: none;
    }
</style>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <p>You are answering to the survey :
                <?php // foreach ($description as $question_value):?>
                <?php // echo $question_value['SurveyTitle']?>
                <?php // endforeach;?>
            </p>               
        </div>
        <div class="panel-body">
            <?php
            if ($get_survey != "") {
                foreach ($get_survey as $survey_value) {
                    $attributes = array('id' => 'frmUserForm', 'class' => 'form-horizontal');
                    ?> 
                    <input type="hidden" name="id" value="<?php echo $survey_value['Survey_Id']; ?>"  /><br />

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
                    <div class="form-group" >
                        <label for="Deadline" class="col-sm-3 control-label">Deadline : </label>
                        <div class="col-sm-9" style="color: red;">
                            <p name="Deadline"><?php echo set_value('Deadline', $survey_value['Deadline']); ?> </p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <!--end of heading-->
            <!--For each questions -> list question -->
            <div class="row-fluid">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <br>  
                            <table class="table table-striped table-bordered table-hover" id="users">
                                <thead>
                                    <tr>
                                        <th>List of question and answer text :</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($get_description != "" && $get_description != null) {
                                        foreach ($get_description as $question_row) {
                                            ?>
                                            <tr>                                                
                                <form method="post" action="<?php echo base_url(); ?>StudentSurveys/c_save/<?php echo $survey_value['Survey_Id'];?>"> 
                                        <input type="hidden" value='<?php echo $question_row['QuestionId']; ?>' name="questionIdHidden[]">
                                        <input type='hidden' value="<?php echo ($question_row['Ismandatory'] == 1) ? '1' : '0' ?>" name="checkManHidden[]">
                                        <td><?php echo '<b>' . $question_row['QuestionId'] . '. ' . $question_row['QuestionTitle'] . '</b>'; ?>
                                            <!--TRUE: show asterisk mark as a subscript to make that question *Important-->
                                            <?php if ($question_row['Ismandatory'] == 1): ?>
                                                <span style="color: red;font-size: 20px;">
                                                <!--<i class="fa fa-asterisk" aria-hidden="true" title="Mandatory question"></i>-->
                                                    *
                                                </span>
                                            <?php endif; ?>
                                            <!--Answer field-->
                                            <textarea name='AnswerText[]' class="form-control" rows="2" cols="50%" <?php echo ($question_row['Ismandatory'] == 1) ? 'required' : '0' ?>></textarea>
                                             
                                        </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                        <!--Save, Submit; Cancel button-->
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white btns"></span>&nbsp; Save</button>
                                        <a href="<?php echo base_url(); ?>StudentSurveys/c_submit/<?php echo $survey_value['Survey_Id'];?>" ><button type="button"  class="btn btn-success"   name="Isreturn" value="1"> <span class="glyphicon glyphicon-share glyphicon-white"></span>&nbsp; Submit</button> </a>                                      
                                        <a href="<?php echo base_url(); ?>StudentSurveys"><button type="button" class="btn btn-danger" value="1"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Cancel</button> </a>
                                    </td>
                                </tr>
                                        <?php
                                } else {
                                    ?>
                                   <tr><td colspan='2'>No recode found..!</td></tr>
                                   <tr><td><a href="<?php echo base_url(); ?>StudentSurveys"><button type="button" class="btn btn-danger" value="1"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Cancel</button> </a></td>></tr>
                                      
                                    <?php
                                }
                                ?>                                
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <!--End of for each list question-->
        </div>
    </div>
</div>
