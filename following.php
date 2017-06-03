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

			if(isset($_GET) && !empty($_GET)){

				$db = DB::getInstance();
				$db_uc = DBusers_connection::getInstance();
				$uc = user_connections::getInstance();
				$user_data = $user->data();
				$p_username = $_GET['user'];
				$no_followings_pp = 10;		// number of followings per page

				$db->get('users', array('username', '=', $p_username));
				$valid_user = $db->count();

				if($valid_user>0){

					$p_user_data = $db->first();

					if(!$uc->isUserBlocked($p_user_data->id)){

						$db_uc->query("SELECT * FROM {$p_username}_following", array(), 'SELECT *');
						$all_followings = $db_uc->count();

						$db_uc->query("SELECT * FROM {$p_username}_following ORDER BY date DESC, id DESC LIMIT 0,{$no_followings_pp}", array(), 'SELECT *');
						$tot_followings = $db_uc->count();
						
						if($tot_followings>0){

							$followings = $db_uc->results();
							$show_followings = ($tot_followings>=$no_followings_pp)?$no_followings_pp:$tot_followings;
							?>
							<div id="followings">
								<p><?php echo $p_user_data->name; ?> is following <?php echo $all_followings; ?> user(s).</p>
								<?php
								include 'include/following.php';
								?>
							</div>
							<?php

						}
					}

				}else{

					?>
					<p>This user does not exists.</p>
					<?php

				}


			}

		}
		?>
		<div id="message"></div>
		<script src="javascripts/load_more_followings.js"></script>
		<script src="javascripts/user_connections.js"></script>
	</body>
</html>