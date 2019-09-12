<div class="container-fluid" id="wrap">
    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
        <div id="flash-inner-message" class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <b> <?php echo $this->session->flashdata('sms'); ////read    ?> </b></div>

        <?php
    }
    ?>
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Surveys Follow-up</h2><hr/>
            <!-- Search student that tutors follow up -->
            <form method="POST" action="<?php echo base_url(); ?>surveysbytutor" name="getstudent">
                <div class="form-group">
                    <label class="control-label requiredField" for="select">Select your's student<span class="asteriskField">*</span></label>
                    <select class="select form-control" id="select" name="select">
                        <?php
                        //$student declared for store an Id = 0;
                        $student = 0;
                        //if $_SESSION has selected, compare current id with new id that we are selected
                        if ($_SESSION['current_select'] != "") {
                            $student = $_SESSION['current_select'];
                        }
                        //if $batch_data == TRUE, printed
                        if ($tutor_student_data != "") {
                            ?>
                        <?php foreach ($tutor_student_data as $student_row) { ?>
                                <option <?php if ($student_row['Id'] == $student) echo 'selected'; ?> value = "<?php echo $student_row['Id']; ?>"> 
                                    <!--show result-->
                                <?php echo $student_row['FirstName'] . ' ' . $student_row['LastName']; ?>
                                </option>
                                <?php
                            }
                        }else {
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
            </form>
            <br/><br/>
            <!--End of filter-->
            <!--New survey-->
            <label class="control-label" style="color: red;">Student's new survey</label> 
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="new_survey">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Survey title</th>
                            <th>Description</th>
                            <th>Type of survey</th>
                            <th>Deadline</th>
                            <th>Batch</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($student_survey_data != "") {
                            foreach ($student_survey_data as $survey_row) {
                                ?>
                            <input type="hidden" value='<?php echo $survey_row['UsersId']; ?>' name="userSurveyId"> 
                            <tr>
                                <td><?php echo $survey_row['Survey_Id'] ?></td>
                                <td><?php echo $survey_row['SurveyTitle'] ?></td>                   
                                <td><?php echo $survey_row['Description'] ?></td> 
                                <!--$survey_row['Name'] : survey type name-->
                                <td><?php echo $survey_row['Name'] ?></td> 
                                <td><?php echo $survey_row['Deadline'] ?></td>
                                <td><?php echo $survey_row['Year'] ?></td>
                                <td data-order="1">
                                    <div>

                                        <a href="<?php echo base_url(); ?>surveysbytutor/c_preview_survey_detail/<?php echo $survey_row['Survey_Id'] . '/' . $survey_row['UsersId'] ?>" title="Preview"><span class="glyphicon glyphicon-eye-open"></span></a>
                                    </div>
                                </td>             
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>You are not yet associate with student..!</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <br/>
            <!--Done survey-->
            <label class="control-label" style="color: red;">student's completed survey</label> 
            <div class="table-responsive">
                <br>
                <table class="table table-striped table-bordered table-hover" id="done_survey">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Survey title</th>
                            <th>Description</th>
                            <th>Type of survey</th>
                            <th>Batch</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tutor_checked_survey_data != "") {
                            foreach ($tutor_checked_survey_data as $survey_row) {
                                ?>
                            <input type="hidden" value='<?php echo $survey_row['UsersId']; ?>' name="userSurveyId">
                            <tr>
                                <td><?php echo $survey_row['Survey_Id'] ?></td>
                                <td><?php echo $survey_row['SurveyTitle'] ?></td>                   
                                <td><?php echo $survey_row['Description'] ?></td> 
                                <!--$survey_row['Name'] : survey type name-->
                                <td><?php echo $survey_row['Name'] ?></td>
                                <td><?php echo $survey_row['Year'] ?></td>
                                <td data-order="1">
                                    <div>
                                        <a href="<?php // echo base_url();  ?>surveysbytutor/c_preview_checked_survey/<?php echo $survey_row['Survey_Id'] . '/' . $survey_row['UsersId'] ?>" title="Check again"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                                    </div>
                                </td>             
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>You are not yet associate with student..!</td></tr>";
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
        $('#new_survey, #done_survey').dataTable({
            stateSave: true
        });

        $('.confirm-delete').click(function () {
            var id = $(this).data('id');
            bootbox.confirm("Are you sure that you want to delete this user?", function (result) {
                if (result) {
                    document.location = '<?php echo base_url(); ?>surveysbytutor/c_delete_supervisor/' + id;
                }
            });
        });

    });
</script>
