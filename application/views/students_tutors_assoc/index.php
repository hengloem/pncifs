    <?php
    if ($this->session->flashdata('sms')) {
        ?>  
            <div id="flash-inner-message" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">×</button>
              <b> <?php echo $this->session->flashdata('sms'); ////read   ?> </b></div>
       
        <?php
    }
   ?>
<div class="container-fluid" id="wrap">
    <div class="row-fluid">
        <div class="col-md-12"> 
            <h2>Associate students and tutors</h2><hr/>
            <form method="POST" action="<?php echo base_url(); ?>studentstutorsassoc" name="Get_Filter_By_Year">
                <div class="form-group ">
                    <label class="control-label requiredField" for="select">
                        Select a Batch
                        <span class="asteriskField">
                            *
                        </span>
                    </label>
                    <select class="select form-control" id="select" name="select">
                        <?php 
                        //$batch declared for store an Id = 0;
                        $batch = 0;
                        //if $_SESSION has selected, compare current id with new id that we are selected
                        if($_SESSION['current_select'] != ""){
                            $batch = $_SESSION['current_select'];
                        }
                        //if $batch_data == TRUE, printed
                        if ($batch_data != "" && $batch_data != null) { ?>
                            <?php foreach ($batch_data as $batch_value) {
                                ?>
                                <option <?php if ($batch_value['Id'] == $batch) echo 'selected'; ?> value = "<?php echo $batch_value['Id'];?>"> 
                                    <!--show result-->
                                    <?php echo $batch_value['Year'];?>
                                </option> 
                        <?php 
                            }
                        }else{ 
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
            <form action="<?php echo base_url(); ?>studentstutorsassoc/update_student" method="POST" name="Update Associate Tutors">
                <label class="control-label">List of students</label> 
                <div class="table-responsive">
                    <br>
                    <table class="table table-striped table-bordered table-hover" id="users">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Batch</th>
                                <th>Major</th>
                                <th>Tutor</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php // var_dump($users);?>
                        <?php if($users != "" && $users != null){?>   
                            <?php foreach ($users as $tutor_stu_associate) { ?> 
                                <tr>
                                    <input type="hidden" name="user_id[]" value="<?php echo $tutor_stu_associate['UsersId']; ?>">
                            
                            <td><?php echo $tutor_stu_associate['UsersId']; ?></td>
                            <td><?php echo $tutor_stu_associate['FirstName']; ?></td>
                            <td><?php echo $tutor_stu_associate['LastName']; ?></td>                       
                            <td><?php echo $tutor_stu_associate['Year']; ?></td>    
                            <td><?php echo $tutor_stu_associate['Major']; ?></td>            
                            <td>
                                
                                <select class="select form-control" id="select" name="select[]">
                                    <!--<option value="" >Not tutor found</option>-->
                                    <?php
                                    foreach ($tutors_data as $tutors) {
                                        echo '<option value="' . $tutors['UsersId'] . '" ';
                                        if ($tutors['UsersId'] == $tutor_stu_associate['TutorsId']) {
                                            echo 'selected ';
                                        }
                                        echo '>';
                                        echo $tutors['FirstName'] . '  ' . $tutors['LastName'] . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="old_tutor_id[]" value="<?php echo $tutor_stu_associate['TutorsId']; ?>">
                            </td>                                     
                            </tr>
                        <?php } 
                        }  else {
                            echo "<tr><td colspan='6'>No recode found..!</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php if($users != "" && $users != null){?>
                <div>
                    <button class="btn btn-primary " name="submit" type="submit">
                        Save changes
                    </button>
                </div>
                <?php }?>
            </form>
        </div>
    </div>
</div> 
 

