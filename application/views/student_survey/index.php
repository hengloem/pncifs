<div class="container-fluid" id="wrap"> 
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read     ?> </b></div>

        <?php
    }
    ?>
    <div class="container-fluid" id="wrap">
        <div class="row-fluid">
            <div class="col-md-12"> 
                <h2>New survey <sup><span class="control-label" style="color: red; font-size: 15px;">New</span></sup></h2><hr/>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="new_survey">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Survey Type</th>
                                <th>Deadline</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($student_survey != "") { ?>
                                <?php foreach ($student_survey as $survey_select) { ?>
                                    <?php if ($survey_select['IsPublish'] == 1 && $survey_select['IsAnswer'] != 1): ?>
                                        <tr>
                                    <input type="hidden" name="user_id[]" value="<?php echo $survey_select['Survey_Id']; ?>">
                                    <td><?php echo $survey_select['Survey_Id']; ?></td>
                                    <td><?php echo $survey_select['SurveyTitle']; ?></td>
                                    <td><?php echo $survey_select['Description']; ?></td> 
                                    <td><?php echo $survey_select['Name']; ?></td>    
                                    <td><?php echo $survey_select['Deadline']; ?></td>          
                                    <td>
                                        <?php if ($survey_select['IsSave'] != 1) { ?>
                                            <a href="#" data-id="<?php echo $survey_select['Survey_Id']; ?>" class="btn btn-success btn-sm confirm-answer btnsm" style="background-color:red;border-color: red;"> &nbsp;&nbsp;Answer</a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url(); ?>StudentSurveys/edit/<?php echo $survey_select['Survey_Id']; ?>" data-id="<?php echo $survey_select['Survey_Id']; ?>" class="btn btn-success btn-sm confirm-continue btnsm" style="background-color:blue;border-color: blue;"> &nbsp;&nbsp;Continue</a>
                                        <?php } ?>
                                    </td>
                                    </tr>
                                <?php endif; ?>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                //Transform the HTML table in a fancy datatable
                $('#new_survey').dataTable({
                    stateSave: true
                });
                $('.confirm-answer').click(function () {
                    var id = $(this).data('id');
                    bootbox.confirm({
                        title: "Make sure!",
                        message: "Are you sure that you want to answer the survey?",
                        buttons: {
                            cancel: {
                                label: '<i class="fa fa-times"></i> Cancel'
                            },
                            confirm: {
                                label: '<i class="fa fa-check"></i> Confirm'
                            }
                        },
                        callback: function (result) {
                            if (result) {
                                document.location = '<?php echo base_url(); ?>StudentSurveys/c_answer/' + id;
                            }
                        }
                    });
                });

                $('.btns').click(function () {
                    $('.btnsm').remove();

                });
            });
        </script>
        <!--//table store the done survey-->
        <div class="row-fluid">
            <div class="col-md-12"> 
                <h2>Completed survey <sup><span class="control-label" style="color: green; font-size: 15px;">Done</span></sup></h2><hr/>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="survey_done">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Survey Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($get_done_survey_data != "") { ?>   
                                <?php foreach ($get_done_survey_data as $survey_done) { ?> 
                                    <tr>
                                <input type="hidden" name="user_id[]" value="<?php echo $survey_done['Survey_Id']; ?>">
                                <td><?php echo $survey_done['Survey_Id']; ?></td>
                                <td><?php echo $survey_done['SurveyTitle']; ?></td>
                                <td><?php echo $survey_done['Description']; ?></td> 
                                <td><?php echo $survey_done['Name']; ?></td>    
                                <td><?php echo $survey_done['Deadline']; ?></td>          
                                <td>
                                    <p class="btn btn-success btn-sm">Done</p>
                                </td>                               
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>You are not done at least one survey.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        $(document).ready(function () {
            //Transform the HTML table in a fancy datatable
            $('#survey_done').dataTable({
                stateSave: true
            });
        });
    </script>


