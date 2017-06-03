<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$uc = user_connections::getInstance();
		$user_data = $user->data();
		$userid = $_SESSION['user'];
		$r_userid = $_GET['user'];
		$action = $_GET['action'];

		if($action == 'FOLLOW'){

			if(!$uc->isUserBlocked($r_userid)){

				if(!$uc->isFollowing($r_userid) && !$uc->isFriend($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						
						$user_info = $db->first();
						$db->get('users_last_updated', array('userid', '=', $r_userid));
						$last_feed = $db->first();
						$db_uf->insert($user_data->username.'_generate_feeds', array('generator_id'=>$r_userid, 'generator_type'=>'USER', 'new_feed_id'=>$last_feed->last_follower_id, 'last_seen_id'=>$last_feed->last_follower_id, 'last_updated'=>$last_feed->last_follower_time));
						if(!$uc->isUserFollower($r_userid)){
							$db_uc->insert($user_info->username.'_followers', array('userid'=>$userid, 'name_init'=>strtolower(substr($user_data->name, 0, 1)) ) );
						}
						$db_uf->query("SELECT id FROM {$user_data->username}_generate_feeds WHERE generator_id={$r_userid} AND generator_type='USER' LIMIT 0,1", array(), 'SELECT');
						$id_in_gf = $db_uf->first();
						$db_uc->insert($user_data->username.'_following', array('userid'=>$r_userid, 'id_in_gf'=>$id_in_gf->id, 'name_init'=>strtolower(substr($user_info->name, 0, 1)) ) );
						$db_un->insert($user_info->username.'_notifications', array('sec_userid'=>$user_data->id, 'action'=>'FOLLOWING'));

					}

					echo "You are now following {$user_info->name}.";

				}else{

					echo 'You are already friend of/following this user.';

				}

			}else{

				echo 'You are blocked by this user.';

			}			

		}else if($action == 'UNFOLLOW'){

			if(!$uc->isUserBlocked($r_userid)){

				if($uc->isFollowing($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						$user_info = $db->first();
						if($uc->isUserFollower($r_userid)){
							$db_uc->delete($user_info->username.'_followers', array('userid', '=', $userid));
						}
						$db_uc->get($user_data->username.'_following', array('userid', '=', $r_userid));
						$id_in_gf = $db_uc->first();
						$db_uf->delete($user_data->username.'_generate_feeds', array('id', '=', $id_in_gf->id_in_gf));
						$db_uc->delete($user_data->username.'_following', array('userid', '=', $r_userid));
						if($uc->hasUserRequest($r_userid)){
							$db_uc->delete($user_info->username.'_requests', array('userid', '=', $userid));
						}
					}

					echo "You are now following {$user_info->name}.";

				}else{

					echo 'You are not following this user.';

				}

			}else{

				echo 'You are blocked by this user.';

			}

		}else if($action == 'FRIEND'){

			if(!$uc->isUserBlocked($r_userid)){

				if(!$uc->isFriend($r_userid) && $uc->isUserFollower($r_userid)){

					if(!$uc->hasUserRequest($r_userid)){

						$db->get('users', array('id', '=', $r_userid));
						if(!$db->error()){
							$user_info = $db->first();
							if($uc->isUserFriend($r_userid)){
								$db_uc->delete($user_info->username.'_friends', array('userid', '=', $userid));
							}
							$db_uc->insert($user_info->username.'_requests', array('userid'=>$userid));
						}

						echo "Your friend request has been sent to {$user_info->name}.";

					}else{

						echo "You have already sent a friend request.";

					}

				}else{

					echo 'You are already a friend of this user.';

				}

			}else{

				echo 'You are blocked by this user.';

			}
			
		}else if($action == 'UNFRIEND'){

			if(!$uc->isUserBlocked($r_userid)){

				if($uc->isFriend($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						$user_info = $db->first();
						if($uc->isUserFriend($r_userid)){
							$db_uc->get($user_info->username.'_friends', array('userid', '=', $userid));
							$friend = $db_uc->first();

							$db_uc->delete($user_info->username.'_friends', array('userid', '=', $userid));

							if(strstr($friend->received_from, '_followers')){
								$db_uf->delete($user_info->username.'_generate_feeds', array('id', '=', $friend->id_in_gf));
								$db_uc->insert($friend->received_from, array('userid'=>$friend->userid, 'name_init'=>$friend->name_init));
							}else if(strstr($friend->received_from, '_following')){
								$db_uc->insert($friend->received_from, array('userid'=>$friend->userid, 'name_init'=>$friend->name_init, 'id_in_gf'=>$friend->id_in_gf));
							}
						
						}
						
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $r_userid));
						$friend = $db_uc->first();
						
						
						if($uc->hasUserRequest($r_userid)){
							$db_uc->delete($user_info->username.'_requests', array('userid', '=', $userid));
						}

						$db_uc->delete($user_data->username.'_friends', array('userid', '=', $r_userid));
						
						if(strstr($friend->received_from, '_followers')){
							$db_uf->delete($user_data->username.'_generate_feeds', array('id', '=', $friend->id_in_gf));
							$db_uc->insert($friend->received_from, array('userid'=>$friend->userid, 'name_init'=>$friend->name_init));
						}else if(strstr($friend->received_from, '_following')){
							$db_uc->insert($friend->received_from, array('userid'=>$friend->userid, 'name_init'=>$friend->name_init, 'id_in_gf'=>$friend->id_in_gf));
						}

					}

					echo "You have unfriend {$user_info->name}.";

				}else{

					echo 'You are not a friend of this user.';

				}

			}else{

				echo 'You are blocked by this user.';

			}
			
		}else if($action == 'BLOCK'){

			if(!$uc->isUserBlocked($r_userid)){

				if(!$uc->isBlocked($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						$user_info = $db->first();
						$db_uc->insert($user_data->username.'_blocked', array('userid'=>$r_userid));
					}

					echo "Now have blocked {$user_info->name}.";

				}else{

					echo 'You have already blocked this user.';

				}				

			}else{

				echo 'You are blocked by this user.';

			}
			
		}else if($action == 'UNBLOCK'){

			if(!$uc->isUserBlocked($r_userid)){

				if($uc->isBlocked($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						$user_info = $db->first();
						$db_uc->delete($user_data->username.'_blocked', array('userid', '=', $r_userid));
					}

					echo "You have unblocked {$user_info->name}.";

				}else{

					echo 'You have already unblocked this user.';

				}

			}else{

				echo 'You are blocked by this user.';

			}
			
		}else if($action == 'DELETE_FRIEND'){

			if(!$uc->isUserBlocked($r_userid)){

				if($uc->hasUserRequest($r_userid)){

					$db->get('users', array('id', '=', $r_userid));
					if(!$db->error()){
						$user_info = $db->first();
						$db_uc->delete($user_info->username.'_requests', array('userid', '=', $userid));
					}

					echo "You have deleted the friend request to {$user_info->name}.";

				}else{

					echo 'You have not sent a friend request.';

				}

			}else{

				echo 'You are blocked by this user.';

			}
			
		}

	}

}

?>