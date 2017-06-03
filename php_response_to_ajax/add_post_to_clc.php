<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$user_data = $user->data();
		$db_ucl = DBusers_collections::getInstance();
		$db_col = DBcollaborations::getInstance();
		$p_user = $_GET['user'];
		$post_id = $_GET['post_id'];
		$post_type = $_GET['post_type'];
		$clc_id = $_GET['clc'];

		if($post_type == 'USER'){
			$p_userid = $p_user;
		}else if ($post_type == 'COLLABORATION') {
			$db_col->get('collaborations_unique', array('unique_name', '=', $p_user));
			$col_info = $db_col->first();
			$p_userid = $col_info->col_id;
		}

		if(is_numeric($p_userid)){

			$db_ucl->get($user_data->username.'_collections_lists', array('id', '=', $clc_id));
			if($db_ucl->count()>0){
				$clc_info = $db_ucl->first();
				$db_ucl->query("SELECT id FROM {$user_data->username}_collections WHERE clc_id={$clc_id} AND userid={$p_userid} AND post_id={$post_id} AND post_type='{$post_type}' LIMIT 0,1", array(), 'SELECT *');
				if($db_ucl->count()==0){
					$db_ucl->insert($user_data->username.'_collections', array('clc_id'=>$clc_id, 'post_id'=>$post_id, 'userid'=>$p_userid, 'post_type'=>$post_type));
					$clc_counter = $clc_info->tot_posts;
					$clc_counter++;
					$db_ucl->update($user_data->username.'_collections_lists', array('tot_posts'=>$clc_counter), array('id', '=', $clc_id));
					echo 'ADDED';
				}else{
					echo 'Already added.';
				}
			}else{
				echo 'Wrong Collection.';
			}

		}

	}

}

?>