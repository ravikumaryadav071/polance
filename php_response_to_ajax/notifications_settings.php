<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_POST) && !empty($_POST)){

		$user_data = $user->data();
		$db_un = DBusers_notifications::getInstance();

		$upvote = strtoupper($_POST['upvote']);
		$comment = strtoupper($_POST['comment']);
		$varify = strtoupper($_POST['varify']);
		$collect = strtoupper($_POST['collect']);

		$db_un->update('notifications_settings', array('upvote'=>$upvote, 'comment'=>$comment, 'varify'=>$varify, 'collect'=>$collect), array('userid', '=', $user_data->id));

		if(!$db_un->error()){
			echo 'Changes saved.';
		}else{
			echo 'Something went wrong. Try again!';
		}

	}

}

?>