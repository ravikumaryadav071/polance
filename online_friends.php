<!DOCTYPE HTML>
<html>
	<head>
		<link href='bootstrap/jquery/smoothness/jquery-ui-1.10.1.custom.css' rel='stylesheet' type='text/css'>
		<link href='css/css_profile.css' rel='stylesheet' type='text/css'>
		<script src="bootstrap/jquery/jquery-1.9.1.js"></script>
		<script src="bootstrap/jquery/jquery-ui-1.10.1.custom.min.js"></script>
		<script src='bootstrap/js/bootstrap.js'></script>	
	</head>
	<body>
		<?php
		require_once 'core/init.php';

		$user = new user();

		if($user->isLoggedIn()){

			?>
			<div id="online_friends">
			</div>
			<?php

		}

		?>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/pop_up.js"></script>
		<script type="text/javascript" src="javascripts/init_chat.js"></script>
		<script type="text/javascript" src="javascripts/online_friends.js"></script>
		<script type="text/javascript" src="javascripts/online.js"></script>
	</body>
</html>