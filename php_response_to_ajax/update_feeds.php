<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_SESSION['updated_feeds'])){

		$_SESSION['update_me'] = time();
		
		//should be in other file
		//$_SESSION['updated_feeds'] = $_SESSION['updated_feeds'];
		$db = DB::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$user_data = $user->data();
		$no_users_updated = 25;		//no of usrs updated per cycle
		$condition = "";
		
		for($i=0; $i<count($_SESSION['updated_feeds']['users']); $i++){

			$f_userid = $_SESSION['updated_feeds']['users'][$i];
			if($i==0){
				$condition .= "userid != {$f_userid}";
			}else{
				$condition .= "AND userid != {$f_userid}";
			}

		}

		if($condition != ""){
			$db_uc->query("SELECT * FROM {$user_data->username}_friends WHERE ({$condition}) ORDER BY priority DESC, userid DESC LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
			$tot_friends = $db_uc->count();
		}else{
			$db_uc->query("SELECT * FROM {$user_data->username}_friends ORDER BY userid LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
			$tot_friends = $db_uc->count();
		}
		
		if($tot_friends>0){

			$friends = $db_uc->results();
		
			for($i=0; $i<$tot_friends; $i++){
				$friend = $friends[$i];
				if($i==0){
					$condition2 = "userid = {$friend->userid}";
				}else{
					$condition2 .= " OR userid = {$friend->userid}";
				}
			}
		
			$db->query("SELECT * FROM users_last_updated WHERE {$condition2} ORDER BY last_friend_time DESC LIMIT 0,{$no_users_updated}");
			$tot_updates = $db->count();

			if($tot_updates>0){

				$update_users = $db->results();

				for($i=0; $i<$tot_updates; $i++){

					$update_user = $update_users[$i];
					$_SESSION['updated_feeds']['users'][] = $update_user->userid;
					//print_r($update_user);
					$db_uf->get("{$user_data->username}_blocked_feeders", array('userid', '=', $update_user->userid));
					if($db_uf->count()==0){
						$db_uf->query("SELECT * FROM {$user_data->username}_generate_feeds WHERE generator_id={$update_user->userid} AND generator_type='USER'", array(), 'SELECT *');
						$uf_info = $db_uf->first();		//user's feed info
						if($uf_info->last_seen_id != $update_user->last_friend_id){
							$db_uf->query("UPDATE {$user_data->username}_generate_feeds SET new_feed_id={$update_user->last_friend_id}, last_updated='{$update_user->last_friend_time}' WHERE generator_id={$update_user->userid} AND generator_type='USER'", array(), 'UPDATE');
						}
					}

				}

			}
		
		}

		if($condition != ""){
			$db_uc->query("SELECT * FROM {$user_data->username}_following WHERE ({$condition}) ORDER BY priority DESC, userid DESC LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
		}else{
			$db_uc->query("SELECT * FROM {$user_data->username}_following ORDER BY priority DESC, userid DESC LIMIT 0,{$no_users_updated}", array(), 'SELECT *');
		}
		$tot_following = $db_uc->count();

		if($tot_following>0){
			
			$followings = $db_uc->results();
			
			for($i=0; $i<$tot_following; $i++){
				$following = $followings[$i];
				if($i==0){
					$condition2 = "userid = {$following->userid}";
				}else{
					$condition2 .= "OR userid = {$following->userid}";
				}
			}

			$db->query("SELECT * FROM users_last_updated WHERE {$condition2} ORDER BY last_follower_time DESC LIMIT 0,{$no_users_updated}");
			$tot_updates = $db->count();
			if($tot_updates>0){

				$update_users = $db->results();

				for($i=0; $i<$tot_updates; $i++){

					$update_user = $update_users[$i];
					$_SESSION['updated_feeds']['users'][] = $update_user->userid;
					$db_uf->get("{$user_data->username}_blocked_feeders", array('userid', '=', $update_user->userid));
					if($db_uf->count()==0){
						$db_uf->query("SELECT * FROM {$user_data->username}_generate_feeds WHERE generator_id={$update_user->userid} AND generator_type='USER'", array(), 'SELECT *');
						$uf_info = $db_uf->first();		//user's feed info
						if($uf_info->last_seen_id != $update_user->last_follower_id){
							$db_uf->query("UPDATE {$user_data->username}_generate_feeds SET new_feed_id={$update_user->last_follower_id}, last_updated='{$update_user->last_follower_time}' WHERE generator_id={$update_user->userid} AND generator_type='USER'", array(), 'UPDATE');
						}
					}

				}

			}

		}

		
		//code for collaboration



	}

}

?>