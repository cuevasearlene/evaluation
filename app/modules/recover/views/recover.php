<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="images/favicon_1.ico">

        <title>Password Reset | Evaluation</title>

        <!-- Base Css Files -->
        <link href="<?php echo THEME; ?>css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="<?php echo THEME; ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="<?php echo THEME; ?>assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="<?php echo THEME; ?>css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="<?php echo THEME; ?>css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="<?php echo THEME; ?>css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="<?php echo THEME; ?>css/helper.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo THEME; ?>css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo THEME; ?>js/modernizr.min.js"></script>
        
    </head>
    <body data-url="<?php echo site_url(); ?>">


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">

                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Reset Password </h3>
                </div> 

                <div class="panel-body">
                 <?php echo $this->general->flash_message(); ?>
                 <form method="post" action="<?php echo site_url('recover/recover_code') ?>" role="form" class="text-center"> 
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Enter your <b>Phone Number</b> we will send you the code to Enabled Reset
                    </div>
                    <div class="form-group m-b-0"> 
                        <div class="input-group"> 
                            <input type="text" class="form-control input-lg" placeholder="Enter Phone Number" value="<?php echo $this->session->number; ?>"  data-mask="+639999999999" name="number" > 
                            <span class="input-group-btn"> <button type="submit" class="btn btn-lg btn-success waves-effect waves-light">Reset</button> </span> 
                        </div> 
                    </div> 
                </form>

                </div>                                 
                
            </div>
        </div>

        
        <script>
            var resizefunc = [];
        </script>
  
        <!-- jQuery  -->
        <script src="<?php echo THEME; ?>js/jquery.min.js"></script>
        <script src="<?php echo THEME; ?>js/bootstrap.min.js"></script>
        <script src="<?php echo THEME; ?>js/waves.js"></script>
        <script src="<?php echo THEME; ?>js/wow.min.js"></script>
        <script src="<?php echo THEME; ?>js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="<?php echo THEME; ?>js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo THEME; ?>assets/jquery-detectmobile/detect.js"></script>
        <script src="<?php echo THEME; ?>assets/fastclick/fastclick.js"></script>
        <script src="<?php echo THEME; ?>assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="<?php echo THEME; ?>assets/jquery-blockui/jquery.blockUI.js"></script>

         <script src="<?php echo THEME; ?>assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
        
         <script src="<?php echo THEME; ?>assets/sweet-alert/sweet-alert.min.js"></script>

        <script src="http://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
        <!-- <script src="http://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->
        <!-- CUSTOM JS -->


        <!-- DATE PICKER -->
        <script src="<?php echo THEME; ?>assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo THEME; ?>assets/timepicker/bootstrap-datepicker.js"></script>

        <!-- Modal-Effect -->
        <script src="<?php echo THEME; ?>assets/modal-effect/js/classie.js"></script>
        <script src="<?php echo THEME; ?>assets/modal-effect/js/modalEffects.js"></script>


        <!-- Page Specific JS Libraries -->
        <script src="<?php echo THEME; ?>assets/dropzone/dropzone.min.js"></script>

        <script src="<?php echo THEME; ?>js/jquery.app.js"></script>
        <!-- CUSTOM JS -->
        <script src="<?php echo THEME; ?>js/custom.js"></script>
    </body>
</html>