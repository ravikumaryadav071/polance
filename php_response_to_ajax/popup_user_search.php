<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$st = trim($_GET['text']);

		if($st != ''){
			
			$name_init = strtolower(substr($st, 0, 1));
			$db = DB::getInstance();
			$no_sugsns = 20;		//number of suggestions

			$db->query("SELECT userid FROM name_{$name_init} WHERE name LIKE '%{$st}%' LIMIT 0,{$no_sugsns}");
			$tot_users = $db->count();

			if($tot_users>0){

				$results = $db->results();

				for($i=0; $i<$tot_users; $i++){

					$result = $results[$i];
					$db->get('users', array('id', '=', $result->userid));
					$s_user_data = $db->first();
					?>
					<div>
						<a href="profile.php?user=<?php echo $s_user_data->username; ?>" target="_blank">
							<img src="<?php echo $s_user_data->profile_pic_dg; ?>" height="30px" width="35px">
							<?php echo $s_user_data->name; ?>
						</a>
					</div>
					<?php

				}

			}

		}

	}

}

?>