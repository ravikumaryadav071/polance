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

			$db = DB::getInstance();
			$db_uc = DBusers_connection::getInstance();
			$uc = user_connections::getInstance();
			$no_bloked_pp = 10;		//number of blocked users per page
			$user_data = $user->data();

			$db_uc->query("SELECT * FROM {$user_data->username}_blocked", array(), 'SELECT *');
			$all_blocked = $db_uc->count();

			$db_uc->query("SELECT * FROM {$user_data->username}_blocked ORDER BY date DESC, id DESC LIMIT 0,{$no_bloked_pp}", array(), 'SELECT *');
			$tot_blocked = $db_uc->count();

			if($tot_blocked>0){

				$blocked_users = $db_uc->results();
				$show_users = ($tot_blocked>=$no_bloked_pp)?$no_bloked_pp:$tot_blocked;

				?>
				<div id="blocked_list">
					<p>You have blocked <?php echo $all_blocked; ?> user(s).</p>
					<?php
					for($i=0; $i<$show_users; $i++){

						$blocked_user = $blocked_users[$i];
						$db->get('users', array('id', '=', $blocked_user->userid));
						$f_user_data = $db->first();
						include 'include/connecting_to_user.php';
					}
					if($tot_blocked>=$no_bloked_pp){
						?>
						<input type="button" id="load_more_blocked" value="Load More" onclick="load_more_blocked(<?php echo $blocked_users[($show_users-1)]->id; ?>)">
						<?php
					}
					?>
				</div>
				<?php

			}else{

				?>
				<p>You have not blocked anyone.</p>
				<?php

			}

		}

		?>
		<script src="javascripts/load_more_blocked.js"></script>
	</body>
</html>