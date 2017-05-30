<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template kokoko" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template kokoko">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/bootstrap/css/bootstrap.css" />

		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/porto/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="<?php echo base_url(); ?>assets/porto/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="<?php echo base_url(); ?>assets/porto/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
      <!--<form name="form_login" action="<?php //echo site_url("login/doLogin"); ?>" method="post">-->
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="txtuser" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="txtpassword" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
                                      <div class="alert alert-error hide"> <i class="icon-remove-sign"></i> </div>
      <div id="loading" progress progress-striped active> </div>
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>

								<div class="col-sm-4 text-right">
                                	<?php if($isSmartPhone==1) { ?>
									<!-- untuk PC-->
                                    <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg"   id="btnlogin">Sign In</button>
                                    <?php } else { ?>
									
									<!-- untuk Smartphone-->
                                    <button type="submit" class="btn btn-primary hidden-xs"  id="btnlogin">Sign In</button>
                                    <?php } ?>
									
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; SEDANA INTERNAL WEB<br>2017.</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/magnific-popup/jquery.magnific-popup.js"></script>
		<script src="<?php echo base_url(); ?>assets/porto/vendor/jquery-placeholder/jquery-placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url(); ?>assets/porto/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url(); ?>assets/porto/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url(); ?>assets/porto/javascripts/theme.init.js"></script>

<!-- scripts --> 
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script>

            $(document).ready(function() {

                $('#loading')
                        .hide()
                        .ajaxStart(function() {
                    $(this).show()
                            .addClass("progress progress-striped active")
                            .append($('<div class="bar" style="width: 100%"></div>'))
                })
                        .ajaxStop(function() {
                    $(this).hide();
                });

                $('#btnlogin').bind('click', function(e) {
                    var user = $('input[name=txtuser]').val();
                    var password = $('input[name=txtpassword]').val();
                    if (user == "" || password == "") {
                        $('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> User and password must be filled');
                    } else {
                        doLogin(user, password);
                    }
                });

                function doLogin(user, password) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('login/do_login')?>",
                        data: {
                            'user': user,
                            'password': password
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
                                document.location.href = "<?php echo site_url("/headline"); ?>";
                            } else {
                                $('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> ' + data['msg']);
                            }
                        }
                    });
                }

            });

        </script>

	</body>
</html>