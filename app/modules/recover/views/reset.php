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
    <body  data-url="<?php echo site_url(); ?>">


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">

                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Reset Password </h3>
                </div> 

                <div class="panel-body">
                   <form method="post" action="<?php echo site_url('recover/do_reset') ?>" role="form" class="form-horizontal m-t-20" id="resetform"> 

                    <div class="form-group"> 
                       <div class="col-xs-12"> 
                        <label>Username</label>
                        <input type="text" class="form-control input-lg"  readonly="true" name="username" value="<?php echo $this->session->session_recover; ?>" disabled="disabled"> 

                    </div> 
                </div> 


                <div class="form-group"> 
                   <div class="col-xs-12"> 
                    <label>Code</label>
                    <input type="text" class="form-control input-lg" name="code" value="<?php echo $this->session->code; ?>" /> 
                    
                </div> 
            </div> 
            <div class="form-group"> 
                <div class="col-xs-12"> 
                    <label>New Password</label>
                    <input type="password" class="form-control input-lg"  name="password" > 
                    
                </div> 
            </div> 


            <div class="form-group"> 
                <div class="col-xs-12">
                    <label>Repeat Password</label>
                    <input type="password" class="form-control input-lg"  name="password_again"> 
                    
                </div> 
            </div> 

            <div class="form-group text-center m-t-40">
                <div class="col-xs-12">
                    <button class="btn btn-success waves-effect waves-light btn-lg w-lg" type="submit">Reset</button>
                </div>
            </div>

            <div class="form-group m-t-30">
                <div class="col-sm-12">
                    <a href="javascript:void(0)" id="resend_code"><i class="fa fa-paper-plane m-r-5"></i> Did not receive any code Resend Now!</button>
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