<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$table_name = $_POST['group_name'];
		$message = trim($_POST['personal_msg_text']);
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

				$db_gm->query("SELECT * FROM members_{$table_name}", array(), 'SELECT *');
				$tot_members = $db_gm->count();
				if($tot_members>0){
					$members = $db_gm->results();
				}

				if(!isset($_FILES) && empty($_FILES)){
					
					$db_gm->insert($table_name, array('sent_by'=>$userid, 'message'=>$message));
					$db_gm->query("SELECT * FROM {$table_name} WHERE sent_by=>{$userid} ORDER BY date DESC, id DESC LIMIT 0,1", array(), 'SELECT *');
					$last_id = $db_gm->first()->id;

					for($i=0; $i<$tot_members; $i++){

						$member = $members[$i];
						if($member->member_id != $userid){
							$db->get('users', array('id', '=', $member->member_id));
							$m_user_data = $db->first();
							$db_msgs->query("UPDATE {$m_user_data->username}_chat_groups SET sorn='NOT SEEN', last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
						}else{
							$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$last_id}, last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
						}

					}

					if(!$db_msgs->error()){

						echo "<p>Your message has sent.</p>";

					}else{

						echo "<p>There are some errors. Please try after some time.</p>";

					}

				}else if(isset($_FILES['file']) && !empty($_FILES['file'])){

					if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){

						if($_FILES['file']['name'] != ''){
							
							$file_name = $_FILES['file']['name'];
							$type = $_FILES['file']['type'];
							$size = $_FILES['file']['size'];
							$temp_name = $_FILES['file']['tmp_name'];
							$valid_ext = array('jpeg', 'jpg', 'png', 'mp3', 'wmv', 'mp4', 'flv', '3gp', '3gpp', 'ogv', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');
							$valid_formats = array('image/jpeg', 'image/png', 'image/jpg', 'audio/mp3', 'video/x-ms-wmv', 'video/mp4', 'application/octet-stream', 'video/3gpp', 'video/3gp', 'video/ogv', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
							$ext = explode('.', basename($file_name));
							$file_extention = strtolower(end($ext));

							$db_gm->query("SELECT * FROM {$table_name}", array(), 'SELECT *');
							$id = $db_msgs->count();

							$target = "../group_chats_data/{$table_name}/";
							$target2 = "group_chats_data/{$table_name}/";
							
							$name = '';
							$strs = explode(' ', $file_name);
							
							if(count($strs)>1){
								foreach ($strs as $key => $value) {
									if(is_numeric($value) || ctype_alpha($value) || ctype_alnum($value) || !in_array($value, array('/', ':', '|', '<', '>', '*', '?', ';')) || !strstr($value, '\ ')){
										$name .= $value;
									}
								}
							}else{
								$name = $strs[0];
								if(!strstr('/', $name) || !strstr('\ ', $name) || !strstr(':', $name) || !strstr('|', $name) || !strstr('<', $name) || !strstr('>', $name) || !strstr('*', $name) || !strstr('?', $name) || !strstr(';', $name)){
									$name = hash::unique();
								}
							}

							$file_name = $name;

							$new_filename = $file_name."_".$user_data->username."_".($id+1).".".$file_extention;
							$path = $target.$new_filename;
							$insert_path = $target2.$new_filename;

							if($file_name && in_array($file_extention, $valid_ext) && in_array($type, $valid_formats)){

								if(move_uploaded_file($temp_name, $path)){

									$db_gm->insert($table_name, array('sent_by'=>$userid, 'message'=>$message, 'file_type'=>$type, 'extention'=>$file_extention, 'path'=>$insert_path));
									$db_gm->query("SELECT * FROM {$table_name} WHERE sent_by=>{$userid} ORDER BY date DESC, id DESC LIMIT 0,1", array(), 'SELECT *');
									$last_id = $db_gm->first()->id;

									for($i=0; $i<$tot_members; $i++){

										$member = $members[$i];
										if($member->member_id != $userid){
											$db->get('users', array('id', '=', $member->member_id));
											$m_user_data = $db->first();
											$db_msgs->query("UPDATE {$m_user_data->username}_chat_groups SET sorn='NOT SEEN', last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
										}else{
											$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$last_id}, last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
										}

									}
									
									if(!$db_msgs->error()){

										echo "<p>Your message has sent.";

									}else{

										echo "<p>There are some errors. Please try after some time.</p>";

									}

								}

							}else{

								echo "Invalid file format. Valid formats are:";
								print_r($valid_ext);

							}

						}else{

							$db_gm->insert($table_name, array('sent_by'=>$userid, 'message'=>$message));
							$db_gm->query("SELECT * FROM {$table_name} WHERE sent_by=>{$userid} ORDER BY date DESC, id DESC LIMIT 0,1", array(), 'SELECT *');
							$last_id = $db_gm->first()->id;
							for($i=0; $i<$tot_members; $i++){

								$member = $members[$i];
								if($member->member_id != $userid){
									$db->get('users', array('id', '=', $member->member_id));
									$m_user_data = $db->first();
									$db_msgs->query("UPDATE {$m_user_data->username}_chat_groups SET sorn='NOT SEEN', last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
								}else{
									$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$last_id}, last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
								}

							}

							if(!$db_msgs->error()){

								echo "<p>Your message has sent.</p>";

							}else{

								echo "<p>There are some errors. Please try after some time.</p>";

							}

						}

					}else{

						$db_gm->insert($table_name, array('sent_by'=>$userid, 'message'=>$message));
						$db_gm->query("SELECT * FROM {$table_name} WHERE sent_by=>{$userid} ORDER BY date DESC, id DESC LIMIT 0,1", array(), 'SELECT *');
						$last_id = $db_gm->first()->id;
					
						for($i=0; $i<$tot_members; $i++){

							$member = $members[$i];
							if($member->member_id != $userid){
								$db->get('users', array('id', '=', $member->member_id));
								$m_user_data = $db->first();
								$db_msgs->get($m_user_data->username.'_chat_groups', array('chat_table', '=', $table_name));
								$last_msg = $db_msgs->first();
								if(($last_msg->sorn == 'SEEN') && ($last_msg->last_seen < $last_id)){
									$db_msgs->query("UPDATE {$m_user_data->username}_chat_groups SET sorn='NOT SEEN', last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
								}
							}else{
								$db_msgs->query("UPDATE {$user_data->username}_chat_groups SET sorn='SEEN', last_seen={$last_id}, last_updated=CURRENT_TIMESTAMP WHERE chat_table='{$table_name}'", array(), 'UPDATE');
							}

						}

						if(!$db_msgs->error()){

							echo "<p>Your message has sent.</p>";

						}else{

							echo "<p>There are some errors. Please try after some time.</p>";

						}

					}

				}

			}

		}

	}

}

?>