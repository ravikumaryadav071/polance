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
			$db = DB::getInstance();
			$db_uc = DBusers_connection::getInstance();

			$db_uc->query("SELECT * FROM {$user_data->username}_friends ORDER BY date DESC, id DESC", array(), 'SELECT *');
			$tot_friends = $db_uc->count();

			if($tot_friends>1){

				$friends = $db_uc->results();

				?>
				<div>
					<form method="POST" action="create_group.php">
						<label for="group_name">Group Name:</label>
						<input type="text" id="group_name" name="group_name"  value="">
						<?php

						for($i=0; $i<$tot_friends; $i++){

							$friend = $friends[$i];
							$db->get('users', array('id', '=', $friend->userid));
							$f_user_data = $db->first();

							?>
							<div id="user_info">
								<a href="profile.php?user<?php echo $f_user_data->username; ?>">
									<img src="<?php echo $f_user_data->profile_pic_dg; ?>" alt="<?php echo $f_user_data->name; ?>">
									<p><?php echo $f_user_data->name; ?></p>
								</a>
								<p><input type="checkbox" name="add_user[]" id="add_user" value="<?php echo $f_user_data->id; ?>">Add</p>
							</div>
							<?php

						}

						?>
						<input type="submit" value="CREATE">
					</form>
				</div>
				<?php

			}else if($tot_friends == 0){

				?>
				<p>You do not have any friend. You cannot create a group.</p>
				<?php

			}else{

				?>
				<p>You must have at least two friends to create a group.</p>
				<?php

			}

		}
		?>
	</body>
</html>