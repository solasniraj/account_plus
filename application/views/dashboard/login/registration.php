
<!DOCTYPE HTML>
<html>
<head>
	<title>Account :: Login </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url().'contents/css/bootstrap.min.css'; ?>" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="<?php echo base_url().'contents/css/style.css'; ?>" rel='stylesheet' type='text/css' />

	<!-- sanoj css -->

<link href="<?php echo base_url().'contents/css/sanoj.css'; ?>" rel='stylesheet' type='text/css' />


	<!-- sanoj css ends  -->

	<!-- Font Awesome CSS -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

	<!-- jQuery -->
	<!-- lined-icons -->
	<link rel="stylesheet" href="<?php echo base_url().'contents/css/icon-font.min.css'; ?>" type='text/css' />
	<!-- //lined-icons -->
	<!-- chart -->
	<script src="<?php echo base_url().'contents/js/Chart.js'; ?>"></script>
	<!-- //chart -->
	<!--animate-->
	<link href="<?php echo base_url().'contents/css/animate.css'; ?>" rel="stylesheet" type="text/css" media="all">
	<script src="<?php echo base_url().'contents/js/wow.min.js'; ?>"></script>
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
<!-- Meters graphs -->
<script src="<?php echo base_url().'contents/js/jquery-1.10.2.min.js'; ?>"></script>
<!-- Placed js at the end of the document so the pages load faster -->
<style>
	.form_errors
	{
		color: #f44336;
		margin-top: -5px;
		padding-bottom: 15px;
		padding-left: 5px;
	}

	.invalid 
	{
		text-align:center;
		font-size:18px;
		padding-bottom:15px;
		color: #f44336;
	}


	.footer{
		background: #fff none repeat scroll 0 0;
		border-top: 1px solid #eff0f4;
		bottom: 0;
		padding: 12px;

		text-align: center;
		width: 100%;
	}
	.footer p {
		color: #7a7676;
		font-size: 14px;
	}

	.radio label, .checkbox label, label {
    font-size: 1em;
    font-weight: 300;
    vertical-align: middle;
}

.margin5 {
	margin-bottom:5px;
}
.font16 {
	font-size: 16px;
}
.margin15 
{
	margin-bottom:15px;
}
</style>
</head> 

<body class="sign-in-up">
	<section>
		<div id="page-wrapper" class="sign-in-wrapper">
			<div class="graphs">
				<div class="sign-in-form">
					<div class="sign-in-form-top">
						<p><span>Registration</span> <a href="<?php echo base_url(); ?>">Account <span>Plus</span></a></p>
					</div>
					<div class="signin">
						<div class="invalid">
							<?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
							?>
						</div>
						<?php echo form_open('login/validate'); ?>
						<input type="hidden" name="requersUrl" value="<?php echo $link; ?>"/>
						<div class="log-input">
							<div class="log-input-left">
								<input type="text" class="user" name="commiteName" value="" placeholder="Name of Committee" />
								<?php echo form_error('commiteName'); ?>
							</div>

							<div class="clearfix"> </div>
						</div>
						<div class="log-input">
							<div class="log-input-left">
								<input type="text" class="address" name="address" value="" placeholder="address" />
								<?php echo form_error('address'); ?>
							</div>

							<div class="clearfix"> </div>
						</div>

						<div class="log-input">
							<div class="log-input-left">
								<input type="text" class="phone" style="margin-bottom:5px;" name="phone" value="" placeholder="phone" />
								<?php echo form_error('phone'); ?>
							</div>

							<div class="clearfix"> </div>
						</div>

                       <div class="margin15">
						<div class="radio">
							  <label><input type="radio" class="font16" name="optradio">Use default user and password</label>
							</div>
							<div class="radio">
							  <label><input type="radio" class="font16" name="optradio">Create user with new Credentials</label>
							</div>
						</div>

						
						<div class="log-input" style="margin-bottom:10px;">
							<div class="log-input-left">
								<select id="selector1" class="form-control3">
								    <option>Fisal Year Setup</option>
									<option value="2072/2073">2072/2073</option>
								</select>
							</div>

							<div class="clearfix"> </div>
						</div>


						<input type="submit" value="Proceed">
					</form>	 

				</div>

			</div>
		</div>
	</div>
	<!--footer section start-->





	<!--footer section start-->
	<section class="footer">
		<p>&copy salyani. All Rights Reserved.</p>
	</section>
	<!--footer section end-->

	<!-- main content end-->
</section>

<script src="<?php echo base_url().'contents/js/jquery.nicescroll.js'; ?>"></script>
<script src="<?php echo base_url().'contents/js/scripts.js'; ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url().'contents/js/bootstrap.min.js'; ?>"></script>
</body>
</html>