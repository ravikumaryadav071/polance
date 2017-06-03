<?php

require_once 'core/init.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$p_userid = $_GET['user'];
		$post_id = $_GET['post'];

		if(is_numeric($p_userid) && is_numeric($post_id)){

			$user_data = $user->data();
			$db = DB::getInstance();
			$db_up = DBusers_posts::getInstance();
			$db_upc = DBusers_posts_comments::getInstance();
			$db_upr = DBusers_posts_responses::getInstance();
			$db_uc = DBusers_connection::getInstance();
			$uc = user_connections::getInstance();
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
			if($db->count()>0){
			
				$p_user_data = $db->first();
				$db_up->get($p_user_data->username.'_posts', array('id', '=', $post_id));
				if($db_up->count()>0){
					
					$post_info = $db_up->first();

					include 'include/popup_user_post_div.php';

				}

			}

		}

	}

}

?>