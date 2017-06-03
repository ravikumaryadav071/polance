<!DOCTYPE HTML>
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

			if(isset($_GET)&&!empty($_GET)){

				$unique_name = trim($_GET['col']);

				if(ctype_alpha($unique_name)){

					if (session::exists('collaboration')) {
						echo '<p>' . session::flash('collaboration') . '</p>';	
					}

					$db_col = DBcollaborations::getInstance();
					$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
					
					if($db_col->count()>0){

						$col_info = $db_col->first();
						$col_id = $col_info->col_id;
						$db = DB::getInstance();
						$db_ucl = DBusers_collections::getInstance();
						$db_cp = DBcollaborations_posts::getInstance();
						$db_cm = DBcollaborations_members::getInstance();
						$db_cpr = DBcollaborations_posts_responses::getInstance();
						$db_cpc = DBcollaborations_posts_comments::getInstance();
						$user_data = $user->data();
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

						$all_int_domains = array(
							'1'=>'Business', 
							'2'=> 'Corporate World', 
							'3'=> 'Education', 
							'4'=> 'Finance', 
							'5'=> 'Philosophy', 
							'6'=> 'Politics', 
							'7'=> 'Social', 
							'8'=> 'Sports'
						);

						$valid_img_formats = array('jpeg', 'jpg', 'png');
						$valid_ado_formats = array('mp3', 'ogg', 'wav');
						$valid_vdo_formats = array('3gpp', 'avi', 'mp4', '3gp', 'webm', 'ogg');
						$valid_file_formats = array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'pptm', 'xlsx', 'zip', 'rar', 'cab');

						$db_col->get('collaborations', array('id', '=', $col_id));
						$col_data = $db_col->first();

						$tags = $col_data->col_interests;
						$tag_links = array();							
						$tags_ids = explode(',', $tags);
						$show_tags = array();
						$form_tags = array();

						for($j=0; $j<count($tags_ids); $j++){
							if($tags_ids[$j] !=""){
								$temp_tag = str_replace('(', '', $tags_ids[$j]);
								$temp_tag = str_replace(')', '', $temp_tag);
								$int_cat = explode('->', $temp_tag);		//interest->catagory
								$tag_links[$j] = array('int_id'=>$int_cat[0], 'db_id'=>$int_cat[1]);
							}
						}


						for($i=0; $i<count($tag_links); $i++){

							$tag_link = $tag_links[$i];
							$database = $all_int_domains_db[$tag_link['db_id']];
							$main_tb = $all_main_tb[$tag_link['db_id']];
							$id_in_db = $tag_link['int_id'];
							$db_temp = new DBtemp($database);
							$db_temp->get($main_tb, array('id', '=', $id_in_db));
							$int_info = $db_temp->first();
							$parent_id = $int_info->parent_id;
							$show_tags[$i] = "<strong>{$int_info->name}</strong>";
							$form_tags[$i] = "{$int_info->name}";

							while($parent_id != 0){

								$db_temp->get($main_tb, array('id', '=', $parent_id));
								$parent_info = $db_temp->first();
								$show_tags[$i] .= " in <strong>{$parent_info->name}</strong>";
								$parent_id = $parent_info->parent_id;
							}

							$show_tags[$i] .= " in <strong>{$all_int_domains[$tag_link['db_id']]}</strong>";

						}

						?>
				 		<div>
							<h2><?php echo $col_data->collaboration_name; ?></h2>
							<div>
								<img src="<?php echo $col_data->profile_pic; ?>">
							</div>
							<div><a href="javascript: void(0)" id="show_members"><?php echo $col_data->members_count; if($col_data->members_count==1){ echo ' Member'; }else{ echo ' Members'; }  ?></a></div>
				 			<?php
							for($i=0; $i<count($show_tags); $i++){
							 	?>
				 			 	<a href="interests.php?cat=<?php echo $tag_links[$i]['db_id']; ?>&int=<?php echo $tag_links[$i]['int_id']; ?>"><?php echo $show_tags[$i]; ?></a>
				 			 	<?php
							}
							?>
				 		</div>
				 		
				 		<?php
				 		$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));
						
						if($db_cm->count()>0){
					 		
							$member_info = $db_cm->first();

							if($member_info->member_type == 'ADMIN'){

								?>
								<div>
									<a href="javascript: void(0)" id="show_requests">Requests<span id="request_count"></span></a>
									<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
									<div id="display_requests">
									</div>
								</div>
								<div>
									<a href="javascript: void(0)" id="change_membership">Change Membership</a>
								</div>
								<?php

							}else{
						 		?>
						 		
						 		<div>
						 			<a href="javascript: void(0)" id="leave_col">Leave</a>
						 			<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
						 		</div>
						 		<?php
						 	}
					 		?>
					 		<div><a href="javascript: void(0)" id="send_invites">Invite</a></div>
					 		<div id="collection_box">
								<a href="javascript: void(0)" id="show_collection">Collection</a>
								<div id="my_collection" hidden="hidden">
									<div id="clc_form_div">
										<form id="create_clc_form" method="POST" action="">
											<input type="text" id="clc_form_text" name="clc_name" value="" placeholder="Create New Collection">
											<input type="submit" value="Create">
											<div id="clc_name_sugsn"></div>
										</form>
									</div>
									<?php
									$db_ucl->query("SELECT * FROM {$user_data->username}_collections_lists", array(), 'SELECT *');
									$tot_clc = $db_ucl->count();
									if($tot_clc>0){
										$clcns = $db_ucl->results();
										for($i=0; $i<$tot_clc; $i++){
											$clcn = $clcns[$i];
											?>
											<div id="collection">
												<br><?php echo $clcn->collection_name; ?>.<br>
												<span id="clc_counter"><?php echo $clcn->tot_posts; ?></span>
												<input type="hidden" id="collection_id" value="<?php echo $clcn->id; ?>">
											</div>
											<?php
										}

									}else{
										?>
										<p>Collections list is empty. Create a new one.</p>
										<?php
									}

									?>
								</div>
							</div>
					 		<div id="post_area">
					 			<form id="post_creation" method="POST" action="submit_collaborations_posts.php" enctype="multipart/form-data">
					 				<div id="editor_1">
					 					<textarea id="read_text" name="read_text[]" placeholder="Write Down Your Post"></textarea>
					 					<input type="hidden" name="editor_pos[]" id="text_editor" value="1">
					 				</div>
					 				<input type="button" id="add_files" value="ADD FILES">
					 				<div>
					 					<label>Tags: </label>
					 					<div id="all_tags">
					 						<?php
					 						for($i=0; $i<count($show_tags); $i++){
						 						?>
						 						<div>
						 							<p><?php echo $show_tags[$i]; ?></p>
						 							<input type="button" id="add_tag" value="ADD">
						 							<input type="hidden" id="cat_id" value="<?php echo $tag_links[$i]['db_id']; ?>">
						 							<input type="hidden" id="int_id" value="<?php echo $tag_links[$i]['int_id']; ?>">
						 							<input type="hidden" id="interest_name" value="<?php echo $form_tags[$i]; ?>">
						 						</div>
						 						<?php
						 					}
						 					?>
					 					</div>
					 					<div id="added_tags"></div>
					 				</div>
					 				<div>
					 					<label for="sugst_contri_user">Contributors: </label>
					 					<input type="text" id="sugst_contri_user">
					 					<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
					 					<div id="contri_sugsn_area"></div>
					 					<div id="add_contributors">
					 					</div>
					 				</div>
					 				<div>
					 					<label for="add_refs">References: </label>
					 					<input type="text" id="add_refs">
					 					<input type="button" id="add_refs_to_list" value="ADD">
					 					<div id="add_references">
					 					</div>
					 				</div>
					 				<select id="privacy" name="privacy">Privacy
					 					<option name="Followers">Followers</option>
					 					<option name="Friends">Friends</option>
					 					<option name="Public">Public</option>
					 				</select>
					 				<input type="hidden" name="col_name" value="<?php echo $unique_name; ?>">
					 				<input type="submit" id="submit" value="POST">
					 			</form>
					 			<div id="post_preview">
					 				<div id="read_text_1">
					 					<pre></pre>
					 					<input type="hidden" id="preview_no" value="1">
					 					<div id="file_preview"></div>
					 				</div>
					 			</div>
					 		</div>
					 		<div>
						 		<?php
						 		if(!isset($_GET['post_id'])){
							 		
							 		$no_posts_pp = 25;
									$db_cp->query("SELECT * FROM {$unique_name}_posts ORDER BY id DESC, date DESC LIMIT 0, {$no_posts_pp}", array(), 'SELECT *');
									$tot_posts = $db_cp->count();
									$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
									if($tot_posts>0){

										$posts = $db_cp->results();

										for($i=0; $i<$show_posts; $i++){

											$post_info = $posts[$i];
											$db->get('users', array('id', '=', $post_info->posted_by));
											$p_user_data = $db->first();

											include 'include/col_posts_div.php';

										}

										?>
										<input type="hidden" id="end_feed" value="<?php echo $posts[($show_posts-1)]->id; ?>">
										<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
										<?php

									}
								
								}else{
									if(!empty($_GET['post_id'])){
										if(is_numeric($_GET['post_id'])){
											$g_post_id = $_GET['post_id'];		//get post id
											$no_posts_pp = 25;
											$db_cp->query("(SELECT * FROM {$unique_name}_posts WHERE id>{$g_post_id} ORDER BY id DESC, date DESC LIMIT 0, 10) UNION (SELECT * FROM {$unique_name}_posts WHERE id={$g_post_id} ORDER BY id DESC, date DESC LIMIT 0, 1) UNION (SELECT * FROM {$unique_name}_posts WHERE id<{$g_post_id} ORDER BY id DESC, date DESC LIMIT 0, 10) ORDER BY id DESC", array(), 'SELECT *');
											$tot_posts = $db_cp->count();
											$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
											if($tot_posts>0){

												$posts = $db_cp->results();

												for($i=0; $i<$show_posts; $i++){

													$post_info = $posts[$i];
													$db->get('users', array('id', '=', $post_info->posted_by));
													$p_user_data = $db->first();
													if($post_info->id == $g_post_id){
														$stv = "scrollHere";	//scroll to view
													}
													include 'include/col_posts_div.php';
													if(isset($stv)){
														unset($stv);
													}
												}

												?>
												<input type="hidden" id="end_feed" value="<?php echo $posts[($show_posts-1)]->id; ?>">
												<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
												<?php

											}
										
										}
									}
								}
								?>
							</div>
							<?php

						}else{

							$db_cm->get($unique_name.'_requests', array('userid', '=', $user_data->id));
							if($db_cm->count()>0){

								?>
								<div>
									<input type="button" id="send_request" value="Request"  hidden="hidden">
									<input type="button" id="delete_request" value="Delete Request">
									<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
								</div>
								<?php

							}else{

								?>
								<div>
									<input type="button" id="send_request" value="Request">
									<input type="button" id="delete_request" value="Delete Request"  hidden="hidden">
									<input type="hidden" id="col_name" value="<?php echo $unique_name; ?>">
								</div>
								<?php

							}

							?>
							<div>
								You are not a member of this collaboration.
							</div>
							<?php

						}

					}

				}

			}

		}

		?>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<div id="message"></div>
		<script type="text/javascript" src="javascripts/show_col_members.js"></script>
		<script type="text/javascript" src="javascripts/change_membership.js"></script>
		<script type="text/javascript" src="javascripts/col_invitations.js"></script>
		<script type="text/javascript" src="javascripts/pop_up.js"></script>
		<script type="text/javascript" src="javascripts/scroll_to_viewport.js"></script>
		<script type="text/javascript" src="javascripts/autoload_collaboration_feeds.js"></script>
		<script type="text/javascript" src="javascripts/collection.js"></script>
		<script type="text/javascript" src="javascripts/col_posts_responses.js"></script>
		<script type="text/javascript" src="javascripts/leave_collaboration.js"></script>
		<script type="text/javascript" src="javascripts/collaboration_requests_action.js"></script>
		<script type="text/javascript" src="javascripts/collaboration_request.js"></script>
		<script type="text/javascript" src="javascripts/collaboration_posts.js"></script>
	</body>
</html>