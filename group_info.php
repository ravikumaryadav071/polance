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

				$table_name = $_GET['group'];
				$user_data = $user->data();
				$db = DB::getInstance();
				$db_uc = DBusers_connection::getInstance();
				$db_msgs = DBusers_messages::getInstance();
				$db_gm = DBgroups_messages::getInstance();
				$uc = user_connections::getInstance();

				$db_gm->get('groups', array('table_name', '=', $table_name));

				if($db_gm->count()>0){
					
					$group_info = $db_gm->first();
					$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));			

					if($db_gm->count()>0){
						
						$db_gm->query("SELECT * FROM members_{$table_name} ORDER BY id DESC", array(), "SELECT *");
						$tot_members = $db_gm->count();

						if($tot_members>0){

							$members = $db_gm->results();
							?>
							<div id="group_info">
								<strong><?php echo $group_info->group_name; ?></strong>
								<?php
								if($tot_members<30){
									?>
									<a href="add_group_members.php?group=<?php echo $table_name; ?>">Add Members</a>
									<?php
								}
								for($i=0; $i<$tot_members; $i++){

									$member = $members[$i];
									if($user_data->id != $member->member_id){
										$db->get('users', array('id', '=', $member->member_id));
										$f_user_data = $db->first();
									}else{
										$f_user_data = $user_data;
									}
									?>
									<div id="user_info">
										<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
											<img src="<?php echo $f_user_data->profile_pic_dg; ?>" alt="<?php echo $f_user_data->name; ?>">
											<p><?php echo $f_user_data->name; ?></p>
											<?php
											include 'include/connecting_to_user.php';
											?>
										</a>
									</div>
									<?php

								}
								?>
							</div>
							<?php

						}

					}

				}
			
			}

		}

		?>
		<script src="javascripts/user_connections.js"></script>
	</body>
</html>