<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$last_feed = $_GET['end_feed'];
		$p_userid = $_GET['user'];
		if(is_numeric($last_feed) && is_numeric($p_userid)){

			$user_data = $user->data();
			$db = DB::getInstance();
			$uc = user_connections::getInstance();
			$db_uf = DBusers_feeds::getInstance();
			$db_up = DBusers_posts::getInstance();
			$db_upr = DBusers_posts_responses::getInstance();
			$no_posts_pp = 20;		//no of posts per page
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

			$db->get('users', array('id', '=', $p_userid));
			$p_user_data = $db->first();

			if($p_user_data->id == $user_data->id){

				$p_user_data = $user_data;
				$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' AND id<{$last_feed} ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
				$tot_posts = $db_uf->count();
				
				if($tot_posts>0){

					$posts = $db_uf->results();
					$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
					
					for($i=0; $i<$show_posts; $i++){
						
						$post = $posts[$i];
						$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
						$post_info = $db_up->first();
						$show_sec_feeder = "";
						include '../include/all_posts_div.php';
					
					}

				}else{

					?>
					<div>You have not uploaded anything.</div>
					<?php

				}


			}else{

				if($uc->isFriend($p_user_data->id)){

					$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' AND id<{$last_feed} AND (privacy='FRIENDS' OR privacy='FOLLOWERS' OR privacy='PUBLIC') ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
					$tot_posts = $db_uf->count();
						
					if($tot_posts>0){

						$posts = $db_uf->results();
						$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
					
						for($i=0; $i<$show_posts; $i++){
							
							$post = $posts[$i];
							$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
							$post_info = $db_up->first();
							$show_sec_feeder = "";
							include '../include/all_posts_div.php';
						
						}

					}else{

						?>
						<div><?php echo $p_user_data->name; ?> has not uploaded anything.</div>
						<?php

					}

				}else if($uc->isUserFollowing($p_user_data->id)){

					$db_uf->query("SELECT * FROM {$p_user_data->username}_feeds WHERE action='UPLOADED' AND id<{$last_feed} AND (privacy='FOLLOWERS' OR privacy='PUBLIC') ORDER BY id DESC LIMIT 0,{$no_posts_pp}", array(), 'SELECT *');
					$tot_posts = $db_uf->count();
					if($tot_posts>0){

						$posts = $db_uf->results();
						$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
					
						for($i=0; $i<$show_posts; $i++){
							
							$post = $posts[$i];
							$db_up->get($p_user_data->username.'_posts', array('id', '=', $post->post_id));
							$post_info = $db_up->first();
							$show_sec_feeder = "";
							include '../include/all_posts_div.php';
						
						}

					}else{

						?>
						<div><?php echo $p_user_data->name; ?> has not uploaded anything.</div>
						<?php

					}

				}

			}

			if(isset($tot_posts)){
				if($tot_posts>0){
					?>
					<input type="hidden" id="end_feed" value="<?php echo $posts[($show_posts-1)]->id; ?>">
					<?php
				}else{
					echo 'No more posts.';
				}
			}

		}

	}

}

?>