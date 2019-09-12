<style>
    #chAll input {
        width:10px;
        height: 10px;
    } 
    textarea {
        width:200px;
        resize:none;
        overflow:hidden;
        font-size:18px;
        height:1.1em;
        padding:2px;
    }
</style>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h1>Student not complete survey</h1>
            <hr>
            <form action="<?php echo base_url() ?>reminder_admin/index" method="post">
                <table class="table table-striped table-bordered table-hover" id="tbl_stu">
                    <thead> 
                        <tr>
                            <th>No</th>
                            <th>Name</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody > 
                        <?php if ($stu_data != "" && $stu_data != null) { ?>
                            <?php foreach ($stu_data as $value) { ?>
                                <tr> 
                            <input type="hidden" name="emailHidden" value="<?php echo $value['EmailPN'] ?>" > 
                            <td class="col-md-1"><?php echo $value['UsersId'] ?></td> 
                            <td><?php echo $value['FirstName'] . " " . $value['LastName'] ?></td> 
                            <td>
                                <a href="<?php echo base_url() ?>reminder_admin/get_survey_data/<?php echo $value['UsersId'] ?>" id="popUp"  > <span class="glyphicon glyphicon-eye-open"></span>  </a>&nbsp;&nbsp; 
                                <input type="checkbox" class="check" id="chEmail" name="chSend[]" value="<?php echo $value['UsersId'] ?>">
                            </td>
                            </tr> 
                        <?php }
                    } else { ?> 
                        <tr>
                            <td colspan="5">No record found !</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="form-group ">
                    <div class="col-sm-12">
                        <button  data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary" value="Submit"> <span class="glyphicon glyphicon-send glyphicon-white"></span>&nbsp; Send all</button>
                        <button  class="btn btn-success"  id="sendSelect" name="sendSelect" type="button" value="1"> <span class="glyphicon glyphicon-send glyphicon-white"></span>&nbsp; Send selected</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>  
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" >
        <div class="modal-dialog">
            <form action="<?php echo base_url() ?>reminder_admin/c_send_reminder" method="post">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Send Reminder</h4>
                    </div>
                    <div class="modal-body"> 
                        <div class="row">
                            <div class="col-sm-2"><label>Subject</lsabel></div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="2" name="subject"></textarea>
                            </div> 
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-2"><label>Message</label></div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="message"></textarea>
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"  >Send</button> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!--Modal for send selected-->
    <div class="modal fade" id="sendSelectModal" role="dialog" >
        <div class="modal-dialog">
            <form action="<?php echo base_url() ?>reminder_admin/c_send_reminder_select" method="post">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Send Reminder</h4>
                    </div>
                    <div class="modal-body"> 
                        <div id="stu_email_div"></div>
                        <div class="row">
                            <div class="col-sm-2"><label>Subject</label></div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="2" name="subject"></textarea>
                            </div> 
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-2"><label>Message</label></div>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="message"></textarea>
                                <!--<input type="textarea" rows="5" class="form-control">-->
                            </div> 
                        </div>
                    </div>
                    <!--<input type="hidden" name="emailStu[]" id="stuSelectEmail">-->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"  >Send</button> 
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Transform the HTML table in a fancy datatable
        $('#tbl_stu').dataTable({
            stateSave: true
        });
        var i = 0;
        $('.check').click(function () {
            if ($(this).is(":checked")) {
                var c = $(this).val();

                document.getElementById('stu_email_div').innerHTML += '<input id="c_' + i + '" type="hidden" name="emailStu[]" value=' + c + '>';
            } else if ($(this).is(":not(:checked)")) {
                var currentId = '#c_' + (i - 1);
                $(currentId).remove();
            }
            i = i + 1;
        });
    });

    $('#sendSelect').click(function () {
        $('#sendSelectModal').modal('show');
    });
</script>