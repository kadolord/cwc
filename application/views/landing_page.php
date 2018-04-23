<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=company_name();?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<!-- Google fonts - Roboto -->
	<link rel="stylesheet" href="<?=base_url('assets/css/google_fonts.css');?>">
	<!-- theme stylesheet--> <!-- we change the color theme by changing color.css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.blue.css'); ?>" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>">
	<!-- Font Awesome CDN-->
	<!-- you can replace it by local Font Awesome-->
	<!-- <script src="<?//=base_url('assets/js/fontawesome.js');?>"></script> -->
	<!-- Font Icons CSS-->
	<link rel="stylesheet" href="<?=base_url('assets/css/myfontastic.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.toast.css');?>">
	<!-- Tweaks for older IEs--><!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	
</head>
<?php 
	$i = array_rand($images);
	$image = $images[$i]['bg_name'];
	// print_r($image);
	// die();
?>
<body data-base_url="<?=base_url();?>" >
	<div class="page login-page" style="background : url('<?=base_url()."assets/images/".$image;?>') no-repeat center center fixed"> 
		<div class="container d-flex align-items-center no-padding">
			<div class="form-holder text-center">
				<div class="row">
					<!-- Logo & Information Panel-->
					<div class="col-lg-12">
						<div class="info align-items-center text-center">
							<div class="content">
								<div class="logo" style="">
									<img class="img-fluid" src="<?=base_url('assets/img/immigration_logo.png');?>">
									<!-- <h1>Dashboard</h1> -->
								</div>
								<div class="">
									<button id="login" href="#" class="btn btn-primary ">Login</button>
									<button id="register" href="#"  class="btn btn-primary"><i class="fas fa-user-plus"></i>Register</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="copyrights text-center" >
			<p><span style="background-color: rgba(0,0,0,.6); padding: 4px;border-radius: 7px">Powered by <a href="http://www.cloudpanda.ph/" class="external">Cloud Panda PH</a></span></p>
		</div>
	</div>

	<!-- <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Form in simple modal </button> -->
	<!-- Modal-->
	<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
		<div role="document" class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="exampleModalLabel" class="modal-title">Password Reset</h4>
					<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body">
					<p>Can't sign in? Forgot your Password?</p>
					<p class="plabel">Please enter your account`s email address below and click the "Reset My Password" button. You will receive an email that contains a link to set a new password.</p>
					<form id="reset_passForm">
						<div class="form-group">
							<label>Enter your email address</label>
							<input type="email" name="emailAddress" placeholder="Email Address" class="input-material emailAddreset" required>
						</div>
						
						<div class="form-group" style="text-align:center;">       
							<input type="submit" id="resetPasswordBtn" value="Reset My Password" class="btn btn-primary">
						</div>
					</form>
				</div>

				<!-- <div class="modal-footer"> -->
					

				<!-- </div> -->
			</div>
		</div>
	</div>
<!-- Javascript files-->
	<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?= base_url('assets/js/tether.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.cookie.js'); ?>"> </script>
	<script src="<?= base_url('assets/js/jquery.validate.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/front.js'); ?>"></script>
	<script src="<?= base_url('assets/js/jquery.toast.js'); ?>"></script>
	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
	<!---->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='<?=base_url('assets/js/analytics.js');?>';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X');ga('send','pageview');
	</script>


	<script type="text/javascript">
		
		var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
		$('#login').click(function(e){
			e.preventDefault();
		window.location = base_url+'Main/sign_in';
		});

		$('#register').click(function(e){
			e.preventDefault();
		window.location = base_url+'Main/register';
		});
	</script>
</body>
</html>