<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$f_user = $_GET['user'];
		$user_data = $user->data();
		$db_uf = DBusers_feeds::getInstance();

		$db_uf->get("{$user_data->username}_blocked_feeders", array('userid', '=', $f_user));
		if($db_uf->count()>0){
			$db_uf->delete("{$user_data->username}_blocked_feeders", array('userid', '=', $f_user));
		}

	}

}

?>