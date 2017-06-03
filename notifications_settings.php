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

			$user_data = $user->data();
			$db_un = DBusers_notifications::getInstance();

			$db_un->get('notifications_settings', array('userid', '=', $user_data->id));
			$ntf_stng = $db_un->first();

			?>
			<div id="ntf_settings">
				Notifications of different activities: 
				<form action="" method="POST" id="ntf_set_form">
					<div>
						<label for="upvote">Upvote</label>
						<input type="radio" id="up_on" name="upvote" value="ON" <?php if($ntf_stng->upvote == 'ON'){ ?> checked="checked" <?php } ?> >
						<label for="up_on">ON</label>
						<input type="radio" id="up_off" name="upvote" value="OFF" <?php if($ntf_stng->upvote == 'OFF'){ ?> checked="checked" <?php } ?> >
						<label for="up_off">OFF</label>
					</div>
					<div>
						<label for="Comment">Comment</label>
						<input type="radio" id="comm_on" name="comment" value="ON" <?php if($ntf_stng->comment == 'ON'){ ?> checked="checked" <?php } ?> >
						<label for="comm_on">ON</label>
						<input type="radio" id="comm_off" name="comment" value="OFF" <?php if($ntf_stng->comment == 'OFF'){ ?> checked="checked" <?php } ?> >
						<label for="comm_off">OFF</label>
					</div>
					<div>
						<label for="varify">Verify</label>
						<input type="radio" id="var_on" name="varify" value="ON" <?php if($ntf_stng->varify == 'ON'){ ?> checked="checked" <?php } ?> >
						<label for="var_on">ON</label>
						<input type="radio" id="var_off" name="varify" value="OFF" <?php if($ntf_stng->varify == 'OFF'){ ?> checked="checked" <?php } ?> >
						<label for="var_off">OFF</label>
					</div>
					<div>
						<label for="collect">Collect</label>
						<input type="radio" id="clc_on" name="collect" value="ON" <?php if($ntf_stng->collect == 'ON'){ ?> checked="checked" <?php } ?> >
						<label for="clc_on">ON</label>
						<input type="radio" id="clc_off" name="collect" value="OFF" <?php if($ntf_stng->collect == 'OFF'){ ?> checked="checked" <?php } ?> >
						<label for="clc_off">OFF</label>
					</div>
					<input type="submit" value="Save Changes">
				</form>
			</div>
			<?php

		}

		?>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/notifications_settings.js"></script>
	</body>
</html>