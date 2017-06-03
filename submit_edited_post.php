<?php

require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$post_id = $_POST['post'];
		$p_userid = $_POST['user'];
		$message = "";
		$add_files_paths = array();
		$add_files_etx = array();
		$add_files_formats = array();

		if(is_numeric($post_id) && is_numeric($p_userid)){

			$user_data = $user->data();
			$db = DB::getInstance();
			$db_up = DBusers_posts::getInstance();
			$db_un = DBusers_notifications::getInstance();
			$db_upc = DBusers_posts_comments::getInstance();

			$db->get('users', array('id', '=', $p_userid));
			$p_user_data = $db->first();

			$db_up->get($p_user_data->username.'_posts', array('id', '=', $post_id));
			$post = $db_up->first();
			$passed = false;

			if($p_userid != $user_data->id){
				$contris = $post->contributors;
				if(strstr($contris, " {$user_data->id},")){
					$passed = true;
				}
			}else{
				$passed = true;
			}


			if($passed){
				

				$contris = str_replace(' ', '', $contris);
				$contris = explode(',',$contris);

				if(isset($_POST['replace_file'])){
					$replace_files = $_POST['replace_file'];
				}else{
					$replace_files = array();
				}

				if(isset($_POST['remove_file'])){
					$remove_files = $_POST['remove_file'];
				}else{
					$remove_files = array();
				}

				$read_texts = $_POST['read_text'];
				$add_text = "";
				$insert_files = "";
				$insert_exts = "";
				$insert_formats = "";
				$files = $post->files;
				$files = explode(',', $files);
				$exts = $post->extention;
				$exts = explode(',', $exts);
				$formats = $post->file_type;
				$formats = explode(',', $formats);

				if(!empty($remove_files)){

					for($i=0; $i<count($remove_files); $i++){

						$remove_file = $remove_files[$i];
						if(isset($remove_file) && !empty($remove_file)){

							if(isset($files[($remove_file-1)]) && !empty($files[($remove_file-1)])){
								$files[($remove_file-1)] = "";
								$exts[($remove_file-1)] = "";
								$formats[($remove_file-1)] = "";
							}

						}

					}

				}

				if(isset($_FILES) && !empty($_FILES)){
					
					if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
						
						$valid_ext = array('jpeg', 'odt', 'jpg', 'png', 'mp3', 'wmv', 'mp4', '3gp', '3gpp', 'ogv', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');
						$valid_formats = array('image/jpeg', 'image/jpg', 'image/png', 'audio/mp3', 'audio/ogg', 'audio/wav', 'video/3gpp', 'video/avi', 'video/mp4', 'video/3gp', 'video/webm', 'video/ogg', 'application/octet-stream', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						$tot_files = count($_FILES['file']['name']);
						$id = $post_id;

						for($i=0; $i<count($_FILES['file']['name']); $i++){

							if($_FILES['file']['name'] != ''){
								
								$file_name = $_FILES['file']['name'][$i];
								$type = $_FILES['file']['type'][$i];
								$size = $_FILES['file']['size'][$i];
								$temp_name = $_FILES['file']['tmp_name'][$i];
								$ext = explode('.', basename($file_name));
								$file_extention = strtolower(end($ext));

								if($file_name && ((in_array($file_extention, $valid_ext) && in_array($type, $valid_formats)))){

									$target = "posts/".strtolower(substr($p_user_data->username, 0, 1))."/$p_user_data->username/";
									
									$name = '';
									$strs1 = str_replace(',', '', $file_name);
									$strs = explode(' ', $strs1);
									
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

									$new_filename = $file_name."_".$user_data->username."_edited_".$id.".".$file_extention;
									$path = $target.$new_filename;
									
									if(move_uploaded_file($temp_name, $path)){

										$add_files_paths[] = $path;
										$add_files_etx[] = $file_extention;
										$add_files_formats[] = $type;
										
									}

								}else{

									$message .= "<p>Your {$i} file format is not supported.</p>";

								}

							}else{

								$message .= "<p>Your {$i} file have not uploaded.</p>";						

							}

						}

						if(!empty($replace_files)){

							for($i=0; $i<count($replace_files); $i++){

								$replace_file = $replace_files[$i];
								if(isset($replace_file) && !empty($replace_file)){

									if(isset($files[($replace_file-1)]) && !empty($files[($replace_file-1)])){
										$files[($replace_file-1)] = $add_files_paths[$i];
										$exts[($replace_file-1)] = $add_files_etx[$i];
										$formats[($replace_file-1)] = $add_files_formats[$i];
									}

								}

							}

						}

						if(count($add_files_paths)>count($replace_files)){

							$tot_new = count($add_files_paths)-count($replace_files);
							$r_pointer = count($replace_files);
							for($i=0; $i<$tot_new; $i++){

								$files[] = $add_files_paths[($r_pointer+$i)];
								$exts[] = $add_files_etx[($r_pointer+$i)];
								$formats[] = $add_files_formats[($r_pointer+$i)];
							}

						}

						for($i=0; $i<count($read_texts); $i++){

							if(isset($read_texts[$i]) && !empty($read_texts[$i])){
								$read_text = $read_texts[$i];
							}else{
								$read_text = "";
							}
							if(!empty($read_text) && $read_text != ""){
								$read_text = str_replace('<file>', '</file/>', $read_text);
							}
							
							$add_text .= $read_text;

							if(isset($files) && !empty($files)){

								if(isset($files[$i]) && !empty($files[$i])){

									if($files[$i]!=""){
										$add_text .= ' <file> ';
									}

								}

							}

						}

						for($i=0; $i<count($files); $i++){

							if($files[$i] != ""){
							
								if($i == (count($files)-1)){
									$insert_files .= "{$files[$i]}";
									$insert_exts .= "{$exts[$i]}";
									$insert_formats .= "{$formats[$i]}";
								}else{
									$insert_files .= "{$files[$i]},";
									$insert_exts .= "{$exts[$i]},";
									$insert_formats .= "{$formats[$i]},";
								}

							}

						}

						$db_up->query("UPDATE {$p_user_data->username}_posts SET text_content='{$add_text}', file_type='{$insert_formats}', extention='{$insert_exts}', files='{$insert_files}', edited_by=$user_data->id, date=CURRENT_TIMESTAMP WHERE id={$post_id} ", array(), 'UPDATE');
						$db_up->insert($p_user_data->username.'_edited_posts', array('post_id'=>$post_id, 'text_content'=>$post->text_content, 'file_type'=>$post->file_type, 'extention'=>$post->extention, 'files'=>$post->files, 'contributors'=>$post->contributors, 'refs'=>$post->refs, 'interest_tags'=>$post->interest_tags, 'privacy'=>$post->privacy, 'edit_id'=>$post->edit_id, 'edited_by'=>$post->edited_by, 'date'=>$post->date));

					}else{

						for($i=0; $i<count($read_texts); $i++){

							if(isset($read_texts[$i]) && !empty($read_texts[$i])){
								$read_text = $read_texts[$i];
							}else{
								$read_text = "";
							}
							if(!empty($read_text) && $read_text != ""){
								$read_text = str_replace('<file>', '</file/>', $read_text);
							}
							
							$add_text .= $read_text;

							if(isset($files) && !empty($files)){

								if(isset($files[$i]) && !empty($files[$i])){

									if(!empty($replace_files)){
										$replace_this = $i+1;
										if(!in_array($replace_this, $replace_files)){
											if($files[$i]!=""){
												$add_text .= ' <file> ';
											}
										}
									}else{
										$add_text .= ' <file> ';
									}

								}

							}

							for($i=0; $i<count($files); $i++){

								if($files[$i] != ""){
								
									if($i == (count($files)-1)){
										$insert_files .= "{$files[$i]}";
										$insert_exts .= "{$exts[$i]}";
										$insert_formats .= "{$formats[$i]}";
									}else{
										$insert_files .= "{$files[$i]},";
										$insert_exts .= "{$exts[$i]},";
										$insert_formats .= "{$formats[$i]},";
									}

								}

							}

						}

						$db_up->query("UPDATE {$p_user_data->username}_posts SET text_content='{$add_text}', files='{$insert_files}', extention='{$insert_exts}', file_type='{$insert_formats}', edited_by=$user_data->id, date=CURRENT_TIMESTAMP WHERE id={$post_id} ", array(), 'UPDATE');
						$db_up->insert($p_user_data->username.'_edited_posts', array('post_id'=>$post_id, 'text_content'=>$post->text_content, 'file_type'=>$post->file_type, 'extention'=>$post->extention, 'files'=>$post->files, 'contributors'=>$post->contributors, 'refs'=>$post->refs, 'interest_tags'=>$post->interest_tags, 'privacy'=>$post->privacy, 'edit_id'=>$post->edit_id, 'edited_by'=>$post->edited_by, 'date'=>$post->date));

					}

				}else{

					for($i=0; $i<count($read_texts); $i++){

						if(isset($read_texts[$i]) && !empty($read_texts[$i])){
							$read_text = $read_texts[$i];
						}else{
							$read_text = "";
						}
						if(!empty($read_text) && $read_text != ""){
							$read_text = str_replace('<file>', '</file/>', $read_text);
						}
						
						$add_text .= $read_text;

						if(isset($files) && !empty($files)){

							if(isset($files[$i]) && !empty($files[$i])){

								if(!empty($replace_files)){
									$replace_this = $i+1;
									if(!in_array($replace_this, $replace_files)){
										if($files[$i]!=""){
											$add_text .= ' <file> ';
										}
									}
								}else{
									$add_text .= ' <file> ';
								}

							}

						}

						for($i=0; $i<count($files); $i++){

							if($files[$i] != ""){
							
								if($i == (count($files)-1)){
									$insert_files .= "{$files[$i]}";
									$insert_exts .= "{$exts[$i]}";
									$insert_formats .= "{$formats[$i]}";
								}else{
									$insert_files .= "{$files[$i]},";
									$insert_exts .= "{$exts[$i]},";
									$insert_formats .= "{$formats[$i]},";
								}

							}

						}

						$db_up->query("UPDATE {$p_user_data->username}_posts SET text_content='{$add_text}', files='{$insert_files}', extention='{$insert_exts}', file_type='{$insert_formats}', edited_by=$user_data->id, date=CURRENT_TIMESTAMP WHERE id={$post_id} ", array(), 'UPDATE');
						$db_up->insert($p_user_data->username.'_edited_posts', array('post_id'=>$post_id, 'text_content'=>$post->text_content, 'file_type'=>$post->file_type, 'extention'=>$post->extention, 'files'=>$post->files, 'contributors'=>$post->contributors, 'refs'=>$post->refs, 'interest_tags'=>$post->interest_tags, 'privacy'=>$post->privacy, 'edit_id'=>$post->edit_id, 'edited_by'=>$post->edited_by, 'date'=>$post->date));
					}

				}

				$db_up->query("SELECT id FROM {$p_user_data->username}_edited_posts WHERE post_id={$post_id} AND edited_by={$user_data->id} ORDER BY id DESC LIMIT 0,1", array(), 'SELECT');
				$last_res = $db_up->first();

				$db_up->update($p_user_data->username.'_posts', array('edit_id'=>$last_res->id), array('id', '=', $post_id));

				if($p_userid != $user_data->id){
					$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'userid'=>$p_userid, 'ntf_type'=>'USER', 'sec_userid'=>$user_data->id, 'action'=>'EDITED'));
				}

				$condition = "";

				for($i=0; $i<count($contris); $i++){

					if($contris[$i] != ""){

						if($contris[$i] != $user_data->id){
							$db->get('users', array('id', '=', $contris[$i]));
							$n_user_data = $db->first();
							$db_un->insert($n_user_data->username.'_notifications', array('post_id'=>$post_id, 'user_id'=>$p_userid, 'ntf_type'=>'USER', 'sec_userid'=>$user_data->id, 'action'=>'EDITED'));
							$condition .= " AND userid!={$n_user_data->id}";
						}

					}

				}

				$db_upc->query("SELECT DISTINCT userid FROM {$n_user_data->username}_{$p_userid}_comments WHERE userid!={$p_userid} AND userid!={$user_data->id} {$condition}", array(), 'SELECT *');
				$tot_c_users = $db_upc->count();

				if($tot_c_users>0){

					$results = $db_upc->results();

					for($i=0; $i<$tot_c_users; $i++){

						$db->get('users', array('id', '=', $results[$i]->userid));
						$n_user_data = $db->first();
						$db_un->insert($n_user_data->username.'_notifications', array('post_id'=>$post_id, 'user_id'=>$p_userid, 'ntf_type'=>'USER', 'sec_userid'=>$user_data->id, 'action'=>'EDITED'));

					}

				}

			}

		}

		redirect::to("users_post.php?user={$p_userid}&post={$post_id}");

	}

}

?>