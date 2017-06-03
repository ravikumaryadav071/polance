<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$last_id = $_GET['id'];
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$db_msgs = DBusers_messages::getInstance();
		$db_gm = DBgroups_messages::getInstance();
		$uc = user_connections::getInstance();
		$no_cg_pp = 15;		//number of chat groups per page
		
		$db_msgs->query("SELECT * FROM {$user_data->username}_chat_groups WHERE id<{$last_id} ORDER BY last_updated DESC, id DESC LIMIT 0,{$no_cg_pp}", array(), 'SELECT *');
		$tot_groups = $db_msgs->count();

		if($tot_groups>0){

			$groups = $db_msgs->results();
			$show_groups = ($tot_groups>=$no_cg_pp)?$no_cg_pp:$tot_groups;
			
			include '../include/my_groups.php';

		}else{

			?>
			<p>No more group(s).</p>
			<?php

		}

	}

}

?>