<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$last_id = $_GET['end_feed'];

		if(ctype_alpha($unique_name)){

			$db_col = DBcollaborations::getInstance();
			$db_cm = DBcollaborations_members::getInstance();
			$user_data = $user->data();
			$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
			
			if($db_col->count()>0){

				$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));
				
				if($db_cm->count()>0){
			 		
					$member_info = $db_cm->first();
					$col_info = $db_col->first();
					$col_id = $col_info->col_id;
					$db = DB::getInstance();
					$db_ucl = DBusers_collections::getInstance();
					$db_cp = DBcollaborations_posts::getInstance();
					$db_cpr = DBcollaborations_posts_responses::getInstance();
					$db_cpc = DBcollaborations_posts_comments::getInstance();
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

					$no_posts_pp = 25;
					$db_cp->query("SELECT * FROM {$unique_name}_posts WHERE id<{$last_id} ORDER BY id DESC, date DESC LIMIT 0, {$no_posts_pp}", array(), 'SELECT *');
					$tot_posts = $db_cp->count();
					$show_posts = ($tot_posts>=$no_posts_pp)?$no_posts_pp:$tot_posts;
					if($tot_posts>0){

						$posts = $db_cp->results();

						for($i=0; $i<$show_posts; $i++){

							$post_info = $posts[$i];
							$db->get('users', array('id', '=', $post_info->posted_by));
							$p_user_data = $db->first();

							include '../include/col_posts_div.php';

						}

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

}

?>