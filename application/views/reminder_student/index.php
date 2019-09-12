<style>
    .message {
        height: auto;
        border: 1px solid #0000004d;
        border-radius: 2px; 
        width: 100%;
        padding: 20px;
    }
</style>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h2>Survey reminder</h2><hr/>
            <div class="table-responsive"> 
                <form action="<?php echo base_url() ?>reminder_admin/index" method="post">
                    <table class="table table-striped table-bordered table-hover" id="tbl_stu">
                        <thead> 
                            <tr>
                                <th>No</th>
                                <th>Title</th> 
                                <th>Message</th> 
                                <th>Send Date</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody > 
                            <?php $i = 0;
                            if ($reminder_data != '' && $reminder_data != null) {
                                ?>
                                <?php foreach ($reminder_data as $remind_row) {
                                    $i++;
                                    ?>
                                    <tr> 
                                        <td><?php echo $i ?></td> 
                                        <td><?php echo $remind_row['subject'] ?></td>
                                        <td><?php echo $remind_row['message'] ?></td>
                                        <td><?php echo $remind_row['sendDate'] ?></td>
                                        <td>
                                            <a href="#" title="View detail" data-id="<?php echo $remind_row['reminId'] ?>" data-toggle="modal" data-target="#detail<?php echo $remind_row['reminId'] ?>"> <span class="glyphicon glyphicon-eye-open"></span>  </a>
                                            &nbsp;&nbsp;
                                            <a href="#" title="Remove message" class="confirm-delete" data-id="<?php echo $remind_row['reminId']; ?>"  class="confirm-delete" ><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr> 
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No data found!</td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
<?php foreach ($reminder_data as $remind_row) { ?>
            <!--start modal detail-->
            <div class="modal fade" id="detail<?php echo $remind_row['reminId'] ?>" role="dialog" >
                <div class="modal-dialog"> 
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Detail</h4>
                        </div>
                        <div class="modal-body"> 
                            <div class="row">
                                <div class="col-sm-2"><label>Title</label></div>
                                <div class="col-sm-10"> 
    <?php echo $remind_row['subject'] ?>
                                </div> 
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-2"><label>Sender</label></div>
                                <div class="col-sm-10"> 
                                    <!--<input type="text" class="form-control" value="<?php // echo $remind_row['sender']  ?>">-->
    <?php echo ($remind_row['sender'] != null) ? $remind_row['sender'] : "not found" ?>
                                </div> 
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-sm-12"> 
                                    <label>Message</label>  
                                    <div class="message" ><?php echo $remind_row['message'] ?></div>
                                </div> 
                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> 
                            </div>
                        </div> 
                    </div>  
                </div>
            </div>
<?php } ?>
    </div>  
    <script type="text/javascript">
        $(document).ready(function () {
            //Transform the HTML table in a fancy datatable
            $('#tbl_stu').dataTable({
                stateSave: true
            });
        });
        $('.confirm-delete').click(function () {
            var id = $(this).data('id');
            bootbox.confirm("Are you sure that you want to remove this message?", function (result) {
                if (result) {
                    document.location = '<?php echo base_url(); ?>reminder_student/delete/' + id;
                }
            });
        });
    </script>