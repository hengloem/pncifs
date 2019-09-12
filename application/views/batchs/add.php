<div class="container-fluid" id="wrap">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Add one student batch</h2>
        </div>
    </div>
    <!-- Form info -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Batch information </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <?php echo validation_errors(); ?>
                        <?php
                        $attributes = array('id' => 'frmAddBatchForm', 'class' => 'form-horizontal');
                        echo form_open('batchs/add', $attributes);
                        ?>
                        <div class="form-group">
                            <label>Year</label>			
                            <input id="year" name="year" class="form-control" placeholder="2017"
                                   value="<?php echo set_value('year'); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Insternship Start Date</label>			
                            <input type="text" id="startdate" name="startdate" class="form-control" 
                                   value="<?php echo set_value('startdate'); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Insternship End Date</label>			
                            <input type="text" id="enddate" name="enddate" class="form-control"
                                   value="<?php echo set_value('enddate'); ?>" />
                        </div>
                        <div class="form-group">
                            <label>Code</label>			
                            <input class="form-control" id="disabledInput" placeholder="The code to let students join this batch will be generated automaticly" disabled="" type="text">
                        </div>							

                        <div class="form-group">
                            <button id="send" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk glyphicon-white"></span>&nbsp;Create</button>                                    
                            <a href="<?php echo base_url(); ?>Batchs" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#startdate").datepicker({
            minDate: new Date(), // today date,
            format: 'yyyy-mm-dd'
        });
        $("#enddate").datepicker({
            minDate: new Date(), // today date
            format: 'yyyy-mm-dd'
        });
    });
</script>