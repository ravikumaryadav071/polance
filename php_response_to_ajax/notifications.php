<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$db_un = DBusers_notifications::getInstance();
	$user_data = $user->data();

	$db_un->get('notifications_settings', array('userid', '=', $user_data->id));
	$ntf_stngs = $db_un->first();
	$query = "";
	if($ntf_stngs->upvote == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='UPVOTED' GROUP BY userid, ntf_type, sec_userid, action ORDER BY id DESC)";
	}

	if($ntf_stngs->comment == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='COMMENTED' GROUP BY userid, ntf_type, sec_userid, action ORDER BY id DESC)";
	}

	if($ntf_stngs->varify == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='VARIFIED' GROUP BY userid, ntf_type, sec_userid, action ORDER BY id DESC)";
	}

	if($ntf_stngs->collect == 'ON'){
		$query .= " UNION (SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND action='COLLECTED' GROUP BY userid, ntf_type, sec_userid, action ORDER BY id DESC)";
	}

	$db_uc->query("SELECT * FROM {$user_data->username}_requests", array(), 'SELECT *');
	$requests = $db_uc->count();

	$db_msgs->query("SELECT * FROM {$user_data->username}_messages WHERE sorn='NOT SEEN'", array(), 'SELECT *');
	$msgs = $db_msgs->count();

	$db_msgs->query("SELECT * FROM {$user_data->username}_chat_groups WHERE sorn='NOT SEEN'", array(), 'SELECT *');
	$g_msgs = $db_msgs->count();

	$db_un->query("(SELECT * FROM {$user_data->username}_notifications WHERE sorn='NOT SEEN' AND (action='GRANTED' OR action='INVITED' OR action='FOLLOWING' OR action='CONTRIBUTED' OR action='EDITED' OR action='REPORTED')  ORDER BY id DESC) {$query}", array(), 'SELECT *');
	$ntfs = $db_un->count();

	echo "{$requests},{$msgs},{$g_msgs},{$ntfs}";

}

?>