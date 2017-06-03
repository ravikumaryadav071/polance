<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$table_name = $_GET['group'];
		$last_seen = $_GET['last_seen'];
		$user_data = $user->data();
		$userid = $user_data->id;

		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_msgs = DBusers_messages::getInstance();
		$db_gm = DBgroups_messages::getInstance();
		$uc = user_connections::getInstance();

		$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');

		if($db_gm->count()>0){
			
			$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
			
			if($db_gm->count()>0){

				$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN' WHERE chat_table='{$table_name}'", array(), 'UPDATE');
				$db_gm->query("SELECT * FROM {$table_name} WHERE sent_by != {$userid} AND id>{$last_seen} ORDER BY date DESC, id DESC", array(), 'SELECT *');
				$tot_msgs = $db_gm->count();
				
				if($tot_msgs>0){

					$messages = $db_gm->results();

					for($i=$tot_msgs-1; $i>=0; $i--){

						$chat = $messages[$i];
						if($i==$tot_msgs-1){
							$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$chat->id}, last_updated='CURRENT_TIMESTAMP' WHERE chat_table='{$table_name}'", array(), 'UPDATE');
						}
						$date = strtotime($chat->date);
						$ext = $chat->extention;
						$path = $chat->path;
						$db->get('users', array('id', '=', $chat->sent_by));
						$c_user_data = $db->first();
						?>
						<div id="received_msg_container" style="background-color: #99FFFF">
							<a><?php echo $c_user_data->name; ?>: on <?php echo date('d/m/Y h:i:s A', $date); ?></a>
							<p><pre><?php echo $chat->message; ?></pre></p>
							<?php
							if($ext != 'TEXT'){
								?>
								<a href="<?php echo $path; ?>" download>Download File</a>
								<?php
							}
							?>
						</div>
						<?php					

					}
					?>
					<input type="hidden" id="last_seen" value="<?php echo $messages[0]->id; ?>">
					<?php

				}

			}

		}

	}

}


?>