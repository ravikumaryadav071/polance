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
			$db_uf = DBusers_feeds::getInstance();
			$db = DB::getInstance();

			$db_uf->query("SELECT * FROM {$user_data->username}_blocked_feeders", array(), 'SELECT *');
			$tot_bfs = $db_uf->count();

			if($tot_bfs>0){

				$blocked_feeders = $db_uf->results();
				?>
				<div>
					<?php
					for($i=0; $i<$tot_bfs; $i++){

						$bf = $blocked_feeders[$i];
						$db->get('users', array('id', '=', $bf->userid));
						$f_user_data = $db->first();

						?>
						<div>
							<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
								<img src="<?php echo $f_user_data->profile_pic_dg; ?>" width="35px" height="30px" alt="<?php echo $f_user_data->name; ?>">
								<?php echo $f_user_data->username; ?>
							</a>
							<input type="hidden" id="f_user" value="<?php echo $f_user_data->id; ?>">
							<input type="button" id="unblock" value="Start Feeds">
						</div>
						<?php

					}
					?>
				</div>
				<?php
			}

		}

		?>
		<script type="text/javascript" src="javascripts/unblock_feeders.js"></script>
	</body>
</html>