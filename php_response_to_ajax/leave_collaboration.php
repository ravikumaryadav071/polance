<?php

require_once '../core/initi.php';

$user = new user();

if($user->isloggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_ui = DBusers_interests::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$unique_name = $_GET['col'];
		$user_data = $user->data();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();

			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE userid={$user_data->id} AND member_type='MEMBER'", array(), 'SELECT *');
			if($db_cm->count()>0){

				$db_cm->delete($unique_name.'_members', array('userid', '=', $user_data->id));
				$db_ui->delete($user_data->username.'_collaborations', array('col_id', '=', $col_info->col_id));
				$db_uf->query("DELETE {$user_data->username}_generate_feeds WHERE generator_id={$col_info->col_id} AND generator_type='{$col_info->generator_type}'", array(), 'DELETE');
				$db_col->get('collaborations', array('id', '=', $col_info->col_id));
				$col_data = $db_col->first();
				$member_count = $col_data->members_count-1;
				$db_col->update('collaborations', array('members_count'=>$member_count), array('id', '=', $col_info->col_id));
				echo 'SUCCESS';
			}

		}

	}

}

?>