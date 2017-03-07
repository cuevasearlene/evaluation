<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="images/favicon_1.ico">

    <title><?php echo $title ? $title . ' | ' .$site_name : $site_name; ?></title>

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

    <!-- DATE PICKER -->
    <link href="<?php echo THEME; ?>assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="<?php echo THEME; ?>assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />

    <!-- Dropzone css -->
    <link href="<?php echo THEME; ?>assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- Custom Files -->
    <link href="<?php echo THEME; ?>css/helper.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME; ?>css/style.css" rel="stylesheet" type="text/css" />

    <!-- Plugins css -->
    <link href="<?php echo THEME; ?>assets/modal-effect/css/component.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo THEME; ?>assets/sweet-alert/sweet-alert.min.css" />

    <!-- DataTables -->
    <link href="<?php echo THEME; ?>assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo THEME; ?>js/modernizr.min.js"></script>


        <link rel="stylesheet" type="text/css" href="<?php echo THEME; ?>css/custom.css" />
        
    </head>



    <body class="fixed-left" data-url="<?php echo site_url(); ?>">
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo site_url(); ?>" class="logo"> <span><img class="img-responsive" src="<?php echo THEME; ?>images/logo.png" style="max-height: 60px;margin-top: 5px;"/> </span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="row">

                            <div class="pull-right" data-toggle="modal" data-target="#qrcode_login" data-tt="tooltip"  data-placement="bottom" title="Login using qr code"><i class="fa fa-qrcode" aria-hidden="true"></i></div>

                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->

            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page remove-margin-left">
                <!-- Start content -->

                <!-- Pls Remove -->
                <?php ($content) ? $this->load->view($content) : NULL; ?>   

                <footer class="footer text-right">
                    2017 © Evaluation.
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->





        </div>
        <!-- END wrapper -->

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

        <!-- CHART JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>


        <script src="<?php echo THEME; ?>js/jquery.app.js"></script>
        <!-- CUSTOM JS -->


        <script src="<?php echo THEME; ?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo THEME; ?>assets/datatables/dataTables.bootstrap.js"></script>

        <script src="<?php echo THEME; ?>assets/print.js"></script>


        <script src="<?php echo THEME; ?>js/custom.js"></script>

    </body>
    </html>
