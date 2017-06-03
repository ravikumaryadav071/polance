<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$last_id = $_GET['id'];
		$p_username = $_GET['user'];
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$uc = user_connections::getInstance();
		$user_data = $user->data();
		$no_friends_pp = 10;		// number of friends per page

		$db->get('users', array('username', '=', $p_username));
		$valid_user = $db->count();

		if($valid_user>0){

			$p_user_data = $db->first();

			if(!$uc->isUserBlocked($p_user_data->id)){

				$db_uc->query("SELECT * FROM {$p_username}_friends WHERE id<{$last_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_friends_pp}", array(), 'SELECT *');
				$tot_friends = $db_uc->count();
				
				if($tot_friends>0){

					$friends = $db_uc->results();
					$show_friends = ($tot_friends>=$no_friends_pp)?$no_friends_pp:$tot_friends;
					
					include '../include/load_more_friends.php';
				}else{

					echo 'No more friends.';

				}
			}

		}else{

			?>
			<p>This user does not exists.</p>
			<?php

		}

	}

}

?>