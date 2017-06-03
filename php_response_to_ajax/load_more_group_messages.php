<?php
require_once '../core/initi.php';
$user = new user();

if($user->isLoggedIn()){

	$user_data = $user->data();
	$db = DB::getInstance();
	$db_uc = DBusers_connection::getInstance();
	$db_msgs = DBusers_messages::getInstance();
	$db_gm = DBgroups_messages::getInstance();
	$uc = user_connections::getInstance();
	$no_messages_pp = 20;		//number of messages per page

	if(isset($_GET) && !empty($_GET)){

		$table_name = $_GET['group'];
		$last_id = $_GET['last_id'];
		$db_gm->query("SELECT * FROM groups WHERE table_name='{$table_name}'", array(), 'SELECT *');
		//echo "SELECT * FROM groups WHERE table_name='{$_GET['group']}'";
		if($db_gm->count()>0){
			
			$db_gm->get('members_'.$table_name, array('member_id', '=', $user_data->id));
			
			if($db_gm->count()>0){

				$db_gm->query("SELECT * FROM {$table_name} WHERE id<{$last_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_messages_pp}", array(), 'SELECT *');
				$tot_msgs = $db_gm->count();
				
				if($tot_msgs>0){

					$messages = $db_gm->results();
					$show_msgs = ($tot_msgs>=$no_messages_pp)?$no_messages_pp:$tot_msgs;
					
					include '../include/group_chat.php';

				}else{

					?>
					<p>No more messages.</p>
					<?php

				}


			}

		}

	}

}
?>