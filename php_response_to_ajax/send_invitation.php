<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$user_data = $user->data();
		$i_user = $_GET['user'];
		$unique_name = trim($_GET['col']);
		$db_col = DBcollaborations::getInstance();
		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cm = DBcollaborations_members::getInstance();
			$db_cm->get("{$unique_name}_members", array('userid', '=', $user_data->id));
			if($db_cm->count()>0){

				$db = DB::getInstance();
				$db_un = DBusers_notifications::getInstance();
				$uc = user_connections::getInstance();
				
				if($uc->isFriend($i_user) || $uc->isFollower($i_user)){
					
					$db_cm->query("SELECT * FROM {$unique_name}_invitations WHERE userid={$i_user}", array(), 'SELECT *');

					if($db_cm->count()==0){
					
						$db->get('users', array('id', '=', $i_user));
						$i_user_data = $db->first();

						$db_un->insert("{$i_user_data->username}_notifications", array('userid'=>$col_info->col_id, 'ntf_type'=>'COLLABORATION', 'sec_userid'=>$user_data->id, 'action'=>'INVITED'));
						if($db_cm->count()==0){
							$db_cm->insert("{$unique_name}_invitations", array('userid'=>$i_user));
						}

					}

				}

			}

		}

	}

}

?>