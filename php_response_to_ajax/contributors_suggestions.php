<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_uc = DBusers_connection::getInstance();
		$uc = user_connections::getInstance();
		$search_user = trim($_GET['search_user']);
		$init_char = substr($search_user, 0, 1);
		$init_char = strtolower($init_char);
		$no_sugsns = 15;		//number of suggestions

		$db_uc->query("SELECT userid FROM {$user_data->username}_friends WHERE name_init='{$init_char}'", array(), 'SELECT *');
		$tot_sugsns1 = $db_uc->count();
		
		if($tot_sugsns1>0){

			$sugsns = $db_uc->results();
			$condition = "";

			for($i=0; $i<$tot_sugsns1; $i++){

				$sugsn = $sugsns[$i];
				$s_userid = $sugsn->userid;

				if($i==0){
					$condition .= "userid={$s_userid}";
				}else{
					$condition .= "OR userid={$s_userid}";
				}

			}

			$db->query("SELECT * FROM name_{$init_char} WHERE name LIKE '%{$search_user}%' AND {$condition} LIMIT 0,{$no_sugsns}");

			$tot_users_sugsns = $db->count();

			if($tot_users_sugsns > 0){

				$users_sugsns = $db->results();

				for($i=0; $i<$tot_users_sugsns; $i++){

					$user_sugsns = $users_sugsns[$i];
					$db->get('users', array('id', '=', $user_sugsns->userid));
					$s_user_info = $db->first();		//suggested user info
					?>
					<div id="user_info">
						<p>
							<img src="<?php echo $s_user_info->profile_pic_dg; ?>" alt="<?php echo $s_user_info->name; ?>">
							<?php echo $s_user_info->name; ?>
						</p>
						<input type="hidden" id="userid" name="contris[]" value="<?php echo $s_user_info->id; ?>">
						<input type="button" id="add_contri" value="ADD">
					</div>
					<?php

				}

			}

		}

		$db_uc->query("SELECT userid FROM {$user_data->username}_followers WHERE name_init='{$init_char}'", array(), 'SELECT *');
		$tot_sugsns2 = $db_uc->count();
		
		if($tot_sugsns2>0){

			$sugsns = $db_uc->results();
			$condition = "";

			for($i=0; $i<$tot_sugsns2; $i++){

				$sugsn = $sugsns[$i];
				$s_userid = $sugsn->userid;

				if($i==0){
					$condition .= "userid={$s_userid}";
				}else{
					$condition .= "OR userid={$s_userid}";
				}

			}

			$db->query("SELECT * FROM name_{$init_char} WHERE name LIKE '%{$search_user}%' AND {$condition} LIMIT 0,{$no_sugsns}");
			$tot_users_sugsns = $db->count();

			if($tot_users_sugsns > 0){

				$users_sugsns = $db->results();

				for($i=0; $i<$tot_users_sugsns; $i++){

					$user_sugsns = $users_sugsns[$i];
					$db->get('users', array('id', '=', $user_sugsns->userid));
					$s_user_info = $db->first();		//suggested user info
					?>
					<div id="user_info">
						<p>
							<img src="<?php echo $s_user_info->profile_pic_dg; ?>" alt="<?php echo $s_user_info->name; ?>">
							<?php echo $s_user_info->name; ?>
						</p>
						<input type="hidden" id="userid" name="contris[]" value="<?php echo $s_user_info->id; ?>">
						<input type="button" id="add_contri" value="ADD">
					</div>
					<?php

				}

			}

		}
		
		if($tot_sugsns1==0 && $tot_sugsns2==0){

			echo "No user(s) of this name.";

		}


	}

}

?>