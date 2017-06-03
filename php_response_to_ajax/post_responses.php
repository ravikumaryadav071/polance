<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET)&&!empty($_GET)){

		$user_data = $user->data();
		$db_upr = DBusers_posts_responses::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$db_up = DBusers_posts::getInstance();
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$uc = user_connections::getInstance();

		$post_id = $_GET['post_id'];
		$p_user_id = $_GET['user'];
		$post_type = $_GET['post_type'];
		$action = strtoupper($_GET['action']);
		$db->get('users', array('id', '=', $p_user_id));
		$p_user_data = $db->first();
		$db_up->get("{$p_user_data->username}_posts", array('id', '=', $post_id));
		$post_info = $db_up->first();
		$last_feed = "";

		if($post_type == 'USER'){

			if($action == 'UPVOTE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_upvotes", array('userid', '=', $user_data->id));
				if($db_upr->count() ==0){
					
					$db_upr->insert("{$p_user_data->username}_{$post_id}_upvotes", array('userid'=>$user_data->id));
					$db_uf->insert($user_data->username.'_feeds', array('userid'=>$p_user_id, 'post_id'=>$post_id, 'post_type'=>$post_type, 'action'=>'UPVOTED', 'privacy'=>$post_info->privacy));
					$up_count = $post_info->tot_upvotes;
					$up_count++;
					$db_up->update("{$p_user_data->username}_posts", array('tot_upvotes'=>$up_count), array('id', '=', $post_id));
					$db_uf->query("SELECT id, date FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='UPVOTED' AND privacy='{$post_info->privacy}' ORDER BY id DESC, date DESC", array(), 'SELECT');
					$last_feed = $db_uf->first();
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority+1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority+1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					
					if($user_data->id != $p_user_data->id){
						$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'sec_userid'=>$user_data->id, 'action'=>'UPVOTED'));
					}
					echo 'Upvoted.';
				}else{
					echo 'Already upvoted.';
				}

			}else if($action == 'UNUPVOTE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_upvotes", array('userid', '=', $user_data->id));
				if($db_upr->count()>0){
					$db_upr->delete("{$p_user_data->username}_{$post_id}_upvotes", array('userid', '=', $user_data->id));
					$db_uf->query("DELETE FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='UPVOTED' AND privacy='{$post_info->privacy}'", array(), 'DELETE');
					$up_count = $post_info->tot_upvotes;
					$up_count--;
					$db_up->update("{$p_user_data->username}_posts", array('tot_upvotes'=>$up_count), array('id', '=', $post_id));
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					
					if($user_data->id != $p_user_data->id){
						$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND sec_userid={$user_data->id} AND action='UPVOTED'", array(), "DELETE");
					}
					echo 'Upvote now.';
				}else{
					echo 'Have not upvoted.';
				}

			}else if($action == 'DOWNVOTE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_downvotes", array('userid', '=', $user_data->id));
				if($db_upr->count() ==0){
					$db_upr->insert("{$p_user_data->username}_{$post_id}_downvotes", array('userid'=>$user_data->id));
					$db_uf->insert($user_data->username.'_feeds', array('userid'=>$p_user_id, 'post_id'=>$post_id, 'post_type'=>$post_type, 'action'=>'DOWNVOTED', 'privacy'=>$post_info->privacy));
					$down_count = $post_info->tot_downvotes;
					//echo $down_count;
					$down_count++;
					//echo $down_count."<br>";
					$db_up->update("{$p_user_data->username}_posts", array('tot_downvotes'=>$down_count), array('id', '=', $post_id));
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					echo 'Downvoted.';
				}else{
					echo 'Already downvoted.';
				}
				
			}else if($action == 'UNDOWNVOTE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_downvotes", array('userid', '=', $user_data->id));
				if($db_upr->count()>0){
					$db_upr->delete("{$p_user_data->username}_{$post_id}_downvotes", array('userid', '=', $user_data->id));
					$db_uf->query("DELETE FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='DOWNVOTED' AND privacy='{$post_info->privacy}'", array(), 'DELETE');
					$down_count = $post_info->tot_downvotes;
					//echo $down_count."<br>";
					$down_count--;
					//echo $down_count."<br>";
					$db_up->update("{$p_user_data->username}_posts", array('tot_downvotes'=>$down_count), array('id', '=', $post_id));
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority + 1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority + 1;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					echo 'Downvote now.';
				}else{
					echo 'Have not Downvoted.';
				}
				
			}else if($action == 'SHARE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_shares", array('userid', '=', $user_data->id));
				if($db_upr->count() ==0){
					$db_upr->insert("{$p_user_data->username}_{$post_id}_shares", array('userid'=>$user_data->id));
					$db_uf->insert($user_data->username.'_feeds', array('userid'=>$p_user_id, 'post_id'=>$post_id, 'post_type'=>$post_type, 'action'=>'SHARED', 'privacy'=>$post_info->privacy));
					$share_count = $post_info->tot_shares;
					$share_count++;
					$db_up->update("{$p_user_data->username}_posts", array('tot_shares'=>$share_count), array('id', '=', $post_id));
					$db_uf->query("SELECT id, date FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='SHARED' AND privacy='{$post_info->privacy}' ORDER BY id DESC, date DESC", array(), 'SELECT');
					$last_feed = $db_uf->first();
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority+2;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority+2;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					echo 'Shared.';
				}else{
					echo 'Already shared.';
				}
				
			}else if($action == 'UNSHARE'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_shares", array('userid', '=', $user_data->id));
				if($db_upr->count()>0){
					$db_upr->delete("{$p_user_data->username}_{$post_id}_shares", array('userid', '=', $user_data->id));
					$db_uf->query("DELETE FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='SHARED' AND privacy='{$post_info->privacy}'", array(), 'DELETE');
					$share_count = $post_info->tot_shares;
					$share_count--;
					$db_up->update("{$p_user_data->username}_posts", array('tot_shares'=>$share_count), array('id', '=', $post_id));
					if($uc->isFriend($p_user_id)){
						$db_uc->get($user_data->username.'_friends', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-2;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}elseif($uc->isFollowing($p_user_id)){
						$db_uc->get($user_data->username.'_following', array('userid', '=', $p_user_id));
						$f_user = $db_uc->first();
						$priority_count = $f_user->priority-2;
						$db_uc->update($user_data->username.'_friends', array('priority'=>$priority), array('userid', '=', $p_user_id));
					}
					echo 'Share now.';
				}else{
					echo 'Have not shared.';
				}
				
			}else if($action == 'VARIFY'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_varify", array('userid', '=', $user_data->id));
				if($db_upr->count() ==0){
					$db_upr->insert("{$p_user_data->username}_{$post_id}_varify", array('userid'=>$user_data->id));
					$db_uf->insert($user_data->username.'_feeds', array('userid'=>$p_user_id, 'post_id'=>$post_id, 'post_type'=>$post_type, 'action'=>'VARIFIED', 'privacy'=>$post_info->privacy));
					$varify_count = $post_info->tot_varify;
					$varify_count++;
					$db_up->update("{$p_user_data->username}_posts", array('tot_varify'=>$varify_count), array('id', '=', $post_id));
					$db_uf->query("SELECT id, date FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='VARIFIED' AND privacy='{$post_info->privacy}' ORDER BY id DESC, date DESC", array(), 'SELECT');
					$last_feed = $db_uf->first();
					
					if($user_data->id != $p_user_data->id){
						$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'sec_userid'=>$user_data->id, 'action'=>'VARIFIED'));
					}

					echo 'Verified.';
				}else{
					echo 'Already verified.';
				}
				
			}else if($action == 'UNVARIFY'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_varify", array('userid', '=', $user_data->id));
				if($db_upr->count()>0){
					$db_upr->delete("{$p_user_data->username}_{$post_id}_varify", array('userid', '=', $user_data->id));
					$db_uf->query("DELETE FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='VARIFIED' AND privacy='{$post_info->privacy}'", array(), 'DELETE');
					$varify_count = $post_info->tot_varify;
					$varify_count--;
					$db_up->update("{$p_user_data->username}_posts", array('tot_varify'=>$varify_count), array('id', '=', $post_id));
					
					if($user_data->id != $p_user_data->id){
						$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND sec_userid={$user_data->id} AND action='VARIFIED'", array(), "DELETE");
					}

					echo 'Verify now.';
				}else{
					echo 'Have not verified.';
				}
				
			}else if($action == 'REPORT'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_reports", array('userid', '=', $user_data->id));
				if($db_upr->count() ==0){
					$db_upr->insert("{$p_user_data->username}_{$post_id}_reports", array('userid'=>$user_data->id));
					$db_uf->insert($user_data->username.'_feeds', array('userid'=>$p_user_id, 'post_id'=>$post_id, 'post_type'=>$post_type, 'action'=>'REPORTED', 'privacy'=>$post_info->privacy));
					$report_count = $post_info->tot_reports;
					$report_count++;
					$db_up->update("{$p_user_data->username}_reports", array('tot_reports'=>$report_count), array('id', '=', $post_id));
					
					if($user_data->id != $p_user_data->id){
						$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'sec_userid'=>$user_data->id, 'action'=>'REPORTED'));
					}

					echo 'Reported.';
				}else{
					echo 'Already reported.';
				}

			}else if($action == 'UNREPORT'){

				$db_upr->get("{$p_user_data->username}_{$post_id}_reports", array('userid', '=', $user_data->id));
				if($db_upr->count()>0){
					$db_upr->delete("{$p_user_data->username}_{$post_id}_reports", array('userid', '=', $user_data->id));
					$db_uf->query("DELETE FROM {$user_data->username}_feeds WHERE userid={$p_user_id} AND post_id={$post_id} AND post_type='{$post_type}' AND action='REPORTED' AND privacy='{$post_info->privacy}'", array(), 'DELETE');
					$report_count = $post_info->tot_reports;
					$report_count--;
					$db_up->update("{$p_user_data->username}_posts", array('tot_reports'=>$report_count), array('id', '=', $post_id));
					
					if($user_data->id != $p_user_data->id){
						$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND sec_userid={$user_data->id} AND action='REPORTED'", array(), "DELETE");
					}

					echo 'Report now.';
				}else{
					echo 'Have not reported.';
				}
				
			}

		}else if($post_type == 'COLLABORATION'){

			//code goes here

		}

		if($last_feed != ""){
			$privacy = strtoupper($post_info->privacy);
			if(strtoupper($privacy)=='FOLLOWERS'){
				$db->myUpdate('users_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->date, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
			}else if(strtoupper($privacy)=='FRIENDS'){
				$db->myUpdate('users_last_updated', array('last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
			}else if(strtoupper($privacy)=='PUBLIC'){
				$db->myUpdate('users_last_updated', array('last_follower_id'=>$last_feed->id, 'last_follower_time'=>$last_feed->date, 'last_friend_id'=>$last_feed->id, 'last_friend_time'=>$last_feed->date), array('userid', '=', $user_data->id));
			}

		}

	}

}

?>