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
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group">
                                         <!-- list item-->
                                         <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                           <div class="pull-left">
                                            <em class="fa fa-user-plus fa-2x text-info"></em>
                                        </div>
                                        <div class="media-body clearfix">
                                            <div class="media-heading">New user registered</div>
                                            <p class="m-0">
                                             <small>You have 10 unread messages</small>
                                         </p>
                                     </div>
                                 </div>
                             </a>
                             <!-- list item-->
                             <a href="javascript:void(0);" class="list-group-item">
                              <div class="media">
                               <div class="pull-left">
                                <em class="fa fa-diamond fa-2x text-primary"></em>
                            </div>
                            <div class="media-body clearfix">
                                <div class="media-heading">New settings</div>
                                <p class="m-0">
                                 <small>There are new settings available</small>
                             </p>
                         </div>
                     </div>
                 </a>
                 <!-- list item-->
                 <a href="javascript:void(0);" class="list-group-item">
                  <div class="media">
                   <div class="pull-left">
                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                </div>
                <div class="media-body clearfix">
                    <div class="media-heading">Updates</div>
                    <p class="m-0">
                     <small>There are
                      <span class="text-primary">2</span> new updates available</small>
                  </p>
              </div>
          </div>
      </a>
      <!-- last list item -->
      <a href="javascript:void(0);" class="list-group-item">
          <small>See all notifications</small>
      </a>
  </li>
</ul>
</li>
<li class="hidden-xs">
    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
</li>

<li class="dropdown">
    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo THEME; ?>images/users/avatar-1.png" alt="user-img" class="img-circle"> </a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('profile'); ?>"><i class="md md-face-unlock"></i> Profile</a></li>
        <li><a href="<?php echo site_url('login/do_logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
    </ul>
</li>
</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
</div>
<!-- Top Bar End -->


<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <?php // echo $this->general->list_module(0, $modid); ?>
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="<?php echo THEME; ?>images/users/avatar-1.png" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php $name = explode(' ', $this->general->check_user()->name);echo ucfirst($name[0]);  ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('profile'); ?>"><i class="md md-face-unlock"></i> Profile</a></li>
                        <li><a href="<?php echo site_url('login/do_logout'); ?>"><i class="md md-settings-power"></i> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><?php echo $this->general->check_user()->gname; ?></p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
                     <!--    <ul>
                            <li>
                                <a href="index.html" class="waves-effect"><i class="md md-home"></i><span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect"><i class="md md-mail"></i><span> Mail </span><span class="pull-right"><i class="md md-add"></i></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="inbox.html">Inbox</a></li>
                                    <li><a href="email-compose.html">Compose Mail</a></li>
                                    <li><a href="email-read.html">View Mail</a></li>
                                </ul>
                            </li>        
                        </ul> -->
                        <?php  echo $this->general->list_module(0, $modid); ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
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
