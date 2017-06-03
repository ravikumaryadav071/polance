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
		$no_followers_pp = 10;		// number of followers per page

		$db->get('users', array('username', '=', $p_username));
		$valid_user = $db->count();

		if($valid_user>0){

			$p_user_data = $db->first();

			if(!$uc->isUserBlocked($p_user_data->id)){

				$db_uc->query("SELECT * FROM {$p_username}_followers WHERE id<{$last_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_followers_pp}", array(), 'SELECT *');
				$tot_followers = $db_uc->count();
				
				if($tot_followers>0){

					$followers = $db_uc->results();
					$show_followers = ($tot_followers>=$no_followers_pp)?$no_followers_pp:$tot_followers;
					
					include '../include/load_more_followers.php';
				}else{

					echo 'No more followers.';

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