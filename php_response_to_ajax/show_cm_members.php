<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$db_col = DBcollaborations::getInstance();

		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$user_data = $user->data();
			$db_cm = DBcollaborations_members::getInstance();
			$db_cm->get("{$unique_name}_members", array('userid', '=', $user_data->id));
			if($db_cm->count()>0){

				$m_info = $db_cm->first();
				if($m_info->member_type == 'ADMIN'){

					$db = DB::getInstance();
					$db_cm->get("{$unique_name}_members", array('member_type', '=', 'MEMBER'));
					$tot_m = $db_cm->count();
					if($tot_m>0){

						$members = $db_cm->results();
						for($i=0; $i<$tot_m; $i++){

							$member = $members[$i];
							$db->get('users', array('id', '=', $member->userid));
							$m_user_data = $db->first();
							?>
							<div>
								<a href="profile.php?user=<?php echo $m_user_data->username; ?>" target="_blank">
									<img src="<?php echo $m_user_data->profile_pic_dg; ?>" height="30px" width="35px">
									<?php echo $m_user_data->name; ?>
								</a>
								<input type="hidden" id="m_user" value="<?php echo $m_user_data->id; ?>">
								<input type="button" id="add_to_founder" value="Add to Founder">
							</div>
							<?php

						}

					}else{
						echo 'No users to change membership.';
					}

				}

			}

		}

	}

}

?>