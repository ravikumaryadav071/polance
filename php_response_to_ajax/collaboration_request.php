<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$unique_name = trim($_GET['col']);
		$unique_name = strtolower($unique_name);
		$action = trim($_GET['type']);
		$action = strtoupper($action);
		$user_data = $user->data();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));
			if($db_cm->count()==0){
				
				$db_cm->get($unique_name.'_requests', array('userid', '=', $user_data->id));
				$count = $db_cm->count();
				if($action == 'JOIN' && $count==0){
					$db_cm->insert($unique_name.'_requests', array('userid'=>$user_data->id));
					echo 'Request sent';
				}else if($action == 'DELETE'  && $count!=0){
					$db_cm->delete($unique_name.'_requests', array('userid', '=', $user_data->id));
					echo 'Request deleted';
				}else if($action == 'JOIN' && $count != 0){
					echo 'You have already sent a request.';
				}else if($action == 'DELETE'  && $count==0){
					echo 'Request has deleted already.';
				}

			}else{

				echo 'You are already a member of this collaboration.';

			}

		}

	}

}

?>