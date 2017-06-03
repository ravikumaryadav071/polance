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
			$db_msgs = DBusers_messages::getInstance();
			$db_gm = DBgroups_messages::getInstance();
			$uc = user_connections::getInstance();
			
			if(isset($_POST) && !empty($_POST)){

				$user_data = $user->data();
				$table_name = $_POST['group'];
				$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');

				if($db_gm->count()>0){
					
					$group_info = $db_gm->first();
					$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
					
					if($db_gm->count()>0){
					
						$db_gm->query("SELECT * FROM members_{$table_name}", array(), 'SELECT *');
						$tot_members = $db_gm->count();
						if($tot_members>0 && $tot_members<30){

							$add_users = $_POST['add_user'];
							$tot_users = count($add_users);
							if($tot_users>0){

								for($i=0; $i<$tot_users; $i++){

									$add_user = $add_users[$i];

									if($uc->isFriend($add_user)){

										$group_name = $group_info->group_name;
										$db->get('users', array('id', '=', $add_user));
										$f_user_data = $db->first();
										$db_gm->insert('members_'.$table_name, array('member_id'=>$f_user_data->id));
										$db_msgs->get($f_user_data->username.'_chat_groups', array('chat_table', '=', $table_name));
										if($db_msgs->count()==0){
											$db_gm->query("SELECT * FROM {$table_name}", array(), 'SELECT *');
											$last_seen = $db_gm->count();
											$db_msgs->insert($f_user_data->username.'_chat_groups', array('name'=>$group_name, 'chat_table'=>$table_name, 'last_seen'=>$last_seen));
										}
										// $db_gm->query("ALTER TABLE {$table_name} ADD user_sorn_{$add_user} varchar(10) not null default 'SEEN' AFTER extention", array(), 'ALTER');
										// $db_gm->query("ALTER TABLE {$table_name} MODIFY user_sorn_{$add_user} varchar(10) not null default ' NOT SEEN'", array(), 'ALTER');
										$db_gm->insert($table_name, array('sent_by'=>$user_data->id, 'message'=>"I have added {$f_user_data->name}.", 'file_type'=>'TEXT_MESSAGE', 'extention'=>'TEXT'));
										redirect::to("group_info.php?group={$table_name}");
									}

								}

							}

						}

					}

				}

			}

			if(isset($_GET) && !empty($_GET)){

				$user_data = $user->data();
				$table_name = $_GET['group'];
				$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');

				if($db_gm->count()>0){
					
					$group_info = $db_gm->first();
					$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
					
					if($db_gm->count()>0){
					
						$db_gm->query("SELECT * FROM members_{$table_name}", array(), 'SELECT *');
						$tot_members = $db_gm->count();
						if($tot_members>0 && $tot_members<30){

							$db_uc->query("SELECT * FROM {$user_data->username}_friends ORDER BY date DESC, id DESC", array(), 'SELECT *');
							$tot_friends = $db_uc->count();
							
							if($tot_friends>0){

								$friends = $db_uc->results();
								?>
								<form action="" method="POST">
									<?php
									$have_members = 0;
									for($i=0; $i<$tot_friends; $i++) { 
										
										$friend = $friends[$i];
										$db_gm->get('members_'.$table_name, array('member_id', '=', $friend->userid));
										
										if($db_gm->count()==0){

											if(!$uc->isUserBlocked($friend->userid)){

												$db->get('users', array('id', '=', $friend->userid));
												$f_user_data = $db->first();
												$have_members++;
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

										}

									}
									if($have_members>0){
										?>
										<input type="hidden" name="group" value="<?php echo $table_name; ?>">
										<input type="submit" value="ADD">
										<?php
									}else{
										?>
										<p>You do not have any user(s) to add in this group.</p>
										<?php
									}
									?>
								</form>
								<?php

							}else{

								?>
								<p>You have not any friend.</p>
								<?php

							}

						}else if($tot_members>=30){

							?>
							<p>This group is already full. You cannot add more members.</p>
							<?php

						}

					}

				}
				

			}

		}

		?>
	</body>
</html>