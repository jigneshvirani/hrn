<!-- index.html -->
<!DOCTYPE html>
<html ng-app="HomeXApp">
  <head>
    <title> Homex Housing | Dashboard </title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- LOAD THE CSS -->
    {{ HTML::style('resources/assets/css/all.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/plugins/boostrap-datepicker/css/bootstrap-datepicker.min.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/plugins/boostrap-timepicker/css/wickedpicker.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/plugins/bootstrap-sweetalert/sweetalert.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/css/select2.min.css') }}
    {{ HTML::style('resources/assets/css/custom.css') }}
    {{ HTML::script('resources/assets/js/jquery.min.js') }}
    <!-- Newly Added CSS For Cropper -->
    {{ HTML::style('resources/assets/css/cropper.min.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/css/daterangepicker.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/css/datatables.bootstrap.css',array('rel'=>'stylesheet')) }}

    <!-- Start: css for select2 -->
    {{ HTML::style('resources/assets/css/select2.min.css',array('rel'=>'stylesheet')) }}
    <!-- End: css for select2 -->

    <!-- END THE CSS -->
    <link rel="shortcut icon" href="favicon.png"/>
    <base href="<?=url('/') . '/'?>">
    <script>var BASEURL = '<?php echo url('/') . Config('constant.paths.BASEURL_MANAGE') ?>'</script>
    <script>var BASEURL_WITHOUT_MANAGE = '<?php echo url('/'); ?>'</script>
  </head>
   <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo" ng-controller="mainController">
    <!-- HEADER AND NAVBAR -->
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
      <!-- BEGIN HEADER INNER -->
      <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
          <a href="#/dashboard">
            <img src="<?php echo url('/') . Config('constant.paths.ASSETS_IMAGE') . 'logo-light.png' ?>" alt="logo" class="logo-default"/>
          </a>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
          <i class="fa fa-bars"></i>
        </a>
        <!-- END LOGO -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->

        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
          <!-- BEGIN HEADER SEARCH BOX -->

          <!-- BEGIN TOP NAVIGATION MENU -->
          <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
              <!-- BEGIN QUICK SIDEBAR TOGGLER -->
              <li class="dropdown dropdown-extended quick-sidebar-toggler">
                <i class="fa fa-power-off"></i>
                <span class="logout-text" ><a href="javascript:;" onclick="window.location = '<?php echo url('/') . Config('constant.paths.BASEURL_MANAGE') . 'logout' ?>'">Logout</a></span>
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
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
  <div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
    <div class="page-spinner-bar">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
    </div>
      <!-- BEGIN SIDEBAR -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <div class="sidebar-menu slimscroll">
      <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" >
          <li class="nav-item" ng-class="{'active': isActive(['/dashboard'])}">
            <a href="manage/dashboard" class="nav-link nav-toggle">
              <i class="homeicon-Dashboard"></i>
              <span class="title"> Dashboard</span>
            </a>
          </li>
          
        </ul>
        <!-- END SIDEBAR MENU -->
      </div>
      </div>
      <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
      <!-- BEGIN CONTENT BODY -->
      <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <!-- MAIN CONTENT AND INJECTED VIEWS -->
        <div id="main">
          <!-- angular templating -->
          <!-- this is where content will be injected -->
          <div ng-view class="fade-in-up" autoscroll="true"></div>

        </div>
        <!-- END PAGE BASE CONTENT -->
      </div>
      <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
  </div>
  <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
      <div class="page-footer-inner">
        &copy; London Hot Right now
      </div>
      <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
      </div>
    </div>
    <!-- END FOOTER -->
    <!-- LOAD THE JS FILES-->

      {{ HTML::script('resources/assets/js/all.js') }}
      {{ HTML::script('resources/assets/plugins/boostrap-datepicker/js/bootstrap-datepicker.min.js') }}
      {{ HTML::script('resources/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}
      {{ HTML::script('resources/assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}
      {{ HTML::script('resources/assets/js/ng-sweet-alert.js') }}
      {{ HTML::script('resources/assets/js/homex-app.js') }}

      <!-- time picker js -->
      {{ HTML::script('resources/assets/plugins/boostrap-timepicker/js/wickedpicker.js') }}
      <!-- time picker js -->

      {{ HTML::script('resources/assets/js/jquery.dataTables.min.js') }}
      {{ HTML::script('resources/assets/js/datatables.bootstrap.js') }}
      <!-- Js File for Cropper -->
      <!-- Js File for Cropper -->
      {{ HTML::script('resources/assets/js/cropper.min.js') }}
      <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBo64N1bkrG4THGyYCMJxzDSuLm3qVpM4I"></script>

      <!-- For Jquery Validations -->
      {{ HTML::script('resources/assets/js/select2.full.min.js') }}
       {{ HTML::script('resources/assets/js/select2.min.js') }}
      {{ HTML::script('resources/assets/js/jquery.validate.min.js') }}
      

      <!-- For DXF PArsing -->
      <!--Start: js for select2 -->
      {{ HTML::script('resources/assets/js/select2.full.min.js') }}
      {{ HTML::script('resources/assets/js/select2.min.js') }}
      
      <!--End: js for select2 -->

    <!-- END THE JS FILES-->
   
    </body>
</html>
