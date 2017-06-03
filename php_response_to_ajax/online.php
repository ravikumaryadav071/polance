<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$user_data = $user->data();
	$db = DB::getInstance();
	$db->query("UPDATE online_users SET date=CURRENT_TIME WHERE userid={$user_data->id}");
	if($db->error()){
		echo 'FAILED';
	}

}

?>