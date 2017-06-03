<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET)){

		$user_data = $user->data();
		$userid = $_SESSION['user'];
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$uc = user_connections::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_un  = DBusers_notifications::getInstance();

		$r_userid = $_GET['id'];
		$action = $_GET['action'];
		$db->get('users', array('id', '=', $r_userid));
		$r_user_info = $db->first();

		$db_uc->get($user_data->username.'_requests', array('userid', '=', $r_userid));
		$count = $db_uc->count();
		$db_uc->query("SELECT * FROM {$user_data->username}_friends WHERE userid = {$r_userid}", array(), 'SELECT *');
		$friend = $db_uc->count();

		if($count > 0){

			if($action == 'GRANT'){

				if($friend == 0){

					if(!$uc->isUserBlocked($r_userid) && $uc->isFollower($r_userid)){

						$db_uc->get($r_user_info->username.'_following', array('userid', '=' ,$userid));
						$following_info = $db_uc->first(); 
						$db_uc->insert($r_user_info->username.'_friends', array('userid'=>$userid, 'received_from'=>"{$r_user_info->username}_following", 'name_init'=>strtolower(substr($user_data->name, 0, 1)), 'id_in_gf'=>$following_info->id_in_gf));
						
						$db->get('users_last_updated', array('userid', '=', $r_userid));
						$last_feed = $db->first();
						
						$db_uf->insert($user_data->username.'_generate_feeds', array('generator_id'=>$r_userid, 'generator_type'=>'USER', 'new_feed_id'=>$last_feed->last_follower_id, 'last_seen_id'=>$last_feed->last_follower_id, 'last_updated'=>$last_feed->last_follower_time));
						$db_uf->query("SELECT id FROM {$user_data->username}_generate_feeds WHERE generator_id={$r_userid} AND generator_type='USER' LIMIT 0,1", array(), 'SELECT *');
						$id_in_gf = $db_uf->first();

						$db_uc->insert($user_data->username.'_friends', array('userid'=>$r_userid, 'received_from'=>"{$user_data->username}_followers", 'name_init'=>strtolower(substr($r_user_info->name, 0, 1)), 'id_in_gf'=>$id_in_gf->id));
						$db_un->insert($r_user_info->username.'_notifications', array('sec_userid'=>$user_data->id, 'action'=>'GRANTED'));
						$db_uc->delete($r_user_info->username.'_following', array('userid', '=' ,$userid));
						$db_uc->delete($user_data->username.'_followers', array('userid', '=', $r_userid));
						$db_uc->delete($user_data->username.'_requests', array('userid', '=', $r_userid));
						if(!$db_uc->error()){
							echo 'Permission granted';
						}else{
							echo 'There is some problem. Try again!';
						}


					}else{

						echo 'You are blocked by this user, cant accept this request.';

					}
				
				}else{

					echo "You have already granted the permission to this user.";

				}

			}else if($action == 'DELETE'){

				$db_uc->delete($user_data->username.'_requests', array('userid', '=', $r_userid));
				if(!$db_uc->error()){
					echo 'Request Deleted.';
				}else{
					echo 'There is some problem. Try again!';
				}
			
			}

		}

	}

}

?>