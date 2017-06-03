<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$db_ui = DBusers_interests::getInstance();
		$db_un = DBusers_notifications::getInstance();
		$db_uf = DBusers_feeds::getInstance();
		$unique_name = trim($_GET['col']);
		$unique_name = strtolower($unique_name);
		$action = trim($_GET['type']);
		$r_user = $_GET['user'];
		$action = strtoupper($action);
		$user_data = $user->data();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0 && is_numeric($r_user)){
			
			$col_info = $db_col->first();

			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE userid={$user_data->id} AND member_type='ADMIN' LIMIT 0,1", array(), 'SELECT');

			if($db_cm->count()>0){

				$db_cm->query("SELECT * FROM {unique_name}_requests WHERE userid={$r_user} LIMIT 0,1", array(), 'SELECT *');

				if($db_cm->count()>0){
				
					if($action=='ACCEPT'){

						$db->get('users', array('id', '=', $r_user));
						$r_user_data = $db->first();
						$name_init = strtolower(substr($r_user_data->name, 0, 1));

						$db_cm->insert($unique_name.'_members', array('userid'=>$r_user, 'name_init'=>$name_init));
						$db_cm->delete($unique_name.'_requests', array('userid', '=', $r_user));
						$db_ui->insert($r_user_data->username.'_collaborations', array('col_id'=>$col_info->col_id, 'col_type'=>'PRIVATE'));
						$db_col->get('collaborations', array('id', '=', $col_info->col_id));
						$col_data = $db_col->first();
						$members_count = $col_data->members_count+1;
						$db_col->update('collaborations', array('members_count'=>$members_count), array('id', '=', $col_info->col_id));
						$db_col->get('collaborations_last_updated', array('col_id', '=', $col_info->col_id));
						$c_last_updated = $db_col->first();
						$db_uf->insert("{$r_user_data->username}_generate_feeds", array('generator_id'=>$col_info->col_id, 'generator_type'=>'COLLABORATION', 'new_feed_id'=>$c_last_updated->last_id, 'last_updated'=>$c_last_updated->last_time));
						$db_un->insert($r_user_data->username.'_notifications', array('sec_userid'=>$col_info->col_id, 'ntf_type'=>'COLLABORATION', 'action'=>'GRANTED'));
						echo 'Request accepted.';

					}else if($action == 'REJECT'){

						$db_cm->delete($unique_name.'_requests', array('userid', '=', $r_user));
						echo 'Request deleted.';

					}

				}else{

					echo 'Request already accepted/deleted.';

				}

			}

		}

	}

}

?>