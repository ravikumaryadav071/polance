<?php

require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) and !empty($_POST)){
		
		$privacy = $_POST['privacy'];
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_cpr = DBcollaborations_posts_responses::getInstance();
		$db_cpc = DBcollaborations_posts_comments::getInstance();
		$read_texts = $_POST['read_text'];
		$editor_pos = $_POST['editor_pos'];
		$unique_name = strtolower(trim($_POST['col_name']));
		$tot_editors = count($read_texts);
		$post_text = "";
		$message = "";
		$add_tag_id = "";

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));

			if($db_cm->count()>0){
				
				$all_main_tb = array(
					'1'=>'all_business_interests',
					'2'=>'all_corporate_world_interests',
					'3'=>'all_education_interests',
					'4'=>'all_finance_interests',
					'5'=>'all_philosophy_interests',
					'6'=>'all_politics_interests',
					'7'=>'all_social_interests',
					'8'=>'all_sports_interests'
				);

				$all_int_domains_db = array(
					'1'=>'interests_business', 
					'2'=>'interests_corporate_world', 
					'3'=>'interests_education', 
					'4'=>'interests_finance', 
					'5'=>'interests_philosophy', 
					'6'=>'interests_politics', 
					'7'=>'interests_social', 
					'8'=>'interests_sports'
				);		//all interests domains database

				if(isset($_POST['interest_name'])){
					$interest_name = $_POST['interest_name'];
					$add_tags = "";
					for($i=0; $i<count($interest_name); $i++){

						if(($i+1)==count($interest_name)){
							$add_tags .= $interest_name[$i];
						}else{
							$add_tags .= $interest_name[$i].",";
						}

					}
				}else{
					$add_tags = "";
				}

				if($add_tags != ""){

					if(isset($_POST['interest_id'])&&isset($_POST['catagory_id'])&&!empty($_POST['interest_id'])&&!empty($_POST['catagory_id'])){
						
						$catagory_id = $_POST['catagory_id'];
						$interest_id = $_POST['interest_id'];
						$tot_int = count($catagory_id);
						$tot_cat = count($catagory_id);
						$cat_id = array();
						$int_id = array();
						if($tot_cat>0 && $tot_int>0 && $tot_cat==$tot_int){

							$cat_index = array();
							$int_index = array();

							$cat_id = $catagory_id;
							$int_id = $interest_id;

							for($i=0; $i<$tot_cat; $i++){

								$add_tag_id .= "({$int_id[$i]}->{$cat_id[$i]}),";

							}
							// for($i=0; $i<$tot_int; $i++){
							
							// 	$c_id = $catagory_id[$i];
							// 	$i_id = $interest_id[$i];
							// 	foreach ($catagory_id as $key => $value) {
									
							// 		if($value == $c_id){
							// 			$cat_index[] = $key;
							// 		}

							// 	}

							// 	foreach ($interest_id as $key => $value) {
									
							// 		if($value == $i_id){
							// 			$int_index[] = $key;
							// 		}

							// 	}
								
							// 	for($j=0; $j<count($cat_index); $j++){

							// 		if($cat_index[$j] == $int_index[$j]){

							// 			if($i<=$j){
							// 				$cat_id[] = $catagory_id[$cat_index[$j]];
							// 				$int_id[] = $interest_id[$int_index[$j]];
							// 				break;
							// 			}else{

							// 				break;

							// 			}

							// 		}

							// 	}
								
							// }

						}

					}

					if(isset($_POST['contris']) && !empty($_POST['contris'])){

						$contris = $_POST['contris'];
						$add_contris = "";

						for($i=0; $i<count($contris); $i++){
							$my_contri =  " ".$contris[$i].",";
							
							if($add_contris != ""){

								if(!strstr($add_contris, $my_contri)){

									$add_contris .= " {$contris[$i]},";

								}

							}else{
								$add_contris .= " {$contris[$i]},";						
							}

						}

					}else{
						$add_contris = "";
					}

					if(isset($_POST['references']) && !empty($_POST['references'])){

						$references = $_POST['references'];
						$add_refs = "";
						for($i=0; $i<count($references); $i++){
							if(($i+1) == count($references)){
								$add_refs.=$references[$i];
							}else{
								$add_refs.= $references[$i].",";
							}
						}
						
					}else{
						$add_refs = "";
					}

					if(isset($_FILES) && !empty($_FILES)){

						if(isset($_FILES['file']['name']) && (count($_FILES['file']['name'])>0) ){

							$valid_ext = array('jpeg', 'odt', 'jpg', 'png', 'mp3', 'wmv', 'mp4', '3gp', '3gpp', 'ogv', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');
							$valid_formats = array('image/jpeg', 'image/jpg', 'image/png', 'audio/mp3', 'audio/ogg', 'audio/wav', 'video/3gpp', 'video/avi', 'video/mp4', 'video/3gp', 'video/webm', 'video/ogg', 'application/octet-stream', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.ms-powerpoint.presentation.macroEnabled.12', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
							$file_no = $_POST['file_no'];
							$tot_files = count($file_no);
							$insert_text = array();
							for($i=0; $i<$tot_editors; $i++){

								$find_fts = explode('<file>', $read_texts[$i]);		//file tags
								
								$insert_text[$i] = "";
								
								foreach($find_fts as $key=>$value){
									
									if($key == 0){
										$insert_text[$i].= trim($value);
									}else{
										$trim_value = trim($value);
										$insert_text[$i].= "</file/>{$trim_value}";
									}
								
								}

							}

							for($i=0; $i<$tot_files; $i++){

								for($j=0; $j<$tot_editors; $j++){

									if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){

										if(isset($editor_pos[$j]) && !empty($editor_pos[$j])){
											if($file_no[$i]==($editor_pos[$j])){

												$insert_text[$j] = "{$insert_text[$j]} <file> ";
												break;

											}else if($j>1){

												if($editor_pos[($j-1)]<$file_no[$i] && $editor_pos[$j]>$file_no[$i]){

													$insert_text[$j] = "{$insert_text[$j]} <file> ";
													break;

												}
											}else if($tot_editors==1 && $i>1){

												$insert_text[$j] = "{$insert_text[$j]} <file> ";
												break;

											}
										}else{

											$insert_text[$j] = " {$insert_text[$j]} <file> ";
											break;

										}

									}

								}

							
							}


							for($i=0; $i<$tot_editors; $i++){

								$post_text .= $insert_text[$i];

							}

							echo $post_text;
							$add_files_paths = "";
							$add_files_formats ="";
							$add_files_etx = "";

							$db_cp->query("SELECT id FROM {$unique_name}_posts ORDER BY id DESC, LIMIT 0,1", array(), 'SELECT *');
							$id = $db_cp->count();

							for($i=0; $i<count($_FILES['file']['name']); $i++){

								if($_FILES['file']['name'] != ''){
									
									$file_name = $_FILES['file']['name'][$i];
									$type = $_FILES['file']['type'][$i];
									$size = $_FILES['file']['size'][$i];
									$temp_name = $_FILES['file']['tmp_name'][$i];
									$ext = explode('.', basename($file_name));
									$file_extention = strtolower(end($ext));

									if($file_name && ((in_array($file_extention, $valid_ext) && in_array($type, $valid_formats))) || ($file_extention == 'mp3')){

										$target = "collaborations/posts/{$unique_name}/";
										
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

										$new_filename = $file_name."_".$user_data->username."_".($id+1)."_".$unique_name.".".$file_extention;
										$path = $target.$new_filename;
										
										if(move_uploaded_file($temp_name, $path)){

											if(($i+1) == count($_FILES['file']['name'])){
												$add_files_paths .= "{$path}";
												$add_files_etx .= "{$file_extention}";
												$add_files_formats .= "{$type}";
											}else{
												$add_files_paths .= "{$path},";
												$add_files_etx .= "{$file_extention},";
												$add_files_formats .= "{$type},";
											}

										}

									}else{

										$file_count = $i+1;
										$message .= "<p>Your {$file_count} file format is not supported.</p>";

									}

								}else{

									$file_count = $i+1;
									$message .= "<p>Your {$file_count} file have not uploaded.</p>";						

								}

							}


							$db_cp->insert($unique_name.'_posts', array('posted_by'=>$user_data->id, 'text_content'=>$post_text, 'file_type'=>$add_files_formats, 'extention'=>$add_files_etx, 'files'=>$add_files_paths, 'contributors'=>$add_contris, 'refs'=>$add_refs, 'interest_tags'=>$add_tag_id, 'privacy'=>strtoupper($privacy)));

							if(!$db_cp->error()){
								$db_cp->query("SELECT id, date FROM {$unique_name}_posts WHERE posted_by={$user_data->id} ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
								$last_res = $db_cp->first();
								//$db_uf->insert($user_data->username.'_feeds', array('post_id'=>$last_res->id, 'privacy'=>strtoupper($privacy)));
								//$db_uf->query("SELECT * FROM {$user_data->username}_feeds WHERE post_id={$last_res->id} AND userid={$user_data->id} AND action='UPLOADED' AND privacy='{$privacy}' ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
								//$last_feed = $db_uf->first();
								$message .= "Uploaded.";
							}else{
								$message .= "Uploadation failed.";
							}


						}else{

							for($i=0; $i<$tot_editors; $i++){

								$post_text .= $read_texts[$i];

							}
							
							$db_cp->insert($unique_name.'_posts', array('posted_by'=>$user_data->id, 'text_content'=>$post_text, 'contributors'=>$add_contris, 'refs'=>$add_refs, 'interest_tags'=>$add_tag_id, 'privacy'=>strtoupper($privacy)));
							if(!$db_cp->error()){
								$db_cp->query("SELECT id, date FROM {$unique_name}_posts WHERE posted_by={$user_data->id} ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
								$last_res = $db_cp->first();
								//$db_uf->insert($user_data->username.'_feeds', array('post_id'=>$last_res->id, 'privacy'=>strtoupper($privacy)));
								//$db_uf->query("SELECT * FROM {$user_data->username}_feeds WHERE post_id={$last_res->id} AND userid={$user_data->id} AND action='UPLOADED' AND privacy='{$privacy}' ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
								//$last_feed = $db_uf->first();
								$message .= "Uploaded.";
							}else{
								$message .= "Uploadation failed.";
							}

						}

					}else{

						for($i=0; $i<$tot_editors; $i++){

							$post_text .= $read_texts[$i];

						}

						$db_cp->insert($unique_name.'_posts', array('posted_by'=>$user_data->id, 'text_content'=>$post_text, 'contributors'=>$add_contris, 'refs'=>$add_refs, 'interest_tags'=>$add_tag_id, 'privacy'=>strtoupper($privacy)));
						
						if(!$db_cp->error()){
							echo "{$unique_name}_posts posted_by={$user_data->id} text_content={$post_text} contributors={$add_contris} refs={$add_refs} interest_tags={$add_tag_id} privacy={$privacy}";
							$db_cp->query("SELECT id, date FROM {$unique_name}_posts WHERE posted_by={$user_data->id} ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
							$last_res = $db_cp->first();
							//$db_uf->insert($user_data->username.'_feeds', array('post_id'=>$last_res->id, 'privacy'=>strtoupper($privacy)));
							//$db_uf->query("SELECT * FROM {$user_data->username}_feeds WHERE post_id={$last_res->id} AND userid={$user_data->id} AND action='UPLOADED' AND privacy='{$privacy}' ORDER BY id DESC LIMIT 0,1", array(), 'SELECT *');
							//$last_feed = $db_uf->first();
							$message .= "Uploaded.";
						}else{
							$message .= "Uploadation failed.";
						}			

					}

				}else{

					$message .= "Tags not added.";

				}

				if(isset($last_res) && !empty($last_res)){

					if(isset($contris) && !empty($contris)){

						$tot_contris = count($contris);

						for($i=0; $i<$tot_contris; $i++){
							$contri = $contris[$i];
							if($contri!="" && !empty($contri)){

								$db->get('users', array('id', '=', $contri));
								$c_user_data = $db->first();
								$db_un->insert($c_user_data->username.'_notifications', array('userid'=>$col_info->col_id, 'post_id'=>$last_res->id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'CONTRIBUTED'));

							}

						}

					}

					// for($i=0; $i<$tot_cat; $i++){

					// 	$cat_db = $all_int_domains_db[$cat_id[$i]];
					// 	$db_temp = new DBtemp($cat_db);

					// 	$db_temp->get($all_main_tb[$cat_id[$i]], array('id', '=', $int_id[$i]));
					// 	$int_info = $db_temp->first();

					// 	$db_temp->insert($int_info->table_name, array('post_id'=>$last_res->id, 'userid'=>$user_data->id, 'post_type'=>'USER'));

					// }

					// if(strtoupper($privacy)=='FOLLOWERS'){
					// 	$db->myUpdate('collaborations_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->last_follower_time, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->last_friend_time), array('userid', '=', $user_data->id));
					// }else if(strtoupper($privacy)=='FRIENDS'){
					// 	$db->myUpdate('collaborations_last_updated', array('last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->last_friend_time), array('userid', '=', $user_data->id));
					// }else if(strtoupper($privacy)=='PUBLIC'){
					// 	$db->myUpdate('collaborations_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->last_follower_time, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->last_friend_time), array('userid', '=', $user_data->id));
					// }
					$db_col->update('collaborations_last_updated', array('last_id'=>$last_res->id, 'last_time'=>$last_res->date), array('col_id', '=', $col_info->col_id));
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_upvotes (userid int not null primary key)", array(), 'CREATE');
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_downvotes (userid int not null primary key)", array(), 'CREATE');
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_shares (userid int not null primary key)", array(), 'CREATE');
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_reports (userid int not null primary key)", array(), 'CREATE');
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_varify (userid int not null primary key)", array(), 'CREATE');
					$db_cpr->query("CREATE TABLE {$unique_name}_{$last_res->id}_collects (userid int not null primary key)", array(), 'CREATE');
					$db_cpc->query("CREATE TABLE {$unique_name}_{$last_res->id}_comments (id int auto_increment not null primary key, userid int not null, comment text not null, deleted varchar(3) not null default 'NO', tot_reports int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
				
				}

				session::flash('collaboration', "$message");
				redirect::to("collaboration.php?col={$unique_name}");

			}

		}

	}

}


?>