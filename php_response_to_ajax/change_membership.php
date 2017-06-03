<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$m_user = $_GET['user'];
		$db_col = DBcollaborations::getInstance();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$col_info = $db_col->first();
			$user_data = $user->data();
			$db_cm = DBcollaborations_members::getInstance();
			$db_cm->get("{$unique_name}_members", array('userid', '=', $user_data->id));
			if($db_cm->count()>0){

				$um_info = $db_cm->first();		//user's membership info
				if($um_info->member_type == 'ADMIN'){

					$db_cm->get("{$unique_name}_members", array('userid', '=', $m_user));
					if($db_cm->count()>0){

						$rm_info = $db_cm->first();
						if($rm_info->member_type == "MEMBER"){

							$db_cm->update("{$unique_name}_members", array('member_type'=>'FOUNDER'), array('userid', '=', $m_user));
							echo 'ADDED';

						}

					}

				}

			}

		}

	}

}

?>