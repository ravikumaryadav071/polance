<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$p_userid = $_POST['userid'];
	$userid = $_SESSION['user'];
	$message = $_POST['msg_text'];

	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$uc = user_connections::getInstance();

	if(!$uc->isUserBlocked($p_userid)){

		$db->get('users', array('id', '=', $p_userid));
		$p_user_data = $db->first();
		$user_data = $user->data();

		$db_msgs->insert($user_data->username.'_inbox', array('userid'=>$p_userid, 'sorr'=>'SENT', 'message'=>$message, 'sorn'=>'SEEN'));
		$db_msgs->insert($p_user_data->username.'_inbox', array('userid'=>$userid, 'sorr'=>'RECEIVED', 'message'=>$message));

		if(!$db_msgs->error()){

			echo "<p>Your message has sent to {$p_user_data->name}.</p>";

		}else{

			echo "<p>There are some errors. Please try after some time.</p>";

		}

	}else{

		echo "You cannot send messages to this user. You are blocked.";

	}

}

?>