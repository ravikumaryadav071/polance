<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$p_userid = $_POST['userid'];
	$userid = $_SESSION['user'];
	$message = $_POST['personal_msg_text'];

	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$uc = user_connections::getInstance();

	if(!$uc->isUserBlocked($p_userid) && $uc->isFriend($p_userid)){

		if(isset($_POST) && !empty($_POST)){

			$db->get('users', array('id', '=', $p_userid));
			$p_user_data = $db->first();
			$user_data = $user->data();

			if(!isset($_FILES) && empty($_FILES)){

				$db_msgs->insert($user_data->username.'_messages', array('userid'=>$p_userid, 'sorr'=>'SENT', 'message'=>$message, 'sorn'=>'SEEN'));
				$db_msgs->insert($p_user_data->username.'_messages', array('userid'=>$userid, 'sorr'=>'RECEIVED', 'message'=>$message));

				if(!$db_msgs->error()){

					echo "<p>Your message has sent to {$p_user_data->name}.</p>";

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

						$db_msgs->query("SELECT * FROM {$p_user_data->username}_messages", array(), 'SELECT *');
						$id = $db_msgs->count();

						$target = "../users_personal_chats/{$p_user_data->username}/";
						$target2 = "users_personal_chats/{$p_user_data->username}/";
						
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

						$new_filename = $file_name."_".$userid."_".($id+1).".".$file_extention;
						$path = $target.$new_filename;
						$insert_path = $target2.$new_filename;

						if($file_name && in_array($file_extention, $valid_ext) && in_array($type, $valid_formats)){

							if(move_uploaded_file($temp_name, $path)){

								$db_msgs->insert($user_data->username.'_messages', array('userid'=>$p_userid, 'sorr'=>'SENT', 'message'=>$message, 'sorn'=>'SEEN', 'file_type'=>$type, 'extention'=>$file_extention, 'path'=>$insert_path));
								$db_msgs->insert($p_user_data->username.'_messages', array('userid'=>$userid, 'sorr'=>'RECEIVED', 'message'=>$message, 'file_type'=>$type, 'extention'=>$file_extention, 'path'=>$insert_path));

								if(!$db_msgs->error()){

									echo "<p>Your message has sent to {$p_user_data->name}.</p>";

								}else{

									echo "<p>There are some errors. Please try after some time.</p>";

								}

							}

						}else{

							echo "Invalid file format. Valid formats are:";
							print_r($valid_ext);

						}

					}else{

						$db_msgs->insert($user_data->username.'_messages', array('userid'=>$p_userid, 'sorr'=>'SENT', 'message'=>$message, 'sorn'=>'SEEN'));
						$db_msgs->insert($p_user_data->username.'_messages', array('userid'=>$userid, 'sorr'=>'RECEIVED', 'message'=>$message));

						if(!$db_msgs->error()){

							echo "<p>Your message has sent to {$p_user_data->name}.</p>";

						}else{

							echo "<p>There are some errors. Please try after some time.</p>";

						}

					}

				}else{

					$db_msgs->insert($user_data->username.'_messages', array('userid'=>$p_userid, 'sorr'=>'SENT', 'message'=>$message, 'sorn'=>'SEEN'));
					$db_msgs->insert($p_user_data->username.'_messages', array('userid'=>$userid, 'sorr'=>'RECEIVED', 'message'=>$message));

					if(!$db_msgs->error()){

						echo "<p>Your message has sent to {$p_user_data->name}.</p>";

					}else{

						echo "<p>There are some errors. Please try after some time.</p>";

					}

				}

			}

		}

	}else{

		echo "You cannot send messages to this user. You are blocked.";

	}

}

?>