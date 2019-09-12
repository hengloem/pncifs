<div class="container-flauid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="panel-group" style="margin-top:10px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>You are reading a student's survey</p>               
                    </div>
                    <div class="panel-body">
                        <!--end of heading-->
                        <!--For each questions -> list question -->
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <br>  
                                    <?php
                                    $i = 0;
                                    if ($questions_data != "" && $questions_data != null):
                                        ?>
                                        <?php
                                        foreach ($questions_data as $question_row):
                                            $i++;
                                            ?>
                                            <div class="form-group" >  
                                                <div class="col-md-12 col-sm-12">
                                                    <p  name="QuestionTitle"><b><?php echo $i; ?>.</b> &nbsp;<?php echo set_value('QuestionTitle', $question_row['QuestionTitle']); ?></p>  
                                                    <textarea rows="2" class="form-control"><?php echo $question_row['AnswerText']; ?></textarea> 
                                                    <br/>
                                                </div>
                                            </div>  
                                        <?php endforeach; ?>
                                        <br/>
                                        <a href="<?php echo base_url(); ?>view_student_survey"><button type="button" class="btn btn-danger" value="1"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp; Back</button> </a>
                                    <?php else : echo 'not survey found' ?>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!--End of for each list question-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
