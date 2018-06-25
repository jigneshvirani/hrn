<!DOCTYPE html>
<html lang="en" ng-app="EthiaApp">
    <head>
        <meta charset="utf-8" />
        <title> London Hot Right Now | Admin Dashboard </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #4 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <base href="<?= url('/') . '/' ?>">
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="resources/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="resources/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="resources/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="resources/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="resources/assets/plugins/bootstrap-sweetalert/sweetalert.css">
        <!-- END THEME GLOBAL STYLES -->

        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="resources/assets/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="resources/assets/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="resources/assets/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        {{ HTML::style('resources/assets/plugins/datatables/datatables.min.css',array('rel'=>'stylesheet')) }}
        <link rel="apple-touch-icon" sizes="180x180" href="resources/assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="resources/assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="resources/assets/images/favicon-16x16.png">
        <link rel="manifest" href="resources/assets/images/site.webmanifest">
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md" ng-controller="mainController">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="manage/dashboard"> 
                      <img src="resources/assets/images/logo-white.png" alt="logo" class="logo-default" style="height: 55px; margin: 3px 11px 0;" />
                         </a>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="separator hide"> </li>
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                           <!-- END NOTIFICATION DROPDOWN -->
                            <li class="separator hide"> </li>
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <!-- END INBOX DROPDOWN -->
                            <li class="separator hide"> </li>
                           
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile">Hey, {{ Auth::guard('admin')->user()->name }} <i class="fa fa-chevron-down"></i> </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="resources/assets/layout4/img/avtar.png" /> </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="manage/my-profile">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                         <a href="javascript:;" onclick="window.location = '<?php echo url('/') . Config('constant.paths.BASEURL_MANAGE') .'/manage/'. 'logout' ?>'"> <i class="icon-key"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="min-height: 748px;">
                        <li class="nav-item" ng-class="{'active': isActive(['/dashboard'])}">
                            <a href="manage/dashboard" class="nav-link nav-toggle" >
                                <i class="fa fa-home" style="border-radius: 24px; width: 40px;"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                         
                        <li class="nav-item" ng-class="{'active': isActive(['/settings'])}">
                            <a href="manage/settings" class="nav-link nav-toggle">
                              <i class="fa fa-cogs" style="border-radius: 24px; width: 40px;"></i>
                              <span class="title">Settings</span>
                            </a>
                        </li>
                         
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                 <div id="main">
                    <div class="page-content" ng-view>
                       
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; Emma App    
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
          <script>
           var BASEURL = "<?= url('/') . '/' ?>"; 
          </script>
        <!-- BEGIN CORE PLUGINS -->
        <script src="resources/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="resources/assets/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
        <script src="resources/assets/plugins/boostrap-datepicker/js/moment.min.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/boostrap-datepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/boostrap-datepicker/js/daterangepicker.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/fancybox/jquery.fancybox.min.js" type="text/javascript"></script>
        <script src="resources/assets/plugins/boostrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="resources/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        {{ HTML::script('resources/assets/js/datatable.js') }}
        {{ HTML::script('resources/assets/plugins/datatables/datatables.min.js') }}
        {{ HTML::script('resources/assets/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }} 
        
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
        <script src="https://www.amcharts.com/lib/3/themes/patterns.js"></script>
        <!-- Charts ends from here -->
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="resources/assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="resources/assets/global/scripts/app.min.js" type="text/javascript"></script>
       
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="resources/assets/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="resources/assets/global/scripts/quick-nav.min.js" type="text/javascript"></script>
         <script src="resources/assets/js/custom.js" type="text/javascript"></script>

         <!-- load angular via CDN -->
        <script src="resources/assets/js/angular.min.js" type="text/javascript"></script>
        <script src="resources/assets/js/angular-route.js" type="text/javascript"></script>
        <script src="resources/assets/js/ui-bootstrap-tpls-1.3.2.js" type="text/javascript"></script>
        <script src="resources/assets/js/script.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>