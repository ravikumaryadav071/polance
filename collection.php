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
		$user = new user();

		if($user->isLoggedIn()){

			if(isset($_GET) && !empty($_GET)){
				$clc_id = $_GET['clc'];
				
				if(is_numeric($clc_id)){
					
					$db = DB::getInstance();
					$db_up = DBusers_posts::getInstance();
					$db_upr = DBusers_posts_responses::getInstance();
					$db_upc = DBusers_posts_comments::getInstance();
					$db_uc = DBusers_connection::getInstance();
					$db_ucl = DBusers_collections::getInstance();
					$db_col = DBcollaborations::getInstance();
					$db_cp = DBcollaborations_posts::getInstance();
					$db_cm = DBcollaborations_members::getInstance();
					$db_cpr = DBcollaborations_posts_responses::getInstance();
					$db_cpc = DBcollaborations_posts_comments::getInstance();
					$uc = user_connections::getInstance();
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
					$no_posts_pp = 20;
					$db_ucl->get($user_data->username.'_collections_lists', array('id', '=', $clc_id));
					if($db_ucl->count()>0){

						$clc_info = $db_ucl->first();
						$db_ucl->query("SELECT * FROM {$user_data->username}_collections WHERE clc_id={$clc_id} ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
						$tot_posts = $db_ucl->count();
						?>
						<div>
							<h2><?php echo $clc_info->collection_name; ?></h2>
						</div>
						<?php
						if($tot_posts>0){

							$clc_posts = $db_ucl->results();
							$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
							for($i=0; $i<$show_posts; $i++){

								unset($show_sec_feeder);
								$clc_post = $clc_posts[$i];
								$post_id = $clc_post->post_id;
								if($clc_post->post_type == 'USER'){

									$db->get('users', array('id', '=', $clc_post->userid));
									$p_user_data = $db->first();
									$p_userid = $p_user_data->id;
									$db_up->get($p_user_data->username.'_posts', array('id', '=', $clc_post->post_id));
									$post_info = $db_up->first();

									include 'include/popup_user_post_div.php';

								}else if($clc_post->post_type == 'COLLABORATION'){

									$db_col->get('collaborations', array('id', '=', $clc_post->userid));
									$col_data = $db_col->first();
									$unique_name = $col_data->unique_name;
									$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
									$col_info = $db_col->first();
									$db_cp->get($unique_name.'_posts', array('id', '=', $clc_post->post_id));
									$post_info = $db_cp->first();
									$db->get('users', array('id', '=', $post_info->posted_by));
									$p_user_data = $db->first();
									$p_userid = $p_user_data->id;
									$show_sec_feeder = "<a href='collaboration.php?col={$unique_name}'><img height='20px' width='24px' src='{$col_data->profile_pic_dg}' alt='{$col_data->collaboration_name}'>$col_data->collaboration_name</a>";

									include 'include/col_posts_div.php';

								}

							}

							?>
							<input type="hidden" id="end_feed" value="<?php echo $clc_posts[($show_posts-1)]->id; ?>">
							<img src="images/LoaderIcon.gif" id="load_more" alt="Loading...">
							<input type="hidden" id="clc_id" value="<?php echo $clc_id; ?>">
							<?php

						}else{
							?>
							<p>This collection is empty.</p>
							<?php
						}

					}

				}

			}

		}
		?>
		<script type="text/javascript" src="javascripts/autoload_collection.js"></script>
	</body>
</html>