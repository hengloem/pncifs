<head> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
    <style>  
        #field {
            margin-bottom:20px;
        }
        #question_box {
            cursor: move; /* fallback if grab cursor is unsupported */
            cursor: grab;
            cursor: -moz-grab;
            cursor: -webkit-grab;
            margin: 0 auto;
        }
        #question_box tr {
            background: pink;
        } 
        #question_box tr:hover {
            background: lightblue;
        }
        .no-border {
            border: 0;
            box-shadow: none; /* You may want to include this as bootstrap applies these styles too */
        }
        #btn_add {
            position: relative;
            left: 550px;
            top: -34px;
        }

    </style> 
</head>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Create new Survey</h2><hr/>
            <div class="login-panel panel panel-default" style="margin-top: 5%;">
                <div class="panel-body"> 
                    <!--//-->
                    <form class="form-horizontal" action="<?php echo base_url() ?>surveys/check_error" method="post">

                        <div class="form-group col-md-10">
                            <label for="title" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9"  style="color:red;">
                                <input type="text" class="form-control" name="title" id="title"  
                                       value="<?php echo set_value('title', $this->input->post('title')); ?>"    />
                                       <?php echo form_error('title') ?>
                            </div>
                        </div>

                        <div class="form-group  col-md-10">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9" style="color:red;">  
                                <textarea name="description" class="form-control" rows="3"  value="<?php echo set_value('description', $this->input->post('description')); ?>" ></textarea>
                                <?php echo form_error('description') ?>
                            </div>
                        </div>

                        <div class="form-group  col-md-10">
                            <label for="surveyType" class="col-sm-3 control-label">Survey Type</label>
                            <div class="col-sm-9"  >
                                <select name="surveyType" class="form-control">
                                    <?php foreach ($survey_type as $row) { ?>
                                        <option value="<?php echo $row['Id']; ?>"><?php echo $row['Name']; ?></option> 
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group  col-md-10">
                            <label for="password" class="col-sm-3 control-label">Deadline</label>
                            <div class="col-sm-9"  style="color:red;">  
                                <input type="text" id="startdate" name="deadline" class="form-control" 
                                       value="<?php echo set_value('deadline'); ?>" /> 
                                       <?php echo form_error('deadline') ?>
                            </div>
                        </div> 
                        <div class="form-group  col-md-10">
                            <label for="batch" class="col-sm-3 control-label">Batch</label>
                            <div class="col-sm-9"> 
                                <select class="select form-control" id="select" name="batch">
                                    <?php foreach ($batch_data as $batchs) { ?>
                                        <option value="<?php echo $batchs['Id'] ?>"><?php echo $batchs['Year'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group  col-md-10">
                            <label for="" class="col-sm-3 control-label">Question</label>
                            <div class="col-sm-9">   
                                <textarea  class="form-control" rows="2" id="question"></textarea>
                                <div id="error_ques" style="color:red;"></div> 
                                <button type="button" class="btn btn-primary"  id="btn_add" value="Create" onclick="question_fields();">
                                    <span class="glyphicon glyphicon-plus-sign glyphicon-white"></span>
                                </button> 
                            </div>

                        </div>
                        <div  class="form-group col-md-12" id="question_box"> 
                            <h1>Question</h1>

                        </div>
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp; Save</button>
                                <button type="submit" class="btn btn-success"   name="publish" value="1"> <span class="glyphicon glyphicon-share glyphicon-white"></span>&nbsp; Publish</button>

                                <a href="<?php echo base_url(); ?>surveys/" class="btn btn-danger" name="cancel"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div> 
        </div>
    </div> 
</div>  
 <!-- jQuery ui-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script>
    var i = 0;
    var q = 0;
    function question_fields() {
        q++;

        var objTo = document.getElementById('question_box')
        var divtest = document.createElement("table");
        divtest.setAttribute("class", "table table-striped table-bordered table-hover form-group removeclass" + q);
        var rdiv = 'removeclass' + q;
        var title_question = document.getElementById('question').value;
        if (title_question != '') {
            i++;
            var q_number = i;
            var isMandatory = '<input type="checkbox" value="1" id="man_id" name="status_' + i + '"><label for="man_id">Mandatory</>';
            divtest.innerHTML = '<tr  ><td class="col-md-1" ><input class="form-control no-border"  name="ques_id[]" type="text" value="' + q_number + '"></td>\n\
        <td  class="col-md-8"><input class="form-control no-border" name="ques[]" type="textarea" value="' + title_question + '"></td>\n\
        <td  class="col-md-2">' + isMandatory + '</td></tr>';
            document.getElementById('error_ques').innerHTML = '';
            objTo.appendChild(divtest);
        } else {
            document.getElementById('error_ques').innerHTML = 'Please input your question.';
        }
    }
    function remove_question_fields(qid) {
        $('.removeclass' + qid).remove();
    }
    function confirm_delete() {
        alert('hello');
    }
    function move_down() {
        alert('hello down');
    }

</script>
<script type="text/javascript">
    $(function () {

        /// this is for order question by drag and drop.
        $("#question_box").sortable();
//        $("#question_box").disableSelection();

        $("#startdate").datepicker();
        $("#startdate").datepicker("option", "dateFormat", "yy-mm-dd");
    });
</script>
