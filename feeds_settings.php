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
			$db_uc = DBusers_connection::getInstance();
			$db_uf = DBusers_feeds::getInstance();
			$db = DB::getInstance();

			$db_uc->query("(SELECT userid FROM {$user_data->username}_friends) UNION (SELECT userid FROM {$user_data->username}_following)", array(), 'SELECT *');

			$tot_users = $db_uc->count();

			if($tot_users>0){

				$f_users = $db_uc->results();
				?>
				<form id="feeds_set_form" action="" method="POST">
					Stop Feeds of anyone of the following: 
					<?php
					for($i=0; $i<$tot_users; $i++){

						$f_user = $f_users[$i];
						$db_uf->get($user_data->username.'_blocked_feeders', array('userid', '=', $f_user->userid));
						if($db_uf->count()==0){
							
							$db->get('users', array('id', '=', $f_user->userid));
							$f_user_data = $db->first();
							?>
							<div>
								<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
									<img src="<?php echo $f_user_data->profile_pic_dg; ?>" height="35px" width="30px" alt="<?php echo $f_user_data->name; ?>">
									<?php echo $f_user_data->name; ?>
								</a>
								<input type="checkbox" id="blocked_feeder" name="blocked_feeder[]" value="<?php echo $f_user_data->id; ?>">
							</div>
							<?php
						}
					}
					?>
					<input type="submit" value="Save">
				</form>
				<?php
			}

		}
		?>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/block_feeders.js"></script>
	</body>
</html>