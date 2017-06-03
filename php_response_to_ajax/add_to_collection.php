<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		if(isset($_POST['post_id']) && isset($_POST['post_type']) && isset($_POST['user'])){

			$user_data = $user->data();
			$db = DB::getInstance();
			$db_up = DBusers_posts::getInstance();
			$db_upr = DBusers_posts_responses::getInstance();
			$db_ucl = DBusers_collections::getInstance();
			$db_un = DBusers_notifications::getInstance();
			$db_col = DBcollaborations::getInstance();
			$db_cp = DBcollaborations_posts::getInstance();
			$db_cpr = DBcollaborations_posts_responses::getInstance();
			$clc_id = $_POST['clc'];
			$tot_added = 0;
			
			$db_ucl->get($user_data->username.'_collections_lists', array('id', '=', $clc_id));
			if($db_ucl->count()>0){

				$tot_posts = count($_POST['post_id']);
				
				if($tot_posts==count($_POST['user']) && $tot_posts==count($_POST['post_type'])){

					for($i=0; $i<$tot_posts; $i++){

						$post_id = $_POST['post_id'][$i];
						$p_userid = $_POST['user'][$i];
						$post_type = $_POST['post_type'][$i];

						if($post_type == 'COLLABORATION'){

							$db_col->get('collaborations_unique', array('unique_name', '=', $p_userid));
							$col_info = $db_col->first();
							$p_userid = $col_info->col_id;
						
						}

						$db_ucl->query("SELECT * FROM {$user_data->username}_collections WHERE clc_id={$clc_id} AND post_id={$post_id} AND userid={$p_userid} AND post_type='{$post_type}'", array(), 'SELECT *');
						if($db_ucl->count() == 0){

							$db_ucl->insert("{$user_data->username}_collections", array('clc_id'=>$clc_id, 'post_id'=>$post_id, 'userid'=>$p_userid, 'post_type'=>$post_type));
							$tot_added++;
						}

						if($post_type == 'USER'){

							$db->get('users', array('id', '=', $p_userid));
							$p_user_data = $db->first();

							$db_upr->get("{$p_user_data->username}_{$post_id}_collects", array('userid', '=', $user_data->id));
							if($db_upr->count() == 0){

								$db_upr->insert("{$p_user_data->username}_{$post_id}_collects", array('userid'=>$user_data->id));
								$db_up->get("{$p_user_data->username}_posts", array('id', '=', $post_id));
								$post_info = $db_up->first();
								$clc_count = $post_info->tot_collects + 1;
								$db_up->update("{$p_user_data->username}_posts", array('tot_collects'=>$clc_count), array('id', '=', $post_id));
								if($p_userid != $user_data->id){
									$db_un->insert("{$p_user_data->username}_notifications", array('post_id'=>$post_id, 'userid'=>$p_user_data->id, 'ntf_type'=>'USER', 'sec_userid'=>$user_data->id, 'action'=>'COLLECTED'));
								}
							}

						}else if($post_type == 'COLLABORATION'){

							$db_cpr->get("{$col_info->unique_name}_{$post_id}_collects", array('userid', '=', $user_data->id));
							if($db_cpr->count() == 0){

								$db_cpr->insert("{$col_info->unique_name}_{$post_id}_collects", array('userid'=>$user_data->id));
								$db_cp->get("{$col_info->unique_name}_posts", array('id', '=', $post_id));
								$post_info = $db_cp->first();
								$db->get('users', array('id', '=', $post_info->posted_by));
								$p_user_data = $db->first();
								$clc_count = $post_info->tot_collects + 1;
								$db_cp->update("{$col_info->unique_name}_posts", array('tot_collects'=>$clc_count), array('id', '=', $post_id));
								if($post_info->posted_by != $user_data->id){
									$db_un->insert("{$p_user_data->username}_notifications", array('post_id'=>$post_id, 'userid'=>$p_userid, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'COLLECTED'));
								}
							
							}

						}

					}

					if($tot_added>0){

						$db_ucl->get("{$user_data->username}_collections_lists", array('id', '=', $clc_id));
						$clc_info = $db_ucl->first();
						$post_count = $clc_info->tot_posts + $tot_added;
						$db_ucl->update("{$user_data->username}_collections_lists", array('tot_posts'=>$post_count), array('id', '=', $clc_id));

					}
					echo $tot_added;

				}

			}

		}

	}		

}

?>