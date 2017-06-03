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

			if(isset($_POST)&&!empty($_POST)){

				$user_data = $user->data();
				$db_col = DBcollaborations::getInstance();
				$db_cp = DBcollaborations_posts::getInstance();
				$db_cm = DBcollaborations_members::getInstance();
				$db_ui = DBusers_interests::getInstance();
				$col_name = trim($_POST['col_name']);
				$unique_name = "";
				$add_tag_id = "";
				$path = "";
				$path_dg = "";
				
				$unique_name = str_replace(' ', '', $col_name);
				$unique_name = strtolower($unique_name);
				
				$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
				$exists = $db_col->count();

				if(ctype_alpha($unique_name)){

					if($exists==0){

						$db_col->insert('collaborations_unique', array('unique_name'=>$unique_name));

						if(!$db_col->error()){

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

									}

									if(isset($_FILES) && !empty($_FILES)){

										if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){

											$profile_pic = $_FILES['file']['name'];
											$type = $_FILES['file']['type'];
											$tmp_name = $_FILES['file']['tmp_name'];
											$size = $_FILES['file']['size'];

											$ext = explode('.', basename($profile_pic));
											$file_ext = end($ext);

											$name = '';
											$strs = explode(' ', $profile_pic);
											if(count($strs)>1){
												foreach ($strs as $key => $value) {
													if(is_numeric($value) || ctype_alpha($value) || ctype_alnum($value) || !in_array($value, array('/', ':', '|', '<', '>', '*', '?', ';')) || !strstr($value, '\ ')){
														$name .= $value;
													}
												}

												$name .= hash::unique();

											}else{

												$name = $strs[0];
												
												if(!strstr('/', $name) || !strstr('\ ', $name) || !strstr(':', $name) || !strstr('|', $name) || !strstr('<', $name) || !strstr('>', $name) || !strstr('*', $name) || !strstr('?', $name) || !strstr(';', $name)){

													$name = hash::unique();

												}

											}

											$profile_pic = $name;

											$valid_format = array("image/jpeg", "image/jpg", "image/png");
											$valid_ext = array("jpg", "jpeg", "png");

											$target = 'collaborations/profile_pic/';
											$path = $target.$profile_pic.'_'.$user_data->username.'_'.$col_name.'.'.$file_ext;

											$target_dg = 'collaborations/profile_pic_dg/';
											$path_dg = $target_dg.$profile_pic.'_'.$user_data->username.'_'.$col_name.'.'.$file_ext;

											if(in_array($file_ext, $valid_ext) && in_array($type, $valid_format)){

												if(move_uploaded_file($tmp_name, $path)){

													$old_size = getimagesize($path);
													$old_width = $old_size[0];
													$old_height = $old_size[1];
													
													if($size > 102400){

														if(($size >102400) && ($size <204800)){

															$down_p = 0.60; //downgrade percentage	

														}else{

															if(($size>=204800) && ($size <307200)){

																$down_p = 0.50; //

															}else{

																if(($size>=307200) && ($size <409600)){

																	$down_p = 0.40;

																}else{

																	if(($size>=409600) && ($size <512000)){

																		$down_p = 0.30;

																	}else{

																		if(($size>=512000) && ($size <1024000)){

																			$down_p = 0.20;

																		}else{

																			if($size >= 1024000){

																				$down_p = 0.15;

																			}

																		}

																	}

																}

															}

														}	

													}else{

														$down_p = 0.80;

													}

													$new_width = $down_p*$old_width;
													$new_height = $down_p*$old_height;
													$new_image = imagecreatetruecolor($new_width, $new_height);

													if($type == 'image/png'){

														$old_image = imagecreatefrompng($path);

													}else{

														$old_image = imagecreatefromjpeg($path);

													}

													imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

													if($type == 'image/png'){

														imagepng($new_image, $path_dg);

													}else{

														imagejpeg($new_image, $path_dg);

													}

												}else{

													echo "<div id='message'>Your image cannot be uploaded right now. Please try again.</div>";

												}


											}else{

												echo "<div id='error'>Your file do not have valid file format.</div>";

											}

										}

									}

									$db_col->insert('collaborations', array('collaboration_name'=>$col_name, 'unique_name'=>$unique_name, 'col_interests'=>$add_tag_id, 'created_by'=>$user_data->id, 'profile_pic'=>$path, 'profile_pic_dg'=>$path_dg, 'members_count'=>'1'));

									if(!$db_col->error()){

										$db_col->get('collaborations', array('unique_name', '=', $unique_name));
										$last_res = $db_col->first();
										$col_id = $last_res->id;
										$db_col->query("UPDATE collaborations_unique SET col_id={$col_id} WHERE unique_name='{$unique_name}'", array(), 'UPDATE');
										$db_col->insert('collaborations_last_updated', array('col_id'=>$col_id));
										$db_cp->query("CREATE TABLE {$unique_name}_posts (id int auto_increment primary key not null, posted_by int not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, tot_upvotes int not null, tot_downvotes int not null, tot_comments int not null, tot_shares int not null, tot_varify int not null, tot_collects int not null, tot_reports int not null, edit_id int not null, delete_id int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
										$db_cp->query("CREATE TABLE {$unique_name}_edited_posts (id int auto_increment primary key not null, edited_by int not null, post_id int not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, tot_upvotes int not null, tot_downvotes int not null, tot_comments int not null, tot_shares int not null, tot_varify int not null, tot_reports int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
										$db_cp->query("CREATE TABLE {$unique_name}_deleted_posts (id int auto_increment primary key not null, deleted_by int not null, post_id int not null, edit_id int not null, text_content text not null, file_type text not null, extention varchar(250) not null default 'TEXT', files text not null, contributors varchar(150) not null, refs text not null, interest_tags text not null, privacy varchar(20) not null default 'FOLLOWERS', suggested_tags text not null, tot_upvotes int not null, tot_downvotes int not null, tot_comments int not null, tot_shares int not null, tot_varify int not null, tot_reports int not null, date timestamp not null default CURRENT_TIMESTAMP)", array(), 'CREATE');
										$db_cm->query("CREATE TABLE {$unique_name}_members (userid int primary key not null, name_init varchar(1) not null, member_type varchar(15) not null default 'MEMBER')", array(), 'CREATE');
										$db_cm->query("CREATE TABLE {$unique_name}_requests (userid int primary key not null)", array(), 'CREATE');
										$db_cm->query("CREATE TABLE {$unique_name}_invitations (userid int primary key not null)", array(), 'CREATE');
										$db_cm->insert($unique_name.'_members', array('userid'=>$user_data->id, 'name_init'=>strtolower(substr($user_data->name, 0, 1)), 'member_type'=>'ADMIN'));
										$db_ui->insert($user_data->username.'_collaborations', array('col_id'=>$col_id));
										mkdir("collaborations/posts/{$unique_name}");
										session::flash('collaboration', 'Collaboration created successfully.');
										redirect::to('collaboration.php?col='.$unique_name);

									}else{

										session::flash('collaboration', 'There are some problem in creating this collaboration.');

									}

								}

							}

						}

					}else{

						?>
						<div>Collaboration with this name already exists.</div>
						<?php

					}

				}else{

					?>
					<div>Collaboration name have characters other than alphabets/spaces.</div>
					<?php

				}

			}


			?>
			<div>
				<form id="create_col_form" method="POST" action="" enctype="multipart/form-data">
					<div>
						<label for="col_name">Collaboration name</label>
						<input type="text" name="col_name" id="col_name" value="">
						<span id="col_name_sugsn"></span>
					</div>
					<div id="preview_container">
						<img id="pic_preview" src="" alt="Collaboration Pic">
					</div>
					<div>
						<label for="profile_pic">Choose collaboration picture.(Image format must be jpeg, jpg or png.)</label>
						<br/>
						<input type="file" name="file" id="profile_pic">
					</div>
					<div>
						<label for="add_tags">Tags: </label>
						<input type="text" id="add_tags">
						<input type="button" id="add_tags_to_list" value="ADD">
						<div id="suggested_tags"></div>
						<div id="added_tags">
						</div>
					</div>
					<span id="error"></span>
					<span id="message"></span>
					<input type="submit" id="submit" name="submit" value="Create">
				</form>
			</div>
			<?php

		}

		?>
		<script type="text/javascript" src="javascripts/create_collaboration.js"></script>
		<script type="text/javascript" src="javascripts/upload_profilepic.js"></script>
	</body>
</html>