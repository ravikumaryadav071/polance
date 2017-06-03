<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET)&&!empty($_GET)){

		$user_data = $user->data();
		$col_id = $_GET['col'];
		$post_id = $_GET['post_id'];
		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
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
		$unique_name = $col_data->unique_name;
		
		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		$col_info = $db_col->first();

		$db_cp->get($unique_name.'_posts', array('id', '=', $post_id));
		$post_info = $db_cp->first();

		$db->get('users', array('id', '=', $post_info->posted_by));
		$p_user_data = $db->first();

		$show_sec_feeder = "<a href='collaboration.php?col={$unique_name}'><img height='20px' width='24px' src='{$col_data->profile_pic_dg}' alt='{$col_data->collaboration_name}'>{$col_data->collaboration_name}</a>";

		include '../include/col_posts_div.php';
	
	}

}

?>