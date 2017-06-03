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

				$user_data = $user->data();
				$db = DB::getInstance();
				$db_uc = DBusers_connection::getInstance();
				$db_msgs = DBusers_messages::getInstance();
				$db_gm = DBgroups_messages::getInstance();
				$uc = user_connections::getInstance();
				$table_name = $_GET['group'];
				$no_messages_pp = 20;		//number of messages per page

				$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');

				if($db_gm->count()>0){
					
					$group_info = $db_gm->first();
					$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
				
					if($db_gm->count()>0){

						?>
						<div>
							<a href="group_info.php?group=<?php echo $table_name; ?>">
								<?php
								if($group_info->group_name != ''){
									echo $group_info->group_name;
								}else{
									echo 'Group Info';
								}
								?>
							</a>
							<input type="button" id="leave_group" value="Leave Group" onclick="leave_group('<?php echo $table_name; ?>')">
							<?php
						
							$db_gm->query("SELECT * FROM {$table_name} ORDER BY date DESC, id DESC LIMIT 0,{$no_messages_pp}", array(), 'SELECT *');
							$tot_msgs = $db_gm->count();
							
							if($tot_msgs>0){

								$messages = $db_gm->results();
								$show_msgs = ($tot_msgs>=$no_messages_pp)?$no_messages_pp:$tot_msgs;
								$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$messages[0]->id}, last_updated='CURRENT_TIMESTAMP' WHERE chat_table='{$table_name}'", array(), 'UPDATE');

								if($tot_msgs>=$no_messages_pp){
									?>
									<input type="hidden" id="last_seen" value="<?php echo $messages[0]->id; ?>">
									<input type="button" id="load_more" value="Load More">
									<?php
								}
								
								include 'include/group_chat.php';

							}else{

								?>
								<p>This chat box is empty.</p>
								<?php

							}

							?>
							<form id="send_message" action="" method="POST" enctype="multipart/form-data">
								<textarea id="text_message" name="personal_msg_text" placeholder="Type your message" value=""></textarea>
								<input type="hidden" id="group_name" name="group_name" value="<?php echo $table_name; ?>">
								<input type="file" id="file" name="file">
								<input type="submit" id="send" value="SEND">
							</form>

						</div>
						<?php

					}else{

						?>
						<p>You are not a Member of this group.</p>
						<?php

					}

				}

			}

		}

		?>
		<div id="message"></div>
		<script src="javascripts/group_chat.js"></script>
	</body>
</html>