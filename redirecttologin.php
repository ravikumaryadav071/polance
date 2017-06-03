<?php
ob_start(); 
include('includecss.php');
include('headerlogin.php');
// require_once 'core/init.php';
?>
<div class="coll-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding logregbody paddingforbg">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0 doorimgpad">
			<!-- <img src="img/door.png"> -->
			<h1 class="text-center">Welcome To The World Of Your Interest</h1>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 logregdiv logregdiv1">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-1 logindiv logindiv1 checkborder" id="logdiv">
				<p class="text-center"><a href="login.php">Login</a></p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 logindiv logindiv1 checkborder" id="logdiv">
				<p class="text-center"><a href="register.php">Sign Up</a></p>
			</div>
	</div>

<?php
include('footerlogin.php');
?>
</div>