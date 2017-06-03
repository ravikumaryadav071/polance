<?php
require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET)){
		
		$chat_userid = $_GET['user'];
		$db = DB::getInstance();
		$user_data = $user->data();
		$db->query('SELECT CURRENT_TIMESTAMP');
		$time = $db->first();
		$time = $time->CURRENT_TIMESTAMP;
		$time = strtotime($time);
		$time = $time-30;
		$date = date('Y-m-d H:i:s', $time);
		
		$db->query("SELECT * FROM online_users WHERE userid={$chat_userid} AND date>'{$date}'", array(), 'SELECT *');

		if($db->count()>0){
			echo "Online";
		}else{
			echo "Offline";
		}

	}

}
?>