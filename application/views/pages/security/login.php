<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>webresources/dm/img/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>webresources/dm/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>webresources/dm/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>webresources/plugins/bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>webresources/dm/css/demo/jasmine.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="container" class="cls-container">

    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="lock-wrapper">
        <div class="panel lock-box">
            <div class="center"><img alt="" src="<?php echo base_url(); ?>webresources/dm/img/user.png" class="img-circle"/></div>
            <h4> Hello User !</h4>

            <p class="text-center">Please login to Access your Account</p>
            <div class="text-danger">
                <?php echo validation_errors(); ?>
            </div>
            <div class="row">
                <form id="form-login" action="login" class="form-inline" role="form" method="POST">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="text-left">
                            <label for="signupInputEmail" class="text-muted">Email</label>
                            <input id="signupInputEmail" placeholder="Enter Email" class="form-control" name="email"/>
                        </div>
                        <div class="text-left">
                            <label for="signupInputPassword" class="text-muted">Password</label>
                            <input id="signupInputPassword" type="password" placeholder="Password"
                                   class="form-control lock-input" name="password"/>
                        </div>
<!--                        <div class="pull-left pad-btm">-->
<!--                            <label class="form-checkbox form-icon form-text">-->
<!--                                <input type="checkbox"> Remember Me-->
<!--                            </label>-->
<!--                        </div>-->
                        <button type="submit" class="btn btn-block btn-primary">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo base_url(); ?>webresources/dm/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>webresources/dm/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>webresources/plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
<script src="<?php echo base_url(); ?>webresources/dm/js/login/form-validation.js"></script>
</body>
</html>