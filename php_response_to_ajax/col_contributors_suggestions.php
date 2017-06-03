<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){
		
		$user_data = $user->data();
		$db = DB::getInstance();
		$db_col = DBcollaborations::getInstance();
		$db_cm = DBcollaborations_members::getInstance();
		$search_user = trim($_GET['search_user']);
		$unique_name = trim($_GET['col']);
		$init_char = substr($search_user, 0, 1);
		$init_char = strtolower($init_char);
		$no_sugsns = 15;		//number of suggestions

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));

		if($db_col->count()>0){

			$db_cm->get($unique_name.'_members', array('userid', '=', $user_data->id));

			if($db_cm->count()>0){

				$db_cm->query("SELECT userid FROM {$unique_name}_members WHERE name_init='{$init_char}' AND userid!={$user_data->id}", array(), 'SELECT *');
				$tot_sugsns = $db_cm->count();
				
				if($tot_sugsns>0){

					$sugsns = $db_cm->results();
					$condition = "";

					for($i=0; $i<$tot_sugsns; $i++){

						$sugsn = $sugsns[$i];
						$s_userid = $sugsn->userid;

						if($s_userid != $user_data->id){
							if($i==0){
								$condition .= "userid={$s_userid}";
							}else{
								$condition .= "OR userid={$s_userid}";
							}
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

				if($tot_sugsns==0){

					echo "No user(s) of this name.";

				}

			}

		}

	}

}

?>