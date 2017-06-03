<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$comment  = trim($_POST['comment_text']);
		$p_userid = $_POST['user'];
		$post_type = $_POST['post_type'];
		$post_id = $_POST['post_id'];

		$db = DB::getInstance();
		$db_upc = DBusers_posts_comments::getInstance();
		$db_up = DBusers_posts::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$uc = user_connections::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$user_data = $user->data();

		if($p_userid != $user_data->id){
			$db->get('users', array('id', '=', $p_userid));
			$p_user_data = $db->first();
		}else{
			$p_user_data = $user_data;
		}

		if($post_type == 'USER'){

			$db_up->get("{$p_user_data->username}_posts", array('id', '=', $post_id));
			$post_info = $db_up->first();
			$privacy = $post_info->privacy;

			if( ($privacy == 'PUBLIC') || ($p_userid == $user_data->id) || ($privacy=='FOLLOWERS' && $uc->isFollowing($p_userid)) || ($privacy=='FOLLOWERS' && $uc->isFriend($p_userid)) || ($privacy=='FRIENDS' && $uc->isFriend($p_userid)) ){
				$db_upc->insert("{$p_user_data->username}_{$post_id}_comments", array('userid'=>$user_data->id, 'comment'=>$comment));
				$comment_count = $post_info->tot_comments;
				$comment_count++;
				$db_up->update("{$p_user_data->username}_posts", array('tot_comments'=>$comment_count), array('id', '=', $post_id));
				$db_uf->insert("{$user_data->username}_feeds", array('userid'=>$p_userid, 'post_id'=>$post_id, 'post_type'=>'USER', 'privacy'=>$privacy, 'action'=>'COMMENTED'));
				$db_uf->query("SELECT id, date FROM {$user_data->username}_feeds WHERE userid={$p_userid} AND post_id={$post_id} AND post_type='USER' AND privacy='{$privacy}' AND action='COMMENTED' ORDER BY id DESC, date DESC LIMIT 0,1", array(), 'SELECT *');
				$last_feed = $db_uf->first();
				if(strtoupper($privacy)=='FOLLOWERS'){
					$db->myUpdate('users_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->date, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
				}else if(strtoupper($privacy)=='FRIENDS'){
					$db->myUpdate('users_last_updated', array('last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
				}else if(strtoupper($privacy)=='PUBLIC'){
					$db->myUpdate('users_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->date, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
				}
				if($uc->isFriend($p_userid)){
					$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_userid));
					$f_user = $db_uc->first();
					$priority_count = $f_user->priority+2;
					$db_uc->update($user_data->username.'_friends', array('priority'=>$priority_count), array('userid', '=', $p_userid));
				}elseif($uc->isFollowing($p_userid)){
					$db_uc->get($user_data->username.'_following', array('userid', '=', $p_userid));
					$f_user = $db_uc->first();
					$priority_count = $f_user->priority+2;
					$db_uc->update($user_data->username.'_friends', array('priority'=>$priority_count), array('userid', '=', $p_userid));
				}

				if($p_user_data->id != $user_data->id){
					$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'userid'=>$p_user_data->id, 'sec_userid'=>$user_data->id, 'action'=>'COMMENTED'));
				}
				
				$db_upc->query("SELECT DISTINCT userid FROM {$p_user_data->username}_{$post_id}_comments WHERE userid!={$user_data->id} AND userid!={$p_user_data->id}", array(), 'SELECT *');
				$tot_ntfs = $db_upc->count();

				if($tot_ntfs>0){

					$ntfs = $db_upc->results();

					for($i=0; $i<$tot_ntfs; $i++){

						$ntf = $ntfs[$i];
						$db->get('users', array('id', '=', $ntf->userid));
						$n_user_data = $db->first();
						$db_un->insert($n_user_data.'_notifications', array('post_id'=>$post_id, 'userid'=>$p_user_data->id, 'sec_userid'=>$user_data->id, 'action'=>'COMMENTED'));

					}

				}


				echo 'Commented.';
			}

		}

	}

}

?>