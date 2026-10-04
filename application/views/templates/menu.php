<?php $GLOBALS['b44_menu_loaded'] = TRUE; ?>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url();?>" class="pull-left"><img src="<?php echo base_url();?>assets/images/PN_Logo.png"
                    alt="logo"></a>
                <a class="navbar-brand" href="<?php echo base_url();?>">PNC Interns Follow-up</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <label>Welcome <?php echo $this->session->userdata('firstname'); ?>!</label>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <?php if ($this->session->userdata('is_student') === TRUE) { ?>
                                <a href="<?php echo base_url();?>studentsusers/myprofile/<?php echo $this->session->userdata('id')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            <?php } else if ($this->session->userdata('is_supervisor') === TRUE){ ?>
                                <a href="<?php echo base_url();?>supervisorusers/myprofile/<?php echo $this->session->userdata('id')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            <?php }else{ ?>
                                 <a href="<?php echo base_url();?>tutorsusers/myprofile/<?php echo $this->session->userdata('id')?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            <?php } ?>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>connection/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="<?php echo base_url();?>home" id="lihome"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <?php if($this->session->userdata('is_admin') === TRUE){?>
                            <li>
                                <a href="<?php echo base_url();?>tutor_follow_by_admin"><i class="fa fa-edit fa-fw"></i> Tutors Surveys Follow-up</a>
                            </li>
                            <?php if($tutor_student_data != NULL){ ?>
                                <li class="active">
                                    <a href="<?php echo base_url();?>survey_by_admin"><i class="fa fa-edit fa-fw"></i> Surveys Follow-up
                                        <?php if($get_new_survey != "" ){
                                            foreach($get_new_survey as $is_publish){
                                            ?>
                                               <?php if($is_publish['IsPublish'] == 1):?> <span class="badge">new <sup><?php echo $is_publish['published']?></sup></span> <?php endif;?>
                                        <?php }
                                        }
                                        ?>
                                    </a>
                                </li>
                            <?php }?>
                        <?php }else if($this->session->userdata('is_admin') === FALSE && $this->session->userdata('is_tutor') === TRUE && $tutor_student_data != NULL){ ?>
                                <li class="active">
                                    <a href="<?php echo base_url();?>SurveysByTutor"><i class="fa fa-edit fa-fw"></i> Surveys Follow-up
                                        <?php if($get_new_survey != "" ){
                                            foreach($get_new_survey as $is_publish){
                                            ?>
                                               <?php if($is_publish['IsPublish'] == 1):?> <span class="badge">new <sup><?php echo $is_publish['published']?></sup></span> <?php endif;?>
                                        <?php }
                                        }
                                        ?>
                                    </a>
                                </li>
                        <?php }?>
                        <?php if ($this->session->userdata('is_admin') === TRUE) { ?>
                            <li>
                                <a href="<?php echo base_url();?>final_report"><i class="fa fa-file-pdf-o fa-fw"></i> Final Report</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>final_pres"><i class="fa  fa-file-powerpoint-o fa-fw"></i> Final Presentation</a>
                            </li>
                        <?php }else if($this->session->userdata('is_admin') === FALSE && $this->session->userdata('is_tutor') === TRUE){?>
                            <li>
                                <a href="<?php echo base_url();?>Tutor_final_report"><i class="fa fa-file-pdf-o fa-fw"></i> Final Report</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>tutor_final_presentation"><i class="fa  fa-file-powerpoint-o fa-fw"></i> Final Presentation</a>
                            </li>
                        <?php }else if($this->session->userdata('is_admin') === FALSE && $this->session->userdata('is_tutor') === FALSE && $this->session->userdata('is_student') === TRUE){?>
                            <li>
                                <a href="<?php echo base_url();?>student_final_report"><i class="fa fa-file-pdf-o fa-fw"></i> Final Report</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>student_final_pres/index/<?php echo $this->session->userdata('id') ?>"><i class="fa  fa-file-powerpoint-o fa-fw"></i> Final Presentation</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>reminder_student"><i class="fa  fa-bell fa-fw"></i> Survey notification
                                    <?php if ($reminder_data != '' && $reminder_data != null) {
                                            $count = 0;
                                            foreach ($reminder_data as $value) {
                                                if ($value['IsSend'] == 1) {
                                                    $count ++;
                                                    ?>
                                                <?php }
                                            }
                                        if ($count > 0) {?>
                                        <span class="badge" style="background-color: #24c221;">new <sup><?php echo $count; ?></sup></span>
                                    <?php } }?>
                                </a>
                            </li>
                                <li>
                                    <a href="<?php echo base_url();?>StudentSurveys"><i class="fa fa-paperclip" aria-hidden="true"></i> My survey
                                        <?php if($get_new_survey_data != "" ){
                                            foreach($get_new_survey_data as $is_publish){
                                            ?>
                                               <?php if($is_publish['IsPublish'] == 1):?>
                                                    <span class="badge">new
                                                        <sup><?php echo $is_publish['publishdata']?></sup>
                                                    </span>
                                                <?php endif;?>
                                        <?php }
                                        }
                                    ?>
                                    </a>
                                </li>
                            <?php }?>

                        <?php if ($this->session->userdata('is_admin') === TRUE) { ?>
                        <li class="active">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Administration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>studentsusers"><i class="fa fa-user"></i>&nbsp; Students Accounts</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>supervisorusers"><i class="fa fa-user"></i>&nbsp; Supervisor Accounts</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>tutorsusers"><i class="fa fa-user"></i>&nbsp; Tutors Accounts</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>batchs"><i class="fa fa-calendar"></i>&nbsp; Batch | Promotions</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>surveys"><i class="fa fa-clipboard"></i>&nbsp; Surveys of batch</a>
                                </li>
                                <li>
                                      <a href="<?php echo base_url();?>view_student_survey"><i class="fa fa-clipboard"></i>&nbsp; Survey of student</a>
                                </li>
                                <li>
                                      <a href="<?php echo base_url();?>reminder_admin"><i class="fa fa-bell"></i>&nbsp; Reminder</a>
                                </li>
                            </ul>
                        </li>
                        <?php }else if($this->session->userdata('is_admin') === FALSE && $this->session->userdata('is_supervisor') === TRUE){?>
                                <li class="active">
                                    <a href="<?php echo base_url();?>surveys"><i class="fa fa-paperclip" aria-hidden="true"></i> Surveys</a>
                                </li>
                        <?php } ?>
                </ul>
            </div>
        </div>
    </nav>


<?php $msg = $this->session->flashdata('msg');
if ($msg <> '') { ?>
        <div id="flash-message-wrapper">
            <div id="flash-inner-message" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
<?php } ?>

            <?php $error = $this->session->flashdata('error');
            if ($error <> '') { ?>
        <div id="flash-message-wrapper">
            <div id="flash-inner-message" class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
<?php } ?>


    <script>
        // Select the first element on the menu if no other <a> tags match the current URL
        $(function () {
            var url = window.location;
            var elements = $('ul.nav a').filter(function () {
                return this.href == url || url.href.indexOf(this.href) == 0;
            });
            if (elements.length == 0) {
                $('#lihome').addClass('active');
            }
        });
    </script>

    <div id="page-wrapper">
