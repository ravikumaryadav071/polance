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
				$no_friends_pp = 10;		// number of friends per page

				$db->get('users', array('username', '=', $p_username));
				$valid_user = $db->count();

				if($valid_user>0){

					$p_user_data = $db->first();

					if(!$uc->isUserBlocked($p_user_data->id)){

						$db_uc->query("SELECT * FROM {$p_username}_friends", array(), 'SELECT *');
						$all_friends = $db_uc->count();

						$db_uc->query("SELECT * FROM {$p_username}_friends ORDER BY date DESC, id DESC LIMIT 0,{$no_friends_pp}", array(), 'SELECT *');
						$tot_friends = $db_uc->count();
						if($tot_friends>0){

							$friends = $db_uc->results();
							$show_friends = ($tot_friends>=$no_friends_pp)?$no_friends_pp:$tot_friends;
							?>
							<div id="friends">
								<p><?php echo $p_user_data->name; ?> has <?php echo $all_friends; ?> friend(s).</p>
								<?php
								include 'include/friends.php';
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
		<script src="javascripts/load_more_friends.js"></script>
		<script src="javascripts/user_connections.js"></script>
	</body>
</html>