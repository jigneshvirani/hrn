<!DOCTYPE html>
<head>
    <title> Homex Housing </title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    {{ HTML::style('resources/assets/css/custom.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/css/cs-icon.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/plugins/bootstrap/css/bootstrap.min.css',array('rel'=>'stylesheet')) }}
    {{ HTML::style('resources/assets/plugins/bootstrap-sweetalert/sweetalert.css',array('rel'=>'stylesheet')) }}
</head>
<body>
    <div class="login">
        <div class="overlay"></div>
        <div class="login-form">        
            <div class="logo"><img src="{{ url('/') ."/". Config('constant.paths.ASSETS_IMAGE') . 'logo-white.png'}}"></div>
            <form class="signin-form" action="javascript:;">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="user-label">
                        <input type="text"  name="email" placeholder="Enter Your Email" class="border-radius-20 form-control">
                    </div>
                </div>
                <div class="form-group">
                    <input type="password" name="password"  placeholder="Enter Your Password" class="border-radius-20 form-control">
                </div>
                <div class="form-group">
                    <div class="text-right">
                        <a href="#" data-toggle="modal" data-target="#forgot-password">Forgot Password ?</a>
                    </div>
                </div>
                <div class="btn-create">
                 <button class="btn btn-white btn-circle text-white" type="submit">Sign In <i class="csi-arrow-right text-white"></i> </button>
                   <!--  <a href="javascript:;" class="btn btn-white back-purple-light btn-circle text-white " id="login-button">
                         Login
                        <i class="csi-arrow-right text-white"></i>
                    </a> -->
                </div>
            </form>
        </div>
        <div id="forgot-password" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content border-radius-20 padding">
                    <div class="contract-info-content">
                        <h4 class="modal-title uppercase text-purple-light">Forgot Password
                            <span class="close csi-close-circle text-orange text-right" data-dismiss="modal"></span>
                        </h4>
                    </div>
                    <div class="devider"></div>
                    <div class="modal-body">
                        <div class="info-section">
                            <div class=" form-detail ">
                                <form class="forget-form" action="javascript:;" >
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="control-label ">Email Address :
                                        </label>
                                        <input name="email_fp" type="text" class="form-control"/>
                                    </div>
                                    <div class="devider"></div>
                                    <div>
                                        <button type="submit" name="button" class=" btn btn-white back-purple-light btn-circle">
                                            <i class="csi-check-circle"></i>
                                            Done
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script>var BASEURL = '<?php echo url('/').Config('constant.paths.BASEURL_MANAGE') ?>'</script>
    {{ HTML::script('resources/assets/js/jquery.min.js') }}
    {{ HTML::script('resources/assets/plugins/bootstrap/js/bootstrap.min.js') }}
    {{ HTML::script('resources/assets/plugins/jquery-validation/js/jquery.validate.js') }}
    {{ HTML::script('resources/assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}
    {{ HTML::script('resources/assets/js/login.js') }}
</body>
</html>
