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
		$no_followings_pp = 10;		// number of followings per page

		$db->get('users', array('username', '=', $p_username));
		$valid_user = $db->count();

		if($valid_user>0){

			$p_user_data = $db->first();

			if(!$uc->isUserBlocked($p_user_data->id)){

				$db_uc->query("SELECT * FROM {$p_username}_following WHERE id<{$last_id} ORDER BY date DESC, id DESC LIMIT 0,{$no_followings_pp}", array(), 'SELECT *');
				$tot_followings = $db_uc->count();
				
				if($tot_followings>0){

					$followings = $db_uc->results();
					$show_followings = ($tot_followings>=$no_followings_pp)?$no_followings_pp:$tot_followings;
					include '../include/load_more_following.php';
				}else{
					echo 'No more following(s).';
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