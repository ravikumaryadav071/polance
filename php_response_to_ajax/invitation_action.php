<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$action = strtoupper(trim($_GET['action']));
		$unique_name = trim($_GET['col']);
		$db_col = DBcollaborations::getInstance();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cm = DBcollaborations_members::getInstance();
			$user_data = $user->data();

			$db_cm->get("{$unique_name}_members", array('userid', '=', $user_data->id));
			if($db_cm->count()==0){
				$db_cm->get("{$unique_name}_invitations", array('userid', '=', $user_data->id));
				if($db_cm->count()>0){

					$db_un = DBusers_notifications::getInstance();
					$db_ui = DBusers_interests::getInstance();

					if($action=='ACCEPT'){

						$db_col->get('collaborations', array('id', '=', $col_info->col_id));
						$col_data = $db_col->first();
						$members_count = $col_data->members_count + 1;
						$db_cm->delete("{$unique_name}_invitations", array('userid', '=', $user_data->id));
						$db_cm->insert("{$unique_name}_members", array('userid'=>$user_data->id, 'name_init'=>strtolower(substr($user_data->name, 0, 1))));
						$db_ui->insert("{$user_data->username}_collaborations", array('col_id'=>$col_info->col_id));
						$db_un->query("DELETE FROM {$user_data->username}_notifications WHERE userid={$col_info->col_id} AND ntf_type='COLLABORATION' AND action='INVITED'", array(), 'DELETE');
						$db_col->update('collaborations', array('members_count'=>$members_count), array('id', '=', $col_info->col_id));
						echo 'Accepted';

					}else if($action=='REJECT'){

						$db_cm->delete("{$unique_name}_invitations", array('userid', '=', $user_data->id));
						$db_un->query("DELETE FROM {$user_data->username}_notifications WHERE userid={$col_info->col_id} AND ntf_type='COLLABORATION' AND action='INVITED'", array(), 'DELETE');
						echo 'Rejected';

					}

				}
			}

		}

	}

}

?>