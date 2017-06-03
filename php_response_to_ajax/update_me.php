<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){
	
	if(isset($_SESSION['update_me'])){
		$session_time = $_SESSION['update_me'];
		$current_time = time();
		$time_diff = $current_time - $session_time;
		echo 'here1';
		if($time_diff>60){
			$_SESSION['update_me'] = time();
			if(isset($_SESSION['updated_feeds'])){
				unset($_SESSION['updated_feeds']);
			}
		}
	}
}
?>