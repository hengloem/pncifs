<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Tutor surveys follow-up <?php $ses_year = $this->session->userdata('ses_year'); ?></h2>
            <hr>
            <div class="table-responsive">
                <form action="<?php echo base_url() . 'tutor_follow_by_admin/get_filter_tutor'; ?>" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label requiredField" for="batch">Select a batch<span class="asteriskField">*</span></label>
                        </div>
                        <div class="col-md-5">
                            <select class="select form-control" id="batch" name="batch">
                                <?php foreach ($year as $batchs) { ?>
                                    <option value="<?php echo $batchs['Id'] ?>"  <?php echo ($batchs['Id'] == $ses_year) ? 'selected' : ''; ?>><?php echo $batchs['Year'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary" name="submit" type="submit">Filter</button>
                            </div>
                        </div> 
                    </div>
                </form>
                <form action="<?php echo base_url() . 'tutor_follow_by_admin/get_student_survey'; ?>" method="post" id="SurveyForm">
                    <div class="form-group ">
                        <div class="col-md-12">
                            <label class="control-label requiredField" for="batch">Select a survey<span class="asteriskField">*</span></label>
                        </div>
                        <div class="col-md-5"> 
                            <?php $ses_sur = $this->session->userdata('ses_survey'); ?>
                            <select class="select form-control" id="survey" name="survey"> 
                                <?php if (isset($sur_by_bacth) && $sur_by_bacth != '' && $sur_by_bacth != null) { ?>
                                    <?php foreach ($sur_by_bacth as $value) { ?> 
                                        <option value="<?php echo $value['Survey_Id']; ?>" <?php echo ($value['Survey_Id'] == $ses_sur) ? 'selected' : ''; ?>><?php echo $value['SurveyTitle']; ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>  
                                    <option>No survey found!</option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php if (isset($sur_by_bacth) && $sur_by_bacth != '' && $sur_by_bacth != null) { ?>
                            <div class="form-group"> 
                                <button class="btn btn-primary " name="submit" type="submit">
                                    Filter
                                </button> 
                            </div> 
                        <?php } ?> 
                    </div>
                </form>
            </div>
            <hr>
            <p>List student with their own survey</p>
            <table class="table table-responsive table-striped table-bordered" id="users">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student name</th> 
                        <th>Survey type</th>
                        <th>Batch</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php $i = 0;
                    if (isset($stu_list) && $stu_list != '' && $stu_list != null) {
                        ?>
                        <?php foreach ($stu_list as $value) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $value['UsersId'] ?></td>
                                <td><?php echo $value['FirstName'] . '  ' . $value['LastName'] ?></td>
                                <td><?php echo $value['SurveyTitle'] ?></td>
                                <td><?php echo $value['Year'] ?></td> 
                                <td>
                                    <button name="btn_read" id="<?php $i; ?>" onclick="getId(<?php echo $value['UsersId'] ?>);" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value['Survey_Id']; ?>" value="<?php echo $value['UsersId']; ?>"><span class="glyphicon glyphicon-check"></span></button>
                                </td>
                            </tr> 
                            <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="5">No data found!</td>
                        </tr>
                        <?php } ?>
            </table>
            <!--An admin view his student -->
            <div class="container">
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">View survey (Static)</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Question</th> 
                                        <th>Answer</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>What is your internship?</td>
                                        <td>My internship is very good.</td>
                                        <td>You are hard working student.</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        $(document).ready(function () {
            //Transform the HTML table in a fancy datatable
            $('#users').dataTable({
                stateSave: true
            });
        });
    function getId($id) {
        var divId = document.getElementById('idStuHid');
        divId.innerHTML = "<input type='text' value='" + $id + "'>";
    }
</script>