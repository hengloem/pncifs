<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12">
            <h1>List Survey</h1>
            <hr>
            <div class="login-panel panel panel-default" style="margin-top: 5%;">

                <div class="panel-body"> 
                    <form action="<?php echo base_url() ?>reminder_admin/index" method="post">


                        <table class="table table-striped table-bordered table-hover" id="tbl_stu">
                            <thead> 
                                <tr>
                                    <th>No</th>
                                    <th>Survey Name</th>  
                                     <th>Deadline</th>
                                </tr>
                            </thead>
                            <tbody > 
                                <?php 
                                   $i = 0;
                                if($survey_data != "" && $survey_data != null) {?>
                                <?php foreach($survey_data as $value) {
                                      $i++;
                                    ?>
                                <tr> 
                                    <td class="col-md-1"><?php echo $i;?></td> 
                                    <td><?php echo $value['SurveyTitle']?></td> 
                                    <td><p style="color:red;"><?php echo $value['Deadline']?></p></td> 
                                </tr> 
                                <?php } } else {?> 
                                <tr>
                                    <td colspan="2">No record found !</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="form-group ">
                            <div class="col-sm-12"> 
                                <a href="<?php echo base_url()?>reminder_admin">
                                    <button class="btn btn-primary"  type="button"  >Back</button> 
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>