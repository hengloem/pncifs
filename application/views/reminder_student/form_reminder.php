<div class="container"><br/><br/><br/><br/>  
    <div class="row">
         <div class="well col-md-8 col-md-offset-2">  
            <div class="text-center">
                <u><h1>Form Reminder</h1></u>
            </div><br/> 
            <div class="form">
                <?php
                    foreach ($reminder_data as $remind_item) { 
                        if ($reminder_data['Id'] == $user_id) {
                            ?> 
                    <div class="form-group">
                        <label>Title: </label>&nbsp;<?php echo $remind_item['reminId']; ?>
                    </div>

                    <div class="form-group">
                        <label>Sender: </label>&nbsp;<?php echo $remind_item['Subject']; ?>
                    </div>

                    <div class="form-group"> 
                        <label>Message: </label> 
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" cols="40" id="id_mensagem" name="mensagem" placeholder="Mensagem *" rows="10">
                        </textarea>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo base_url(); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-send glyphicon-white"></span>&nbsp;Send</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                        <a href="<?php echo base_url(); ?>reminder_student/index" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove glyphicon-white"></span>&nbsp;Cancel</a>
                    </div>
                    <?php
                    }
                }
                ?>
            
            </div>
        </div>
    </div>
</div>

