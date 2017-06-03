<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$db_col = DBcollaborations::getInstance();
		$col_name = trim($_GET['name']);

		$unique_name = str_replace(' ', '', $col_name);
		$unique_name = strtolower($unique_name);

		if(ctype_alpha($unique_name)){

			$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

			if($db_col->count()>0){
				echo 'This collaboration is already created.';
			}else{
				echo 'This collaboration name is available.';
			}

		}else{
			echo 'Use only alphabets and spaces.';
		}

	}

}

?>