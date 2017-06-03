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
			<div id="notification_area">
				<div><a href="javascript: void(0)" id="rqsts">Requests <span id="rqsts_notify"></span></a></div>
				<div id="rqsts_dropdown"></div>
				<div><a href="javascript: void(0)" id="msgs">Personal Messages <span id="personal_msg_notify"></span></a></div>
				<div id="msgs_dropdown"></div>
				<div><a href="javascript: void(0)" id="group_msgs">Group Messages <span id="group_msg_notify"></span></a></div>
				<div id="group_msgs_dropdown"></div>
				<div><a href="javascript: void(0)" id="ntfs">Notifications <span id="ntfs_notify"></span></a></div>
				<div id="ntfs_dropdown"></div>
			</div>
			<?php

		}

		?>
		<div id="message"></div>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/post_responses.js"></script>
		<script type="text/javascript" src="javascripts/invitation_action.js"></script>
		<script src="javascripts/pop_up.js"></script>
		<script src="javascripts/notifications.js"></script>
		<script src="javascripts/request_action.js"></script>
	</body>
</html>