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
		//ini_set('display_error', 1);
		//error_reporting(-1);
		if (session::exists('home')) {
			echo '<p>' . session::flash('home') . '</p>';	
		}

		//echo session::get(config::get('session/session_name'));
		$user = new user();
		if ($user->isLoggedIn()) {
			//echo "Logged In";
			$user_data = $user->data();
			if(isset($user_data->profile_pic)){

				if($user_data->profile_pic == ''){
					redirect::to('upload_profile_pic.php');
				}

			}

			$db_uf = DBusers_feeds::getInstance();
			$db = DB::getInstance();
			$db_ui = DBusers_interests::getInstance();
			$db_up = DBusers_posts::getInstance();
			$db_upr = DBusers_posts_responses::getInstance();
			$db_upc = DBusers_posts_comments::getInstance();
			$db_uc = DBusers_connection::getInstance();
			$db_ucl = DBusers_collections::getInstance();
			$db_col = DBcollaborations::getInstance();
			$db_cp = DBcollaborations_posts::getInstance();
			$db_cpr = DBcollaborations_posts_responses::getInstance();
			$uc = user_connections::getInstance();

			?>	
			<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?> </a>! </p>
			<div id="search_form">
				<form id="search_form" action="search.php" method="post">
					<input type="text" name="search_text" id="search_text" placeholder="Serach by Name or Username" autocomplete="off">
					<input type="submit" name="search" id="search" value="search">
				</form>
			</div>
			
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
					<input type="button" id="remove_checked" value="Done" hidden="hidden">
					<?php
					$db_ucl->query("SELECT * FROM {$user_data->username}_collections_lists", array(), 'SELECT *');
					$tot_clc = $db_ucl->count();
					if($tot_clc>0){
						$clcns = $db_ucl->results();
						for($i=0; $i<$tot_clc; $i++){
							$clcn = $clcns[$i];
							?>
							<div id="collection">
								<br><a href="collection.php?clc=<?php echo $clcn->id; ?>"><?php echo $clcn->collection_name; ?></a><br>
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
				<form id="post_creation" method="POST" action="submit_users_posts.php" enctype="multipart/form-data">
					<div id="editor_1">
						<textarea id="read_text" name="read_text[]" placeholder="Write Down Your Post"></textarea>
						<input type="hidden" name="editor_pos[]" id="text_editor" value="1">
					</div>
					<input type="button" id="add_files" value="ADD FILES">
					<div>
						<label for="add_tags">Tags: </label>
						<input type="text" id="add_tags">
						<input type="button" id="add_tags_to_list" value="ADD">
						<div id="suggested_tags"></div>
						<div id="added_tags">
						</div>
					</div>
					<div>
						<label for="sugst_contri_user">Contributors: </label>
						<input type="text" id="sugst_contri_user">
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

			<?php
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

			unset($_SESSION['updated_feeds']);
			$_SESSION['updated_feeds']['users'] = array();
			$_SESSION['updated_feeds']['collaboration'] = array();

			$up_users = $_SESSION['updated_feeds']['users'];
			$up_cols = $_SESSION['updated_feeds']['collaboration'];
			$no_users_updated = 25;		//no of usrs updated per cycle
			$no_friends = 25;
			$condition = "";
			$count = 0;
			$cycle = 0;
			
			//updating user
			$db->get('users_last_updated', array('userid', '=', $user_data->id));
			$user_update = $db->first();
			$db_uf->get($user_data->username.'_generate_feeds', array('id', '=', '1'));
			$user_gf_info = $db_uf->first();
			if($user_gf_info->new_feed_id != $user_update->last_friend_id){
				$db_uf->update($user_data->username.'_generate_feeds', array('new_feed_id'=>$user_update->last_friend_id, 'last_updated'=>$user_update->last_friend_time), array('id', '=', '1'));
			}else{
				$db_uf->update($user_data->username.'_generate_feeds', array('last_updated'=>$user_update->last_friend_time), array('id', '=', '1'));
			}

			//updating friends
			do{
				
				$db_uc->query("SELECT userid, id_in_gf FROM {$user_data->username}_friends ORDER BY priority DESC, userid DESC LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
				$tot_users = $db_uc->count();
				if($tot_users>0){
					$users = $db_uc->results();
					for($i=0; $i<$tot_users; $i++){
						$f_user = $users[$i];
						if(!in_array($f_user->userid, $up_users)){
							$up_users[] = $f_user->userid;
							$db->get('users_last_updated', array('userid', '=', $f_user->userid));
							$user_update = $db->first();
							$db_uf->get($user_data->username.'_generate_feeds', array('id', '=', $f_user->id_in_gf));
							$user_gf_info = $db_uf->first();
							if($user_gf_info->new_feed_id != $user_update->last_friend_id){
								$db_uf->update($user_data->username.'_generate_feeds', array('new_feed_id'=>$user_update->last_friend_id, 'last_updated'=>$user_update->last_friend_time), array('id', '=', $f_user->id_in_gf));
							}else{
								$db_uf->update($user_data->username.'_generate_feeds', array('last_updated'=>$user_update->last_friend_time), array('id', '=', $f_user->id_in_gf));
							}
							$count++;
						}
					}

				}else{
					break;
				}

				$cycle++;

			}while($cycle<2&&$count<30);

			//updating followings
			do{
				$db_uc->query("SELECT userid, id_in_gf FROM {$user_data->username}_following ORDER BY priority DESC, userid DESC LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
				$tot_users = $db_uc->count();
				if($tot_users>0){
					$users = $db_uc->results();
					for($i=0; $i<$tot_users; $i++){
						$f_user = $users[$i];
						if(!in_array($f_user->userid, $up_users)){
							$up_users[] = $f_user->userid;
							$db->get('users_last_updated', array('userid', '=', $f_user->userid));
							$user_update = $db->first();
							$db_uf->get($user_data->username.'_generate_feeds', array('id', '=', $f_user->id_in_gf));
							$user_gf_info = $db_uf->first();
							if($user_gf_info->new_feed_id != $user_update->last_follower_id){
								$db_uf->update($user_data->username.'_generate_feeds', array('new_feed_id'=>$user_update->last_follower_id, 'last_updated'=>$user_update->last_follower_time), array('id', '=', $f_user->id_in_gf));
							}else{
								$db_uf->update($user_data->username.'_generate_feeds', array('last_updated'=>$user_update->last_follower_time), array('id', '=', $f_user->id_in_gf));
							}
							$count++;
						}
					}

				}else{
					break;
				}

				$cycle++;

			}while($cycle<2&&$count<30);
			
			$cycle = 0;
			$count = 0;
			do{

				$db_ui->query("SELECT * FROM {$user_data->username}_collaborations", array(), 'SELECT *');
				$tot_cols = $db_ui->count();

				if($tot_cols>0){

					$cols = $db_ui->results();
					for($i=0; $i<$tot_cols; $i++){
						$col = $cols[$i];
						if(!in_array($col->col_id, $up_cols)){
							$up_cols[] = $col->col_id;
							$db_col->get('collaborations_last_updated', array('col_id', '=', $col->col_id));
							if($db_col->count()>0){
								$last_updated = $db_col->first();
								$db_uf->query("SELECT * FROM {$user_data->username}_generate_feeds WHERE generator_id={$col->col_id} AND generator_type='COLLABORATION'", array(), 'SELECT *');
								$f_col_info = $db_uf->first();
								if($f_col_info->new_feed_id != $last_updated->last_id){
									$db_uf->update("{$user_data->username}_generate_feeds", array('new_feed_id'=>$last_updated->last_id, 'last_updated'=>$last_updated->last_time), array('id', '=', $f_col_info->id));
								}else{
									$db_uf->update("{$user_data->username}_generate_feeds", array('last_updated'=>$last_updated->last_time), array('id', '=', $f_col_info->id));
								}
							}
						}
					}

					if($tot_cols<=30){
						break;
					}
				}

			}while($cycle<2&&$count<20);

			$db_uf->query("UPDATE {$user_data->username}_generate_feeds SET pointer=(last_seen_id+1)", array(), 'UPDATE');
			$db_uf->query("TRUNCATE {$user_data->username}_feeder", array(), 'TRUNCATE');
			//feed_fetching
			$_SESSION['pre_upv_comm_upl'] = array();
			$_SESSION['pre_varify'] = array();
			$_SESSION['pre_shared'] = array();
			$no_feeders = 10;
			$post_counter = 0;
			$loop_counter = 0;
			$posts = array();
			$f_users_info = array(); 	//feed users info
			do{
			
				$db_uf->query("SELECT * FROM {$user_data->username}_generate_feeds WHERE last_seen_id!=new_feed_id ORDER BY last_updated DESC LIMIT 0,{$no_feeders}", array(), 'SELECT *');
				$tot_feeders = $db_uf->count();
				if($tot_feeders>0){
					$feeders = $db_uf->results();
					if( (($tot_feeders == 1) && ($feeders[0]->new_feed_id != 0)) || ($tot_feeders != 1) ){
						for($i=0; $i<$tot_feeders; $i++){
							$feeder = $feeders[$i];
							//print_r($feeder);
							$new_feed_id = $feeder->new_feed_id;
							$last_seen_id = $feeder->last_seen_id;

							if($feeder->generator_type == 'USER'){
							
								$f_userid = $feeder->generator_id;
								$db->get('users', array('id', '=', $f_userid));
								$f_user = $db->first();
								if($uc->isFriend($f_userid) || ($f_userid == $user_data->id) ){
									$privacy_condition = "(privacy='PUBLIC' OR privacy='FOLLOWERS' OR privacy='FRIENDS')";
								}else if($uc->isFollowing($f_userid)){
									$privacy_condition = "(privacy='PUBLIC' OR privacy='FOLLOWERS')";
								}else{
									$privacy_condition = "(privacy='PUBLIC')";
								}
								$db_uf->query("SELECT * FROM {$f_user->username}_feeds WHERE id<={$new_feed_id} AND id>{$last_seen_id} AND action!='REPORTED' AND action!='DOWNVOTED' AND {$privacy_condition} GROUP BY userid, sec_id, post_id, post_type, privacy, action ORDER BY id DESC LIMIT 0,5", array(), 'SELECT *');
								$tot_posts = $db_uf->count();
								if($tot_posts>0){
									$this_posts = $db_uf->results();
									for($j=0; $j<$tot_posts; $j++){
										$db_uf->query("INSERT INTO {$user_data->username}_feeder (`feeder_id`, `feed_id`, `userid`, `sec_id`, `post_id`, `post_type`, `action`, `date`) VALUES ({$f_userid}, {$this_posts[$j]->id}, {$this_posts[$j]->userid}, {$this_posts[$j]->sec_id}, {$this_posts[$j]->post_id}, '{$this_posts[$j]->post_type}', '{$this_posts[$j]->action}', '{$this_posts[$j]->date}')", array(), 'INSERT');
										// if($db_up->error()){
										// 	echo 'here';
										// }
										$f_users_info[$post_counter] = array('userid'=>$f_userid, 'user_type'=>'USER');
										$post_counter++;
									}
									$pointer = $this_posts[($tot_posts-1)]->id;
									$last_updated = $this_posts[($tot_posts-1)]->date;
									$db_uf->update($user_data->username.'_generate_feeds', array('last_seen_id'=>$new_feed_id, 'pointer'=>$pointer, 'last_updated'=>$last_updated), array('id', '=', $feeder->id));
									if($post_counter>30){
										break;
									}
								}
								//print_r($posts);
								//echo "<br>{$pointer}<br>";

							}else if($feeder->generator_type == 'COLLABORATION'){

								$f_userid = $feeder->generator_id;
								$db_col->get('collaborations', array('id', '=', $f_userid));
								$col_data = $db_col->first();
								$db_cp->query("SELECT * FROM {$col_data->unique_name}_posts WHERE id<={$new_feed_id} AND id>{$last_seen_id} ORDER BY id DESC LIMIT 0,5", array(), 'SELECT *');
								$tot_posts = $db_cp->count();
								if($tot_posts>0){
									$this_posts = $db_cp->results();
									for($j=0; $j<$tot_posts; $j++){
										$db_uf->query("INSERT INTO {$user_data->username}_feeder (`feeder_id`, `feeder_type`, `feed_id`, `userid`, `sec_id`, `post_id`, `post_type`, `action`, `date`) VALUES ({$f_userid}, 'COLLABORATION', {$this_posts[$j]->id}, {$this_posts[$j]->posted_by}, 0, {$this_posts[$j]->id}, 'COLLABORATION', 'UPLOADED', '{$this_posts[$j]->date}')", array(), 'SELECT *');
										$f_users_info[$post_counter] = array('userid'=>$f_userid, 'user_type'=>'COLLABORATION');
										$post_counter++;
									}
									$pointer = $this_posts[($tot_posts-1)]->id;
									$last_updated = $this_posts[($tot_posts-1)]->date;
									$db_uf->update($user_data->username.'_generate_feeds', array('last_seen_id'=>$new_feed_id, 'pointer'=>$pointer, 'last_updated'=>$last_updated), array('id', '=', $feeder->id));
									if($post_counter>30){
										break;
									}
								}

							}

						}

					}

				}
				if($tot_feeders==0 || $post_counter<10){
					
					$db_uf->query("SELECT * FROM {$user_data->username}_generate_feeds ORDER BY last_updated DESC LIMIT 0,{$no_feeders}", array(), 'SELECT *');
					$tot_feeders = $db_uf->count();
					if($tot_feeders>0){

						$feeders = $db_uf->results();
						
						if(  (($tot_feeders == 1) && ($feeders[0]->new_feed_id != 0)) || ($tot_feeders != 1) ){
							for($i=0; $i<$tot_feeders; $i++){

								$feeder = $feeders[$i];
								$pointer = $feeder->pointer;
								$last_seen_id = $feeder->last_seen_id;
								
								if($feeder->generator_type == 'USER'){
									
									if($last_seen_id!=0 && $last_seen_id!=1){
										$f_userid = $feeder->generator_id;
										$db->get('users', array('id', '=', $f_userid));
										$f_user = $db->first();
										if($uc->isFriend($f_userid) || ($f_userid == $user_data->id)){
											$privacy_condition = "(privacy='PUBLIC' OR privacy='FOLLOWERS' OR privacy='FRIENDS')";
										}else if($uc->isFollowing($f_userid)){
											$privacy_condition = "(privacy='PUBLIC' OR privacy='FOLLOWERS')";
										}else{
											$privacy_condition = "(privacy='PUBLIC')";
										}
										$db_uf->query("SELECT * FROM {$f_user->username}_feeds WHERE id<{$pointer} AND action!='REPORTED' AND action!='DOWNVOTED' AND {$privacy_condition} GROUP BY userid, sec_id, post_id, post_type, privacy, action ORDER BY id DESC LIMIT 0,5", array(), 'SELECT *');
										$tot_posts = $db_uf->count();
										//echo $pointer;
										//echo "SELECT * FROM {$f_user->username}_feeds WHERE id<{$pointer} AND action!='REPORTED' AND action!='DOWNVOTED' ORDER BY id LIMIT 0,5";
										if($tot_posts>0){
											$this_posts = $db_uf->results();
											for($j=0; $j<$tot_posts; $j++){
												$db_uf->query("INSERT INTO {$user_data->username}_feeder (`feeder_id`, `feed_id`, `userid`, `sec_id`, `post_id`, `post_type`, `action`, `date`) VALUES ({$f_userid}, {$this_posts[$j]->id}, {$this_posts[$j]->userid}, {$this_posts[$j]->sec_id}, {$this_posts[$j]->post_id}, '{$this_posts[$j]->post_type}', '{$this_posts[$j]->action}', '{$this_posts[$j]->date}')", array(), 'INSERT');
												$f_users_info[$post_counter] = array('userid'=>$f_userid, 'user_type'=>'USER');
												$post_counter++;
											}
											$pointer = $this_posts[($tot_posts-1)]->id;
											$last_updated = $this_posts[($tot_posts-1)]->date;
											$db_uf->update($user_data->username.'_generate_feeds', array('pointer'=>$pointer, 'last_updated'=>$last_updated), array('id', '=', $feeder->id));
											if($post_counter>30){
												break;
											}
										}
										//print_r($posts);
										//echo "<br>{$pointer}<br>";

									}

								}else if($feeder->generator_type == 'COLLABORATION'){

									$f_userid = $feeder->generator_id;
									$db_col->get('collaborations', array('id', '=', $f_userid));
									$col_data = $db_col->first();
									$db_cp->query("SELECT * FROM {$col_data->unique_name}_posts WHERE id<{$pointer} ORDER BY id DESC LIMIT 0,5", array(), 'SELECT *');
									$tot_posts = $db_cp->count();
									if($tot_posts>0){
										$this_posts = $db_cp->results();
										for($j=0; $j<$tot_posts; $j++){
											$db_uf->query("INSERT INTO {$user_data->username}_feeder (`feeder_id`, `feeder_type`, `feed_id`, `userid`, `sec_id`, `post_id`, `post_type`, `action`, `date`) VALUES ({$f_userid}, 'COLLABORATION', {$this_posts[$j]->id}, {$this_posts[$j]->posted_by}, 0, {$this_posts[$j]->id}, 'COLLABORATION', 'UPLOADED', '{$this_posts[$j]->date}')", array(), 'SELECT *');
											$f_users_info[$post_counter] = array('userid'=>$f_userid, 'user_type'=>'COLLABORATION');
											$post_counter++;
										}
										$pointer = $this_posts[($tot_posts-1)]->id;
										$last_updated = $this_posts[($tot_posts-1)]->date;
										$db_uf->update($user_data->username.'_generate_feeds', array('pointer'=>$pointer, 'last_updated'=>$last_updated), array('id', '=', $feeder->id));
										if($post_counter>30){
											break;
										}
									}

								}

							}

						}

					}
				
				}
				
				$loop_counter++;

			}while( ($post_counter<=20)&&($loop_counter<2));

			$db_uf->query("SELECT * FROM {$user_data->username}_feeder ORDER BY date DESC, id ASC LIMIT 0,200", array(), 'SELECT *');
			$all_posts = $db_uf->count();
			?>
			<div>
				<div>Overview</div>
				<div id="feeds_area">
					<?php
					if($all_posts>0){
						$posts = $db_uf->results();
						for($i=0; $i<$all_posts; $i++){

							$post = $posts[$i];
							$action = $post->action;
							$passed = false;
							if( ($action=='UPVAOTED')||($action=='COMMENTED')||($action=='UPLOADED')){
								if(isset($_SESSION['pre_upv_comm_upl'])){
									if(!in_array(array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>$post->feeder_type), $_SESSION['pre_upv_comm_upl'])){
										$_SESSION['pre_upv_comm_upl'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>$post->feeder_type);
										$passed = true;
									}else{
										$passed = false;
									}
								}else{
									$_SESSION['pre_upv_comm_upl'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>$post->feeder_type);
									$passed = true;
								}
							}else if($action=='VARIFIED'){
								if(isset($_SESSION['pre_varify'])){
									if(!in_array(array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER'), $_SESSION['pre_varify'])){
										$_SESSION['pre_varify'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER');
										$passed = true;
									}else{
										$passed = false;
									}
								}else{
									$_SESSION['pre_varify'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER');
									$passed = true;
								}
							}else if($action=='SHARED'){
								if(isset($_SESSION['pre_shared'])){
									if(!in_array(array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER'), $_SESSION['pre_shared'])){
										$_SESSION['pre_shared'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER');
										$passed = true;
									}else{
										$passed = false;
									}
								}else{
									$_SESSION['pre_shared'][] = array('post_id'=>$post->post_id, 'userid'=>$post->userid, 'user_type'=>'USER');
									$passed = true;
								}
							}

							if($passed){

								//$f_user_info = $f_users_info[$i];
								//$f_user_info = $post->feeder_id;
								if($post->feeder_type == 'USER'){
									
									$db->get('users', array('id', '=', $post->feeder_id));
									$f_user_data = $db->first();
									$f_userid = $f_user_data->id;
									$show_sec_feeder = "";
									unset($o_user_data);
									unset($o_user);
									if($post->userid != $f_user_data->id){
										$db->get('users', array('id', '=', $post->userid));
										$p_user_data = $db->first();
									}else{
										$p_user_data = $f_user_data;
									}
									
									$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
									$post_info = $db_up->first();

									$up_count = $post_info->tot_upvotes;
									$down_count = $post_info->tot_downvotes;
									$share_count = $post_info->tot_shares;
									$comment_count = $post_info->tot_comments;
									$varify_count = $post_info->tot_varify;
									
									if($action != 'UPLOADED'){

										if($action=='UPVOTED'){
											
											$db_upr->query("SELECT * FROM {$p_user_data->username}_{$post->post_id}_upvotes WHERE userid!={$f_userid} LIMIT 0,1", array(), 'SELECT *');
											if($db_upr->count()>0){
												$o_user = $db_upr->first();
												$db->get('users', array('id', '=', $o_user->userid));
												$o_user_data = $db->first();
											}
											$show_sec_feeder = "<a href=profile.php?user='{$f_user_data->username}'>{$f_user_data->name}</a>";
											if(isset($o_user_data) && $up_count>2){
												$others = $up_count-2;
												$show_sec_feeder .= ", <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}</a> and {$others} other(s) upvoted this post.";
											}else if(isset($o_user_data)){
												$show_sec_feeder .= " and <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}</a> upvoted this post.";
											}else{
												$show_sec_feeder .= " upvoted this post.";
											}
										
										}else if($action=='COMMENTED'){

											if($comment_count>0){
											
												$db_upc->query("SELECT DISTINCT userid FROM {$p_user_data->username}_{$post->post_id}_comments WHERE userid!={$f_userid} LIMIT 0,1", array(), 'SELECT *');
												
												if($db_upc->count()>0){
													$o_user = $db_upc->first();
													$db->get('users', array('id', '=', $o_user->userid));
													$o_user_data = $db->first();
												}
												if(isset($o_user_data)){
													$show_sec_feeder = "<a href=profile.php?user='{$f_user_data->username}'>{$f_user_data->name}'s</a>";
												}else{
													$show_sec_feeder = "<a href=profile.php?user='{$f_user_data->username}'>{$f_user_data->name}</a>";
												}
												if(isset($o_user_data) && $comment_count>2){
													$others = $comment_count-2;
													$show_sec_feeder .= ", <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}'s</a> and {$others} more comments on this post.";
												}else if(isset($o_user_data)){
													$show_sec_feeder .= " and <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}'s</a> commented on this post.";
												}else{
													$show_sec_feeder .= " commented on this post.";
												}

											}
										
										}else if($action=='VARIFIED'){

											$db_upr->query("SELECT * FROM {$p_user_data->username}_{$post->post_id}_varify WHERE userid!={$f_userid} LIMIT 0,1", array(), 'SELECT *');
											if($db_upr->count()>0){
												$o_user = $db_upr->first();
												$db->get('users', array('id', '=', $o_user->userid));
												$o_user_data = $db->first();
											}
											$show_sec_feeder = "<a href=profile.php?user='{$f_user_data->username}'>{$f_user_data->name}</a>";
											if(isset($o_user_data) && $varify_count>2){
												$others = $up_count-2;
												$show_sec_feeder .= ", <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}</a> and {$others} other(s) verified this post.";
											}else if(isset($o_user_data)){
												$show_sec_feeder .= " and <a href=profile.php?user='{$o_user_data->username}'>{$o_user_data->name}</a> varified this post.";
											}else{
												$show_sec_feeder .= " verified this post.";
											}

										}else if($action=='SHARED'){

											$show_sec_feeder = "<a href=profile.php?user='{$f_user_data->username}'>{$f_user_data->name}</a> shared this post.";
											
										}

									}

									include 'include/all_posts_div.php';
								
								}else if($post->feeder_type=='COLLABORATION'){

									$col_id = $post->feeder_id;
									$db_col->get('collaborations', array('id', '=', $col_id));
									$col_data = $db_col->first();
									$unique_name = $col_data->unique_name;
									$db_cp->get("{$unique_name}_posts", array('id', '=', $post->post_id));
									$post_info = $db_cp->first();
									$show_sec_feeder = "<a href='collaboration.php?col={$unique_name}' target='_blank'><img src='{$col_data->profile_pic_dg}' height='20px' width='24px' alt='{$col_data->collaboration_name}'>{$col_data->collaboration_name}</a>";
									include 'include/col_posts_div.php';

								}

							}

						}
					}else{
						echo '<p>You do not have any feeds.</p>';
					}
					?>
					<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
				</div>
			</div>
			<div id="error"></div>
			<div id="message"></div>
			<ul>
				<li><a href="logout.php">Logout</a></li>
				<li><a href="update.php">Udate</a></li>
				<li><a href="changepwd.php">Change Password</a></li>
				<li><a href="notifications.php">Notifications</a></li>
				<li><a href="my_groups.php">Groups</a></li>
			</ul>
			<?php
			
			

		} 
		else {
			
			echo '<p>You need to <a href="login.php">log in </a> or <a href="register.php">register</a></p>';

		}
		?>
		<div id="light" class="white_content">
			<a id="close_popup" href="javascript:void(0)">Close</a>
			<div id="popup_content">
			</div>
		</div>
		<div id="fade" class="black_overlay"></div>
		<script type="text/javascript" src="javascripts/show_more_tags.js"></script>
		<script type="text/javascript" src="javascripts/pop_up.js"></script>
		<script type="text/javascript" src="javascripts/show_responses.js"></script>
		<script type="text/javascript" src="javascripts/content_toggle.js"></script>
		<script type="text/javascript" src="javascripts/send_to_main_page.js"></script>
		<script type="text/javascript" src="javascripts/autoload_overview_feeds.js"></script>
		<script type="text/javascript" src="javascripts/collection.js"></script>
		<script type="text/javascript" src="javascripts/post_responses.js"></script>
		<script type="text/javascript" src="javascripts/update_feeds.js"></script>
		<script type="text/javascript" src="javascripts/update_me.js"></script>
		<script type="text/javascript" src="javascripts/search.js"></script>
		<script type="text/javascript" src="javascripts/posts.js"></script>
	</body>
</html>