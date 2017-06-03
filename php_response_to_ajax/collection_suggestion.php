<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$clc_name = trim($_GET['name']);
		$user_data = $user->data();
		$db_ucl = DBusers_collections::getInstance();

		$db_ucl->query("SELECT * FROM {$user_data->username}_collections_lists WHERE collection_name={$clc_name}", array(), 'SELECT *');
		if($db_ucl->count()==0){
			echo 'You can create this collection.';
		}else{
			echo 'You have already created this collection.';
		}

	}

}

?>