<style>
    .no-border {
        border: 0;
        box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
    }
    #btn_create_ques {
        position: relative;
        left: 450px;
        top: -36px;
        
    }
    #row_question tr{
        background: lightblue;
    }
    #ques_edit tr{
        background: pink;
    }
</style>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h1>Edit Survey</h1>
            <hr>
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-body">
                    <?php foreach ($survey_data as $sur_value) { ?>
                        <form action="<?php echo base_url() ?>surveys/c_process_edit/<?php echo $sur_value['Survey_Id'] ?>" method="post">

                            <div class="form-group col-md-8">
                                <label for="FirstName" class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9"  >
                                    <input type="text" class="form-control" name="title" value="<?php echo $sur_value['SurveyTitle']; ?>" >
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="surveyType" class="col-sm-3 control-label">Type</label>
                                <div class="col-sm-9"  >  

                                    <select class="select form-control" id="select" name="surveyType">
                                        <?php foreach ($survey_type as $sur_type) { ?>
                                            <option value="<?php echo $sur_type['Id'] ?>" <?php echo ($sur_value['SurveyTypesId'] == $sur_type['Id']) ? 'selected' : ''; ?>><?php echo $sur_type['Name'] ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="batch" class="col-sm-3 control-label">In Batch</label>
                                <div class="col-sm-9" > 

                                    <select class="select form-control" id="select" name="batch">
                                        <?php foreach ($batch_data as $batch_value) { ?>
                                            <option value="<?php echo $batch_value['Id'] ?>" <?php echo ($sur_value['BatchId'] == $batch_value['Id']) ? 'selected' : ''; ?>><?php echo $batch_value['Year'] ?></option>
                                        <?php } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="description" class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9" > 
                                    <textarea name="description" class="form-control" rows="3"  value="<?php echo $sur_value['Description']; ?>" ><?php echo $sur_value['Description']; ?></textarea>
                                    <?php echo form_error('description') ?> 
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="deadline" class="col-sm-3 control-label">Deadline</label>
                                <div class="col-sm-9"  style="color:red;">
                                    <input type="text" class="form-control" value="<?php echo $sur_value['Deadline'] ?>" name="deadline" >
                                </div>
                            </div><br/>
                            <div class="form-group  col-md-8">
                                <label for="" class="col-sm-3 control-label">Question</label>
                                <div class="col-sm-9">   
                                    <textarea  class="form-control" rows="2" id="question"></textarea>
                                    <button  id="btn_create_ques" type="button" class="btn btn-primary "  ><span class="glyphicon glyphicon-plus-sign glyphicon-white"></span></button>
                                    
                                    <div id="error_ques" style="color:red;"></div> 
                                </div> 

                            </div>
                        <?php } ?> 
                            <table class="table table-striped table-bordered table-hover" id="ques_edit">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Question</th> 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $i=0;
                                if ($question_data != "" && $question_data != null) {
                                    foreach ($question_data as $ques_value) {
                                        $i++;
                                        ?>
                                   

                                    <tr>
                                        <input type="hidden" name="ques_id[]" value="<?php echo $ques_value['QuestionId'] ?>" >
                                        <td class="col-md-1"> <?php echo $ques_value['Order']; ?></td> 
                                        <td><input class="form-control no-border col-md-9" type="text" name="question[]" value="<?php echo $ques_value['QuestionTitle'] ?>"></td> 
                                        <td><input id="mandChck<?php echo $ques_value['QuestionId'] ?>" class="col-md-2" type="checkbox" value="1" <?php echo ($ques_value['Ismandatory'] == 1) ? 'checked' : ''; ?> name="IsMan_<?php echo $i;?>" onchange="updateHiddenField(<?php echo $ques_value['QuestionId'] ?>)"><label>Mandatory</label></td>
                                        <input id="mandHidden<?php echo $ques_value['QuestionId'] ?>" type="hidden" name="isMand[]" value="<?php echo $ques_value['Ismandatory'] ?>" >
                            </tr> 
                                    <?php
                                }
                            } else {
                                ?>
                                <tr><td colspan="5"><?php echo 'This survey did not have question yet!'; ?></td></tr>
                            <?php } ?>  
                                    <table id="row_question" class="table table-striped table-bordered table-hover">
                                       
                                    </table>
 
                            </tbody>
                        </table>
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button>
                                <button type="submit" class="btn btn-success"   name="publish" value="1"> <span class="glyphicon glyphicon-share glyphicon-white"></span>&nbsp; Publish</button>
                                <a href="<?php echo base_url(); ?>surveys" class="btn btn-danger"  ><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var newId = -1;
    $(function(){
         $('#btn_create_ques').click(function(){  
                var table_row = '<tr><input type="hidden" name="ques_id[]" value='+ newId + '><td class="col-md-1"></td><td><input name="question[]" type="text" class="form-control no-border" value="'+$('#question').val()+'"</td><td><input id="mandChck' + newId + '" class="col-md-2" type="checkbox" name="IsMan_' + newId + '" value="1" onchange="updateHiddenField('+ newId + ')"><label>Mandatory</label></td><input id="mandHidden'+ newId + '" type="hidden" name="isMand[]" value="0" ></tr>';
               $('#row_question').append(table_row);
               newId--;
    });
    })
    
    function updateHiddenField(questionId){
        var isChecked = $('#mandChck'+questionId).is(':checked');
        $('#mandHidden'+questionId).val( isChecked ? '1' : '0' );
    }
    
</script>