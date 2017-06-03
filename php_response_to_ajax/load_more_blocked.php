<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$last_id = $_GET['id'];
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$uc = user_connections::getInstance();
		$no_bloked_pp = 10;		//number of blocked users per page
		$user_data = $user->data();

		$db_uc->query("SELECT * FROM {$user_data->username}_blocked WHERE id<{$last_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_bloked_pp}", array(), 'SELECT *');
		$tot_blocked = $db_uc->count();

		if($tot_blocked>0){

			$blocked_users = $db_uc->results();
			$show_users = ($tot_blocked>=$no_bloked_pp)?$no_bloked_pp:$tot_blocked;

			for($i=0; $i<$show_users; $i++){

				$blocked_user = $blocked_users[$i];
				$db->get('users', array('id', '=', $blocked_user->userid));
				$f_user_data = $db->first();
				include '../include/connecting_to_user.php';
			}
			if($tot_blocked>=$no_bloked_pp){
				?>
				<input type="button" id="load_more_blocked" value="Load More" onclick="load_more_blocked(<?php echo $blocked_users[($show_users-1)]->id; ?>)">
				<?php
			}
			
		}else{

			?>
			<p>No more blocked users.</p>
			<?php

		}

	}

}

?>