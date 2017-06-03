<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = strtolower(trim($_GET['col']));
		$post_id = $_GET['post_id'];
		$action = strtoupper($_GET['action']);
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_cpr = DBcollaborations_posts_responses::getInstance();
		$db_cpc = DBcollaborations_posts_comments::getInstance();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cp->get($unique_name.'_posts', array('id', '=', $post_id));
			$post_info = $db_cp->first();

			if($db_cp->count()>0){

				$db_col->get('collaborations', array('id', '=', $col_info->col_id));
				$col_data = $db_col->first();

				if($user_data->id != $post_info->posted_by){
					$db->get('users', array('id', '=', $post_info->posted_by));
					$p_user_data = $db->first();
				}

				if($action == 'UPVOTE'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_upvotes", array('userid', '=', $user_data->id));

					if($db_cpr->count()==0){
						
						$up_count = $post_info->tot_upvotes;
						$up_count++;
						$db_cpr->insert("{$unique_name}_{$post_id}_upvotes", array('userid'=>$user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_upvotes'=>$up_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'userid'=>$col_info->col_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'UPVOTED'));
						}

					}

				}else if($action == 'UNUPVOTE'){

					$db_cpr->get("{$unique_name}_{$post_id}_upvotes", array('userid', '=', $user_data->id));

					if($db_cpr->count()>0){
						
						$up_count = $post_info->tot_upvotes;
						$up_count--;
						$db_cpr->delete("{$unique_name}_{$post_id}_upvotes", array('userid', '=', $user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_upvotes'=>$up_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND userid={$col_info->col_id} AND ntf_type='COLLABORATION' AND sec_userid={$user_data->id} AND action='UPVOTED'", array(), 'DELETE');
						}

					}

				}else if($action == 'DOWNVOTE'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_downvotes", array('userid', '=', $user_data->id));

					if($db_cpr->count()==0){
						
						$down_count = $post_info->tot_downvotes;
						$down_count++;
						$db_cpr->insert("{$unique_name}_{$post_id}_downvotes", array('userid'=>$user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_downvotes'=>$down_count), array('id', '=', $post_id));

					}

				}else if($action == 'UNDOWNVOTE'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_downvotes", array('userid', '=', $user_data->id));

					if($db_cpr->count()>0){
						
						$down_count = $post_info->tot_downvotes;
						$down_count--;
						$db_cpr->delete("{$unique_name}_{$post_id}_downvotes", array('userid', '=', $user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_downvotes'=>$down_count), array('id', '=', $post_id));

					}

				}else if($action == 'VARIFY'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_varify", array('userid', '=', $user_data->id));

					if($db_cpr->count()==0){
						
						$varify_count = $post_info->tot_varify;
						$varify_count++;
						$db_cpr->insert("{$unique_name}_{$post_id}_varify", array('userid'=>$user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_varify'=>$varify_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'userid'=>$col_info->col_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'VARIFIED'));
						}

					}

				}else if($action == 'UNVARIFY'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_varify", array('userid', '=', $user_data->id));

					if($db_cpr->count()>0){
						
						$varify_count = $post_info->tot_varify;
						$varify_count--;
						$db_cpr->delete("{$unique_name}_{$post_id}_varify", array('userid', '=', $user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_varify'=>$varify_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND userid={$col_info->col_id} AND ntf_type='COLLABORATION' AND sec_userid={$user_data->id} AND action='VARIFIED'", array(), 'DELETE');
						}

					}

				}else if($action == 'REPORT'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_reports", array('userid', '=', $user_data->id));

					if($db_cpr->count()==0){
						
						$report_count = $post_info->tot_reports;
						$report_count++;
						$db_cpr->insert("{$unique_name}_{$post_id}_reports", array('userid'=>$user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_reports'=>$report_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->insert($p_user_data->username.'_notifications', array('post_id'=>$post_id, 'userid'=>$col_info->col_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'REPORTED'));
						}

					}

				}else if($action == 'UNREPORT'){
					
					$db_cpr->get("{$unique_name}_{$post_id}_reports", array('userid', '=', $user_data->id));

					if($db_cpr->count()>0){
						
						$report_count = $post_info->tot_reports;
						$report_count--;
						$db_cpr->delete("{$unique_name}_{$post_id}_reports", array('userid', '=', $user_data->id));
						$db_cp->update($unique_name.'_posts', array('tot_varify'=>$varify_count), array('id', '=', $post_id));

						if($user_data->id != $post_info->posted_by){
							$db_un->query("DELETE FROM {$p_user_data->username}_notifications WHERE post_id={$post_id} AND userid={$col_info->col_id} AND ntf_type='COLLABORATION' AND sec_userid={$user_data->id} AND action='REPORTED'", array(), 'DELETE');
						}
					
					}

				}

			}

		}

	}

}

?>