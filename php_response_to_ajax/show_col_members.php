<?php

require_once '../core/initi.php';

$user = new user();

if($user->isLoggedIn()){

	if(isset($_GET) && !empty($_GET)){

		$unique_name = trim($_GET['col']);
		$db_col = DBcollaborations::getInstance();
		$db_col->get('collaborations_unique', array('unique_name', '=', $unique_name));
		if($db_col->count()>0){

			$db_cm = DBcollaborations_members::getInstance();
			$db = DB::getInstance();
			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE member_type='ADMIN' OR member_type='FOUNDER'", array(), 'SELECT *');
			$tot_f = $db_cm->count();
			if($tot_f>0){

				$f_members = $db_cm->results();
				?>
				<div>
					Founder(s): 
					<?php
					for($i=0; $i<$tot_f; $i++){

						$f_member = $f_members[$i];
						$db->get('users', array('id', '=', $f_member->userid));
						$f_user_data = $db->first();
						?>
						<div>
							<a href="profile.php?user=<?php echo $f_user_data->username; ?>" target="_blank">
								<img src="<?php echo $f_user_data->profile_pic_dg; ?>" width="30px" height="25px">
								<?php echo $f_user_data->name; ?>
							</a>
						</div>
						<?php

					}
					?>
				</div>
				<?php

			}

			$db_cm->query("SELECT * FROM {$unique_name}_members WHERE member_type='MEMBER'", array(), 'SELECT *');
			$tot_m = $db_cm->count();
			if($tot_m>0){

				$members = $db_cm->results();
				?>
				<div>
					Member(s): 
					<?php
					for($i=0; $i<$tot_f; $i++){

						$member = $members[$i];
						$db->get('users', array('id', '=', $member->userid));
						$m_user_data = $db->first();
						?>
						<div>
							<a href="profile.php?user=<?php echo $m_user_data->username; ?>" target="_blank">
								<img src="<?php echo $m_user_data->profile_pic_dg; ?>" width="30px" height="25px">
								<?php echo $m_user_data->name; ?>
							</a>
						</div>
						<?php

					}
					?>
				</div>
				<?php

			}

		}

	}

}

?>