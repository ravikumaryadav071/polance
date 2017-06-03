<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$unique_name = strtolower(trim($_POST['col_name']));
		$post_id = $_POST['post_id'];
		$comment = trim($_POST['comment_text']);

		$user_data = $user->data();
		$db = DB::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cp = DBcollaborations_posts::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_cpc = DBcollaborations_posts_comments::getInstance();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();

			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));

			if($db_cm->count()>0){

				$db_cp->get($unique_name.'_posts', array('id', '=', $post_id));
				$post_data = $db_cp->first();
				$comment_count = $post_data->tot_comments;
				$comment_count++;
				$db_cpc->insert("{$unique_name}_{$post_id}_comments", array('comment'=>$comment, 'userid'=>$user_data->id));
				$db_cp->update($unique_name.'_posts', array('tot_comments'=>$comment_count), array('id', '=', $post_id));
				
				$db->get('users', array('id', '=', $post_data->posted_by));
				$p_user_data = $db->first();
				if($post_data->posted_by != $user_data->id){
					$db_un->insert($p_user_data->username.'_notifications', array('userid'=>$col_info->col_id, 'post_id'=>$post_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'COMMENTED'));
				}

				$db_cpc->query("SELECT userid FROM {$unique_name}_{$post_id}_comments WHERE userid!={$user_data->id} AND userid!={$p_user_data->id}", array(), 'SELECT *');
				$tot_ntfs = $db_cpc->count();
				if($tot_ntfs>0){
					$ntfs = $db_cpc->results();
					for($i=0; $i<$tot_ntfs; $i++){
						$ntf = $ntfs[$i];
						$db->get('users', '=', $ntf->userid);
						$n_user_data = $db->first();
						$db_un->insert($n_user_data->username.'_notifications', array('userid'=>$col_info->col_id, 'post_id'=>$post_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'COMMENTED'));
					}
				}

				echo 'Commented.';

			}

		}

	}

}

?>