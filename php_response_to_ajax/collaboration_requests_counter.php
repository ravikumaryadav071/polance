<?php

require_once '../core/initi.php';

$user= new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$unique_name = strtolower($unique_name);
		
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		
		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$col_info = $db_col->first();
			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE userid={$user_data->id} AND member_type='ADMIN'", array(), 'SELECT *');
			if($db_cm->count()>0){

				$db_cm->query("SELECT * FROM {$unique_name}_requests", array(), 'SELECT *');

				echo $db_cm->count();

			}

		}

	}

}

?>